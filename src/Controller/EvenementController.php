<?php
// src/Controller/EvenementController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Absence;
use App\Entity\Statusabsence;
use App\Entity\Motifabsence;
use App\Entity\Utilisateur;
use App\Entity\Performance;
use App\Entity\Jointuresport;
use App\Entity\Epreuve;
use App\Entity\Categorie;
use Psr\Log\LoggerInterface;
use App\Form\EvenementType;
use App\Form\ModificationCompetitionType;
use App\Entity\Typefichier;
use Symfony\Component\HttpFoundation\StreamedResponse;
use \DateTime;

class EvenementController extends Controller
{
     /**
     *
     * @Route("/evenement/{idEvenement}", name="actionEvenement")
     * 
     */
    public function action(Request $request, $idEvenement, LoggerInterface $logger)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email); #devra être l'utilisateur courant lorsque mécanisme d'authentification
		
		// Récupération des catégories et des épreuves liés au sport de l'user pour affichage dans le form
		$filteredJoispo = $this->getDoctrine()->getRepository(Jointuresport::class)->findBy(array('joispoFksport'=> $utilisateur->getUtiFksport()));
		$filteredEpreuve = array();
		$filteredCategorie = array();
		foreach($filteredJoispo as $joispo)
		{
			if(!in_array($joispo->getJoispoFkepreuve(),$filteredEpreuve)){
				$filteredEpreuve[] = $joispo->getJoispoFkepreuve();
			}
			if(!in_array($joispo->getJoispoFkcategorie(),$filteredCategorie)){
				$filteredCategorie[] = $joispo->getJoispoFkcategorie();
			}
			//$logger->info($joispo->getJoispoFkepreuve()->getEprNom());
		}
   
        if ($idEvenement == 'nouveau') {
            $absence = new Absence();
            $form = $this->createForm(EvenementType::class, $absence, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
        }
        else {
            if(self::findIfUserGotRightsOnEvent($utilisateur, $idEvenement) == null)
            {
                return $this->redirectToRoute('index');
            }
            $absence = $this->getDoctrine()->getRepository(\App\Entity\Absence::class)->findOneByAbsId($idEvenement);
            $motifAbsence = $absence->getAbsFkmotifabsence();
            if($motifAbsence->getMotabsNom()=='Compétition'){
                $performance = $absence->getAbsFkperformance();
                $form = $this->createForm(ModificationCompetitionType::class, $absence, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
                $form->get('typeCompetition')->setData($performance->getPerFktypecompetition());
                $form->get('echelleCompetition')->setData($performance->getPerFkechellecompetition());
                $form->get('localisationCompetition')->setData($performance->getPerFklocalisationcompetition());
                if ($filteredEpreuve != null) {
                    $form->get('epreuve')->setData($performance->getPerFkjointuresport()->getJoispoFkepreuve());
                }
                if ($filteredCategorie != null) {
                    $form->get('categorie')->setData($performance->getPerFkjointuresport()->getJoispoFkcategorie());
                }
                $form->get('importance')->setData($performance->getPerImportance());
            }
            else {
                $form = $this->createForm(EvenementType::class, $absence, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
            }
        }
        //$form = $this->createForm(EvenementType::class, $absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $absence = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            if ($absence->getAbsFkmotifabsence()->getMotabsNom()=='Compétition') {
                $typeCompetition = $form->get('typeCompetition')->getData();
                $echelleCompetition = $form->get('echelleCompetition')->getData();
                $localisationCompetition = $form->get('localisationCompetition')->getData();
                $importance = $form->get('importance')->getData();

                if ($idEvenement == 'nouveau') {
                    $performance = new Performance();
                    $performance->setPerFkutilisateur($utilisateur);
                }
                else {
                    $performance = $absence->getAbsFkperformance();
                }
                $performance->setPerFktypecompetition($typeCompetition);
                $performance->setPerFkechellecompetition($echelleCompetition);
                $performance->setPerFklocalisationcompetition($localisationCompetition);
                $performance->setPerDatedebut($absence->getAbsDatedebut());
                $performance->setPerDatefin($absence->getAbsDatefin());
                $performance->setPerLieu($absence->getAbsLieu());
                $performance->setPerImportance($importance);
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

                if ($jointureSport == null) {
                    $jointureSport = new Jointuresport();
                    $jointureSport->setJoispoFksport($sport);
                    $jointureSport->setJoispoFkepreuve($epreuve);
                    $jointureSport->setJoispoFkcategorie($categorie);
                    $jointureSport->setUpdateFields($utilisateur->getUtiEmail());
                    $entityManager->persist($jointureSport);
                }
                $performance->setPerFkjointuresport($jointureSport);

                $entityManager->persist($performance);

                $absence->setAbsNom('Compét - '.$typeCompetition->getTypcomNom().' '.$localisationCompetition->getLoccomNom());
                $absence->setAbsFkperformance($performance);
            }
            else {
                $absence->setAbsNom($absence->getAbsFkmotifabsence()->getMotabsNom().' - '.$absence->getAbsLieu());
            }
            $absence->setAbsFkutilisateur($utilisateur);
            $absence->setUpdateFields($utilisateur->getUtiEmail());
            $entityManager->persist($absence);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('evenement/ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /*public function visualiserAll(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        //select abs_id from absence where abs_fk_idutilisateur=(select uti_id from utilisateur where uti_email='dev@dev.fr');
        $allAbsence = $this->getDoctrine()->getRepository(Utilisateur::class)->findByAbsFkutilisateur($utilisateur);

        return $this->render('index.html.twig', array(
            'allAbsence' => $allAbsence,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }*/

    /**
     * @Route("/visualisation/evenement", name="visualisationEvenement")
     */
    public function visualisationEvenement(Request $request)
    {
        return $this->render('/evenement/afficher.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/download/evenement", name="downloadEvenement")
     */
    public function downloadEvenement(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        $allAbsence = $this->getDoctrine()->getRepository(Absence::class)->findByAbsFkutilisateur($utilisateur);
        $response = new StreamedResponse();
        $response->setCallback(function() use ($allAbsence) {
            $handle = fopen('php://output', 'w+');
    
            fputcsv($handle, ['Subject', 'Start date','Start Time','Location','End date','End Time'], ';');
            $date_now = new DateTime("now");
            foreach ($allAbsence as $user) {
                // Faire le test que la date de début est bien après la date d'aujourd'hui
                if($date_now > $user->getAbsDatedebut()){
                }
                else{
                fputcsv(
                    $handle,
                    
                    [$date_now->format('d-m-Y'),$user->getAbsNom(),$user->getAbsDatedebut()->format('d-m-Y'),$user->getAbsDatedebut()->format('G:ia'),$user->getAbsLieu(),$user->getAbsDatefin()->format('d-m-Y'),$user->getAbsDatefin()->format('G:ia')],
                    ';'
                 );
                }
            }
    
            fclose($handle);
        });
    
        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition','attachment; filename="planning.csv"');
    
        return $response;
        //return $this->render('/evenement/download.html.twig', [
        //]);
    }

    /**
     * @Route("/supprimer/evenement/{idEvenement}", name="supprimerEvenement")
     */
    public function supprimerEvenement(Request $request, $idEvenement)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email); #devra être l'utilisateur courant lorsque mécanisme d'authentification
        if(self::findIfUserGotRightsOnEvent($utilisateur, $idEvenement) == null)
        {
            return $this->redirectToRoute('index');
        }
        $absence = $this->getDoctrine()->getRepository(\App\Entity\Absence::class)->findOneByAbsId($idEvenement);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($absence);
        $entityManager->flush();
        return $this->redirectToRoute('index');
    }

    public function findIfUserGotRightsOnEvent(Utilisateur $utilisateur, $idEvenement)
    {
        $rights = $this->getDoctrine()->getRepository(Absence::class)->findOneBy(array('absFkutilisateur' => $utilisateur, 'absId' => $idEvenement));
    
        return $rights;
    }
}