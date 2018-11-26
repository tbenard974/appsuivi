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
     * @Route("/performance/{idPerformance}", name="actionPerformance")
     */
    public function action(Request $request, $idPerformance)
    {
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email); #devra être l'utilisateur courant lorsque mécanisme d'authentification
        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($idPerformance == 'nouveau') {
            $performance = new Performance();
            $form = $this->createForm(PerformanceType::class, $performance);
        }
        else {
            // if(self::findIfUserGotRightsOnEvent($utilisateur, $idEvenement) == null)
            // {
            //     return $this->redirectToRoute('index');
            // }
            $performance = $this->getDoctrine()->getRepository(\App\Entity\Performance::class)->findOneByPerId($idPerformance);
            $form = $this->createForm(PerformanceType::class, $performance);
            $form->get('typeCompetition')->setData($performance->getPerFktypecompetition());
            $form->get('echelleCompetition')->setData($performance->getPerFkechellecompetition());
            $form->get('localisationCompetition')->setData($performance->getPerFklocalisationcompetition());
            $form->get('epreuve')->setData($performance->getPerFkjointuresport()->getJoispoFkepreuve());
            $form->get('categorie')->setData($performance->getPerFkjointuresport()->getJoispoFkcategorie());
            $form->get('perImportance')->setData($performance->getPerImportance());
            $form->get('resultat')->setData($performance->getPerFkresultat());

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
        //$this->denyAccessUnlessGranted('ROLE_Admin');
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiId($idUtilisateur);
		//select abs_id from absence where abs_fk_idutilisateur=(select uti_id from utilisateur where uti_email='dev@dev.fr');
		$allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findByPerFkutilisateur($utilisateur);
            
            return $this->render('visu_perf/index.html.twig', array(
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
        $entityManager = $this->getDoctrine()->getManager();
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
