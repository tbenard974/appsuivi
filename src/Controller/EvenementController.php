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
//use App\Entity\Sport;
use App\Entity\Jointuresport;
use Psr\Log\LoggerInterface;
use App\Form\EvenementType;
use App\Entity\Typefichier;

class EvenementController extends Controller
{
    /**
     * @Route("/evenement/ajouter", name="ajouterEvenement")
     */
    public function ajouter(Request $request, LoggerInterface $logger)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $absence = new Absence();
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email); #devra être l'utilisateur courant lorsque mécanisme d'authentification

        #$logger->info($status->getStaabsId());
        $form = $this->createForm(EvenementType::class, $absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $absence = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            if ($absence->getAbsFkmotifabsence()->getMotabsNom()=='Compétition') {
                $typeCompetition = $form->get('typeCompetition')->getData();
                $echelleCompetition = $form->get('echelleCompetition')->getData();
                $localisationCompetition = $form->get('localisationCompetition')->getData();
                $importance = $form->get('importance')->getData();

                $performance = new Performance();
                $performance->setPerFkutilisateur($utilisateur);
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

            }
            else {
                $absence->setAbsNom($absence->getAbsFkmotifabsence()->getMotabsNom().' - '.$absence->getAbsLieu());

            }
            //$absence->setAbsFkstatusabsence($status);
            $absence->setAbsFkutilisateur($utilisateur);
            $absence->setUpdateFields($utilisateur->getUtiEmail());

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager->persist($absence);
            $entityManager->flush();

            return $this->redirectToRoute('index');
        }

        #return $this->render('index.html.twig');
        return $this->render('evenement/ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function visualiserAll(Request $request)
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
    }

    /**
     * @Route("/evenement/afficher", name="afficherEvenement")
     */
    public function afficher(Request $request)
    {
        return $this->render('/evenement/afficher.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }


}