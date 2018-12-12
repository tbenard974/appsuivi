<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Performance;
use App\Entity\Sport;
use App\Entity\Jointuresport;
use App\Form\FiltresportType;

class VisualisationCdsController extends AbstractController
{   
    /**
     * @Route("/visualisation/performance/cds", name="visualiserPerformanceCds")
     */

    public function visualiserPerformanceCds(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findAll(); //->findByPerFkutilisateur($utilisateur);

            return $this->render('/visualisation_cds/index.html.twig', array(
                'allPerf' => $allPerformance,
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }   

    /**
     * @Route("/visualisation/performance/cds/sport", name="visualiserPerformanceCdsSport")
     */

    public function visualiserPerformanceCdsSport(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $sport = array();
        $form = $this->createForm(FiltresportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('visualiserPerformanceCdsSportId',array('idSport' => $form->get('spoId')->getData()->getSpoId()));
        }

        return $this->render('/visualisation_cds/filtresport.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/visualisation/performance/cds/sport/{idSport}", name="visualiserPerformanceCdsSportId")
     */

    public function visualiserPerformanceCdsSportId(Request $request, $idSport)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $allJointure = $this->getDoctrine()->getRepository(Jointuresport::class)->findByJoispoFksport($idSport); //->findByPerFkutilisateur($utilisateur);
        $allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findByPerFkjointuresport($allJointure);

            return $this->render('/visualisation_cds/index.html.twig', array(
                'allPerf' => $allPerformance,
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/visualisation/profil/cds", name="visualiserProfilCds")
     */

    public function visualiserProfilCds(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
		$allUtilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findAll(); 
            
            return $this->render('/visualisation_cds/profil.html.twig', array(
                'allUtilisateur' => $allUtilisateur,
                //'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }   
}

    