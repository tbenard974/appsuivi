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
use App\Form\ModificationStageType;
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
                $form->get('typeCompetition')->setData($absence->getAbsFktypecompetition());
                $form->get('echelleCompetition')->setData($absence->getAbsFkechellecompetition());
                $form->get('localisationCompetition')->setData($absence->getAbsFklocalisationcompetition());
                if ($filteredEpreuve != null) {
                    //$form->get('epreuve')->setData($performance->getPerFkjointuresport()->getJoispoFkepreuve());
                }
                if ($filteredCategorie != null) {
                    //$form->get('categorie')->setData($performance->getPerFkjointuresport()->getJoispoFkcategorie());
                }
                //$form->get('importance')->setData($performance->getPerImportance());
            }
            else {
                $form = $this->createForm(ModificationStageType::class, $absence, array('filteredEpreuve' => $filteredEpreuve, 'filteredCategorie' => $filteredCategorie));
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
                //$importance = $form->get('importance')->getData();

                /*if ($idEvenement == 'nouveau') {
                    //$performance = new Performance();
                    //$performance->setPerFkutilisateur($utilisateur);
                }
                else {
                    //$performance = $absence->getAbsFkperformance();
                }*/
                $absence->setAbsFktypecompetition($typeCompetition);
                $absence->setAbsFkechellecompetition($echelleCompetition);
                $absence->setAbsFklocalisationcompetition($localisationCompetition);

                $sport = $utilisateur->getUtiFksport();

                if ($localisationCompetition->getLoccomNom() == 'Autre')
                {
                    $absence->setAbsNom(date_format($absence->getAbsDatedebut(),'d-m-Y').' - '.'Compét - '.$typeCompetition->getTypcomNom().' '.$echelleCompetition->getEchcomNom());
                }
                else
                {
                    $absence->setAbsNom(date_format($absence->getAbsDatedebut(),'d-m-Y').' - '.'Compét - '.$typeCompetition->getTypcomNom().' '.$localisationCompetition->getLoccomNom());
                }
            }
            else {
                $absence->setAbsNom(date_format($absence->getAbsDatedebut(),'d-m-Y').' - '.$absence->getAbsFkmotifabsence()->getMotabsNom().' '.$absence->getAbsLieu());
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
                    
                    [$user->getAbsNom(),$user->getAbsDatedebut()->format('d-m-Y'),$user->getAbsDatedebut()->format('G:ia'),$user->getAbsLieu(),$user->getAbsDatefin()->format('d-m-Y'),$user->getAbsDatefin()->format('G:ia')],
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