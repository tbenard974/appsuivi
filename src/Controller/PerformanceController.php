<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Performance;
use App\Entity\Utilisateur;
use App\Entity\Sport;
use App\Form\PerformanceType;
use App\Entity\Jointuresport;
use App\Entity\Typecompetition;
use Symfony\Component\HttpFoundation\Request;

class PerformanceController extends AbstractController
{
    /**
     * @Route("/performance", name="performance")
     */
    public function index(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $performance = new Performance();
		$user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email); #devra être l'utilisateur courant lorsque mécanisme d'authentification
        
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $performance = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $typeCompetition = $form->get('typeCompetition')->getData();
            $echelleCompetition = $form->get('echelleCompetition')->getData();
            $localisationCompetition = $form->get('localisationCompetition')->getData();
            $importance = $form->get('importance')->getData();
            $resultat = $form->get('resultat')->getData();
            
            $performance->setPerFkutilisateur($utilisateur);
            $performance->setPerFktypecompetition($typeCompetition);
            $performance->setPerFkechellecompetition($echelleCompetition);
            $performance->setPerFklocalisationcompetition($localisationCompetition);
            $performance->setPerDatedebut($performance->getPerDatedebut());
            $performance->setPerDatefin($performance->getPerDatefin());
            $performance->setPerLieu($performance->getPerLieu());
            $performance->setPerImportance($importance);
            $performance->setPerFkresultat($resultat);
            $performance->setPerRessenti($performance->getPerRessenti());
            
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

            $performance->setPerFkutilisateur($utilisateur);
            $performance->setUpdateFields($utilisateur->getUtiEmail());

            $entityManager->persist($performance);
            $entityManager->flush();
            return $this->redirectToRoute('index');
        }

        return $this->render('performance/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/performance/visualisation", name="visualiserPerformance")
     */

    public function perfvisu(Request $request)
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
}
