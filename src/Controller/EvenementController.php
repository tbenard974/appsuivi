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
use Psr\Log\LoggerInterface;
use App\Form\EvenementType;
use App\Form\ModificationCompetitionType;
use App\Entity\Typefichier;

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
   
        if ($idEvenement == 'nouveau') {
            $absence = new Absence();
            $form = $this->createForm(EvenementType::class, $absence);
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
                $form = $this->createForm(ModificationCompetitionType::class, $absence);
                $form->get('typeCompetition')->setData($performance->getPerFktypecompetition());
                $form->get('echelleCompetition')->setData($performance->getPerFkechellecompetition());
                $form->get('localisationCompetition')->setData($performance->getPerFklocalisationcompetition());
                $form->get('epreuve')->setData($performance->getPerFkjointuresport()->getJoispoFkepreuve());
                $form->get('categorie')->setData($performance->getPerFkjointuresport()->getJoispoFkcategorie());
                $form->get('importance')->setData($performance->getPerImportance());
            }
            else {
                $form = $this->createForm(EvenementType::class, $absence);
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
     * @Route("/evenement/afficher", name="afficherEvenement")
     */
    public function afficher(Request $request)
    {
        return $this->render('/evenement/afficher.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    public function findIfUserGotRightsOnEvent(Utilisateur $utilisateur, $idEvenement)
    {
        $rights = $this->getDoctrine()->getRepository(Absence::class)->findOneBy(array('absFkutilisateur' => $utilisateur, 'absId' => $idEvenement));
    
        return $rights;
    }
}