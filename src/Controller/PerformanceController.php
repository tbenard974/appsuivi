<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Performance;
use App\Entity\Utilisateur;
//use App\Entity\Sport;
use App\Form\PerformanceType;
use App\Entity\Jointuresport;
use App\Entity\Epreuve;
use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Request;

class PerformanceController extends AbstractController
{
    /**
     * @Route("/performance/{idPerformance}", name="actionPerformance")
     */
    public function action(Request $request, $idPerformance)
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
			//$logger->info($joispo->getJoispoFkepreuve()->getEprNom());
		}
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($idPerformance == 'nouveau') {
            $performance = new Performance();
            $form = $this->createForm(PerformanceType::class, $performance, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
        }
        else {
            $performance = $this->getDoctrine()->getRepository(\App\Entity\Performance::class)->findOneByPerId($idPerformance);
            $form = $this->createForm(PerformanceType::class, $performance, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
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

        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $performance = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $typeCompetition = $form->get('typeCompetition')->getData();
            $echelleCompetition = $form->get('echelleCompetition')->getData();
            $localisationCompetition = $form->get('localisationCompetition')->getData();
            $resultat = $form->get('resultat')->getData();
            
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
			
			$entityManager->persist($performance);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }
		
        return $this->render('performance/index.html.twig', [
            'form' => $form->createView(),
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
