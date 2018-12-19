<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use App\Entity\Absence;
use App\Entity\Performance;
use App\Entity\Utilisateur;
//use App\Entity\Sport;
use App\Form\PerformanceType;
use App\Form\ModificationPerformanceType;
use App\Form\ChoixperformanceType;
use App\Entity\Jointuresport;
use App\Entity\Epreuve;
use App\Entity\Categorie;
use App\Entity\Typefichier;
use App\Entity\Echellecompetition;
use App\Entity\Localisationcompetition;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Service\FileUploader;

class PerformanceController extends AbstractController
{

    /**
     * @Route("/performance/ajouterLocalisation", name="formulaireAjouterLocalisation")
     */
	public function formulaireAjouterLocalisation(Request $request, LoggerInterface $logger)
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
		
        $em = $this->getDoctrine()->getEntityManager();

        if($request->isXmlHttpRequest())
        {
            $echelleCompetitionInitial = null;
            $echelleCompetition = $request->get('echelle');

            if ($echelleCompetition != $echelleCompetitionInitial)
            {
                $echcomObject = $this->getDoctrine()->getRepository(Echellecompetition::class)->findOneByEchcomId($echelleCompetition);
                $logger->info('echObject : '.$echcomObject->getEchcomNom());
                $localisationCompetition = $em->getRepository(Localisationcompetition::class)->findLocalisationFromEchelle($echcomObject);

                $tabLocalisation = array();
                $i = 0;

                foreach ($localisationCompetition as $localisation)
                {
                    $logger->info('Nom localisation : '.$localisation->getLoccomNom());
                    $tabLocalisation[$i]['loccomId'] = $localisation->getLoccomId();
                    $tabLocalisation[$i]['loccomNom'] = $localisation->getLoccomNom();
                    $i++;
                }

                $response = new Response();

                $data = json_encode($tabLocalisation);
                $logger->info('data : '.$data);
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent($data);

                return $response;
            }
            else
            {
                return new Response('petite erreur de manip chef');
            }

        }
    }
    
	/**
     * @Route("/performance/selection", name="selectionPerformance")
     */
	public function selection(Request $request, LoggerInterface $logger)
    {
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
		$user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email); #devra être l'utilisateur courant lorsque mécanisme d'authentification
		
		//$absence = new Absence();
		$allAbsence = $this->getDoctrine()->getRepository(Absence::class)->findByAbsFkutilisateur($utilisateur);
		$filteredAbsence = array();
		foreach($allAbsence as $absence)
		{
			if($absence->getAbsFkmotifabsence()->getMotabsNom() == 'Compétition')
			{
				$filteredAbsence[] = $absence;
			}
		}
		
		$form = $this->createForm(ChoixperformanceType::class, $absence, array('allAbsence' => $filteredAbsence));
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			return $this->redirectToRoute('actionPerformance',array('typeAction' => 'creer', 'idObjet' => $absence->getAbsId()));
		}
		
		return $this->render('performance/choix.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
			'form' => $form->createView(),
        ));
	}
	
    /**
     * @Route("/performance/{typeAction}/{idObjet}", name="actionPerformance")
     */
    public function action(Request $request, $typeAction, $idObjet, FileUploader $fileUploader, LoggerInterface $logger)
    {
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email); #devra être l'utilisateur courant lorsque mécanisme d'authentification
        
        // Récupération des catégories et des épreuves liés au sport de l'user pour affichage dans le form
		$filteredJoispo = $this->getDoctrine()->getRepository(Jointuresport::class)->findBy(array('joispoFksport'=> $utilisateur->getUtiFksport()));
		$filteredEpreuve = array();
		$filteredCategorie = array();
		foreach($filteredJoispo as $joispo)
		{
			if(!in_array($joispo->getJoispoFkepreuve(),$filteredEpreuve)){
                if($joispo->getJoispoFkcategorie()==null){
                    $filteredEpreuve[] = $joispo->getJoispoFkepreuve();
                }
			}
			if(!in_array($joispo->getJoispoFkcategorie(),$filteredCategorie)){
                if($joispo->getJoispoFkepreuve()==null){
                    $filteredCategorie[] = $joispo->getJoispoFkcategorie();
                }
			}
		}
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        if ($typeAction == 'creer')
        {
            if ($idObjet == 'nouveau') {
                $performance = new Performance();
                $form = $this->createForm(PerformanceType::class, $performance, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
            }
            else{
                $absence = $this->getDoctrine()->getRepository(Absence::class)->findOneByAbsId($idObjet);
                $performance = new Performance();
                $form = $this->createForm(ModificationPerformanceType::class, $performance, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
                $form->get('perLieu')->setData($absence->getAbsLieu());
                $form->get('typeCompetition')->setData($absence->getAbsFktypecompetition());
                $form->get('echelleCompetition')->setData($absence->getAbsFkechellecompetition());
                $form->get('localisationCompetition')->setData($absence->getAbsFklocalisationcompetition());
                $performance->setPerAbsence($absence);
            }
            $allFiles = array();
        }
        elseif ($typeAction == 'modifier')
        {
            $performance = $this->getDoctrine()->getRepository(\App\Entity\Performance::class)->findOneByPerId($idObjet);
            $form = $this->createForm(ModificationPerformanceType::class, $performance, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
            $form->get('perLieu')->setData($performance->getPerLieu());
            $form->get('typeCompetition')->setData($performance->getPerFktypecompetition());
            $form->get('echelleCompetition')->setData($performance->getPerFkechellecompetition());
            $form->get('localisationCompetition')->setData($performance->getPerFklocalisationcompetition());
            if ($filteredEpreuve != null) {
                $form->get('epreuve')->setData($performance->getPerFkjointuresport()->getJoispoFkepreuve());
            }
            if ($filteredCategorie != null) {
                $form->get('categorie')->setData($performance->getPerFkjointuresport()->getJoispoFkcategorie());
            }
            $form->get('resultat')->setData($performance->getPerFkresultat());
            $form->get('perImportance')->setData($performance->getPerImportance());
            /*$phpListePhotos = explode(",", $performance->getPerListephoto());
            foreach ($phpListePhotos as $pieces)
            {
                if (array_search($pieces, $phpListePhotos) == 0)
                {
                    $tempListe = explode("{", $phpListePhotos[0]);
                    $logger->info('0 --> '.$tempListe[0]);
                    $logger->info('1 --> '.$tempListe[1]);
                    $phpListePhotos[0] = $tempListe[1];
                    
                }
                if (array_search($pieces, $phpListePhotos) == (count($phpListePhotos)-1))
                {
                    $tempListe = explode("}", $phpListePhotos[count($phpListePhotos)-1]);
                    $phpListePhotos[count($phpListePhotos)-1] = $tempListe[0];
                }
            }
            $allFiles = array();
            foreach ($phpListePhotos as $pieces)
            {
                if ($pieces > 0)
                {
                    $allFiles[] = $this->getDoctrine()->getRepository(\App\Entity\Fichier::class)->findOneByFicId($pieces);
                }
            }*/
            $allFiles = $this->getDoctrine()->getRepository(\App\Entity\Fichier::class)->findByFicFkperformance($performance->getPerId());
        }
        elseif ($typeAction == 'dupliquer')
        {
            //$performance = new Performance();
            $fromPerformance = $this->getDoctrine()->getRepository(\App\Entity\Performance::class)->findOneByPerId($idObjet);
            $performance = clone $fromPerformance;
            /*$performance->setPerFkjointuresport($fromPerformance->getPerFkjointuresport());
            $performance->setPerFktypecompetition($fromPerformance->getPerFktypecompetition());
            $performance->setPerFkechellecompetition($fromPerformance->getPerFkechellecompetition());
            $performance->setPerFklocalisationcompetition($fromPerformance->getPerFklocalisationcompetition());
            $performance->setPerFkresultat($fromPerformance->getPerFkresultat());
            $performance->setPerDatedebut($fromPerformance->getPerDatedebut());
            $performance->setPerDatefin($fromPerformance->getPerDatefin());
            $performance->setPerLieu($fromPerformance->getPerLieu());
            $performance->set*/

            
            $form = $this->createForm(ModificationPerformanceType::class, $performance, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
            $form->get('perLieu')->setData($performance->getPerLieu());
            $form->get('typeCompetition')->setData($performance->getPerFktypecompetition());
            $form->get('echelleCompetition')->setData($performance->getPerFkechellecompetition());
            $form->get('localisationCompetition')->setData($performance->getPerFklocalisationcompetition());
            if ($filteredEpreuve != null) {
                $form->get('epreuve')->setData($performance->getPerFkjointuresport()->getJoispoFkepreuve());
            }
            if ($filteredCategorie != null) {
                $form->get('categorie')->setData($performance->getPerFkjointuresport()->getJoispoFkcategorie());
            }
            $form->get('resultat')->setData($performance->getPerFkresultat());
            $form->get('perImportance')->setData($performance->getPerImportance());
            $allFiles = array();
        }
        //$allFiles = $performance->getPerFkfichier();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $performance = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $lieu = $form->get('perLieu')->getData();
            $typeCompetition = $form->get('typeCompetition')->getData();
            $echelleCompetition = $form->get('echelleCompetition')->getData();
            $localisationCompetition = $form->get('localisationCompetition')->getData();
            $resultat = $form->get('resultat')->getData();
            
            $performance->setPerLieu($lieu);
            $performance->setPerFkutilisateur($utilisateur);
            $performance->setPerFktypecompetition($typeCompetition);
            $performance->setPerFkechellecompetition($echelleCompetition);
            $performance->setPerFklocalisationcompetition($localisationCompetition);
            $performance->setPerFkresultat($resultat);
            $performance->setUpdateFields($utilisateur->getUtiEmail());

			$sport = $utilisateur->getUtiFksport();
            $epreuve = $form->get('epreuve')->getData();
            $categorie = $form->get('categorie')->getData();
			
            if ($form->get('autreEpreuve')->getData() != null){
                $nomEpreuve = $form->get('autreEpreuve')->getData();
                $nomEpreuve = strtolower($nomEpreuve);
                $nomEpreuve = preg_replace('/[éèëê]+/', 'e', $nomEpreuve);
				//$nomEpreuve = preg_replace('/[a]+/', 'z', $nomEpreuve);
				//$nomEpreuve = preg_replace('!\s+!', ' ', $nomEpreuve);
				$nomEpreuve = strtoupper($nomEpreuve);
				$findEpreuve = $this->getDoctrine()->getRepository(Epreuve::class)->findOneByEprNom($nomEpreuve);
				if ( $findEpreuve == null){
					$epreuve = new Epreuve();
					$epreuve->setEprNom($nomEpreuve);
					$epreuve->setUpdateFields($utilisateur->getUtiEmail());
					$entityManager->persist($epreuve);
				}
				else {
					$epreuve = $findEpreuve;
				}
            }
			
			if ($form->get('autreCategorie')->getData() != null){
                $nomCategorie = $form->get('autreCategorie')->getData();
                $nomCategorie = strtolower($nomCategorie);
                $nomCategorie = preg_replace('/[éèëê]+/', 'e', $nomCategorie);
				$nomCategorie = strtoupper($nomCategorie);
				$findCategorie = $this->getDoctrine()->getRepository(Categorie::class)->findOneByCatNom($nomCategorie);
				if ($findCategorie == null){
					$categorie = new Categorie();
					$categorie->setCatNom($nomCategorie);
					$categorie->setUpdateFields($utilisateur->getUtiEmail());
					$entityManager->persist($categorie);
				}
				else {
					$categorie = $findCategorie;
				}
            }
			
			$jointureSport = $this->getDoctrine()->getRepository(Jointuresport::class)->findOneBy(array('joispoFksport'=> $sport, 'joispoFkepreuve'=> $epreuve, 'joispoFkcategorie'=> $categorie));
            $jointureEpreuve = $this->getDoctrine()->getRepository(Jointuresport::class)->findOneBy(array('joispoFksport'=> $sport, 'joispoFkepreuve'=> $epreuve, 'joispoFkcategorie'=> null));
            $jointureCategorie = $this->getDoctrine()->getRepository(Jointuresport::class)->findOneBy(array('joispoFksport'=> $sport, 'joispoFkepreuve'=> null,'joispoFkcategorie'=> $categorie));
            if ($jointureSport == null) {
                $jointureSport = new Jointuresport();
                $jointureSport->setJoispoFksport($sport);
                $jointureSport->setJoispoFkepreuve($epreuve);
                $jointureSport->setJoispoFkcategorie($categorie);
                $jointureSport->setUpdateFields($utilisateur->getUtiEmail());
                $entityManager->persist($jointureSport);
            }
            if ($jointureEpreuve == null) {
                $jointureEpreuve = new Jointuresport();
                $jointureEpreuve->setJoispoFksport($sport);
                $jointureEpreuve->setJoispoFkepreuve($epreuve);
                $jointureEpreuve->setUpdateFields($utilisateur->getUtiEmail());
                $entityManager->persist($jointureEpreuve);
            }
            if ($jointureCategorie == null) {
                $jointureCategorie = new Jointuresport();
                $jointureCategorie->setJoispoFksport($sport);
                $jointureCategorie->setJoispoFkcategorie($categorie);
                $jointureCategorie->setUpdateFields($utilisateur->getUtiEmail());
                $entityManager->persist($jointureCategorie);
            }
            $performance->setPerFkjointuresport($jointureSport);
            
            /*$listePhotos = [
                0 => 0,
                1 => 0,
                2 => 0,
            ];*/

			if ($form->get('image0')->getData() != null)
			{
				$typeFichier = $this->getDoctrine()->getRepository(Typefichier::class)->findOneByTypficNom('Photo');
				$fichierTransmis = $form->get('image0')->getData();
				$fileToUpload = $fileUploader->upload($fichierTransmis, $utilisateur);
                $fileToUpload->setFicFktypefichier($typeFichier);
                $fileToUpload->setFicFkperformance($performance);
				$entityManager->persist($fileToUpload);
                //$listePhotos[0] = $fileToUpload->getFicId();
            }
            if ($form->get('image1')->getData() != null)
			{
                $typeFichier = $this->getDoctrine()->getRepository(Typefichier::class)->findOneByTypficNom('Photo');
                $fichierTransmis = $form->get('image1')->getData();
                $fileToUpload = $fileUploader->upload($fichierTransmis, $utilisateur);
                $fileToUpload->setFicFktypefichier($typeFichier);
                $fileToUpload->setFicFkperformance($performance);
				$entityManager->persist($fileToUpload);
                //$listePhotos[1] = $fileToUpload->getFicId();
            }
            if ($form->get('image2')->getData() != null)
			{
                $typeFichier = $this->getDoctrine()->getRepository(Typefichier::class)->findOneByTypficNom('Photo');
                $fichierTransmis = $form->get('image2')->getData();
                $fileToUpload = $fileUploader->upload($fichierTransmis, $utilisateur);
				$fileToUpload->setFicFktypefichier($typeFichier);
                $fileToUpload->setFicFkperformance($performance);
                $entityManager->persist($fileToUpload);
                //$listePhotos[2] = $fileToUpload->getFicId();
            }
            //$psqlListePhotos = '{' . implode(",", $listePhotos) . '}';
            //$performance->setPerListephoto($psqlListePhotos);

            if (($form->get('image0')->getData() != null) or ($form->get('image1')->getData() != null) or ($form->get('image2')->getData() != null))
            {
                foreach ($allFiles as $files)
                {
                    $entityManager->remove($files);
                }
            }
            
            
			$entityManager->persist($performance);
            $entityManager->flush();
            return $this->redirectToRoute('visualiserPerformance');
        }
		
        return $this->render('performance/index.html.twig', [
            'form' => $form->createView(),
			'allFiles' => $allFiles,
        ]);
    }

    /**
     * @Route("/visualisation/performance", name="visualiserPerformance")
     */

    public function visualiserPerformance(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //$this->denyAccessUnlessGranted('ROLE_Admin');
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
		//select abs_id from absence where abs_fk_idutilisateur=(select uti_id from utilisateur where uti_email='dev@dev.fr');
		$allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findByPerFkutilisateur($utilisateur);
            
            return $this->render('visu_perf/index.html.twig', array(
                'allPerf' => $allPerformance,
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/telechargement/performances", name="telechargementPerformance")
     */

    public function telechargementPerformance(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
		$allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findByPerFkutilisateur($utilisateur);
        $response = new StreamedResponse();
        $response->setCallback(function() use ($allPerformance) {
            $handle = fopen('php://output', 'w+');
    
            fputcsv($handle, [
                                'Type compétition',
                                'Echelle compétition',
                                'Localisation compétition',
                                'Epreuve',
                                'Catégorie',
                                'Importance',
                                'Date début',
                                'Date fin',
                                'Lieu',
                                'Résultat',
                                'Ressenti'
                            ], ';');
            foreach ($allPerformance as $user) {

                if ( $user->getPerFkresultat() == null ){ 
                    $resultat='Non renseigné';
                }
                else{ 
                    $resultat=$user->getPerFkresultat()->getResNom();
                }
                $importance='';
                
                if( $user->getPerImportance() == 1){
                    $importance='Forte';
                }
                else{ 
                    $importance='Basse'; 
                }
                fputcsv(
                    $handle,
                    
                    [
                        $user->getPerFktypecompetition()->getTypcomNom(),
                        $user->getPerFkechellecompetition()->getEchcomNom(),
                        $user->getPerFklocalisationcompetition()->getLoccomNom(),
                        $user->getPerFkjointuresport()->getJoispoFkepreuve()->getEprNom(),
                        $user->getPerFkjointuresport()->getJoispoFkcategorie()->getCatNom(),
                        $importance,
                        $user->getPerDatedebut()->format('d-m-Y'),
                        $user->getPerDatefin()->format('d-m-Y'),
                        $user->getPerLieu(),
                        $resultat,
                        $user->getPerRessenti()
                    ],
                    ';'
                 );
            }
    
            fclose($handle);
        });
    
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition','attachment; filename="performance.csv"');
    
        return $response;     
    }
    

    /**
     * @Route("/visualisation/performance/{idUtilisateur}", name="visualiserPerformanceUsercds")
     */

    public function visualiserPerformanceUsercds(Request $request, $idUtilisateur)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if($idUtilisateur == "cds"){
            $allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findAll();
        }
        else{
            $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiId($idUtilisateur);
            $allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findByPerFkutilisateur($utilisateur);
        }
        //$this->denyAccessUnlessGranted('ROLE_Admin');
        //$utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiId($idUtilisateur);
		//select abs_id from absence where abs_fk_idutilisateur=(select uti_id from utilisateur where uti_email='dev@dev.fr');
		//$allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findByPerFkutilisateur($utilisateur);
            
            return $this->render('visualisation_cds/index.html.twig', array(
                'allPerf' => $allPerformance,
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }


    /**
     * @Route("/supprimer/performance/{idPerformance}", name="supprimerPerformance")
     */
    public function supprimerPerformance(Request $request, $idPerformance)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email); #devra être l'utilisateur courant lorsque mécanisme d'authentification
        if(self::findIfUserGotRightsOnPerf($utilisateur, $idPerformance) == null)
        {
            return $this->redirectToRoute('index');
        }
        $performance = $this->getDoctrine()->getRepository(\App\Entity\Performance::class)->findOneByPerId($idPerformance);
        $absenceFK = $this->getDoctrine()->getRepository(\App\Entity\Absence::class)->findOneByAbsFkperformance($performance);
        $entityManager = $this->getDoctrine()->getManager();
        if($absenceFK != null){
            $absenceFK->setAbsFkperformance(null);
        }
        $entityManager->remove($performance);
        $entityManager->flush();
        return $this->redirectToRoute('visualiserPerformance');
    }

    public function findIfUserGotRightsOnPerf(Utilisateur $utilisateur, $idPerformance)
    {
        $rights = $this->getDoctrine()->getRepository(Performance::class)->findOneBy(array('perFkutilisateur' => $utilisateur, 'perId' => $idPerformance));
    
        return $rights;
    }
}
