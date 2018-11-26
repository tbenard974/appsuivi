<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Performance;

class VisualisationCdsController extends AbstractController
{   
    /**
     * @Route("/visualisation/performance/cds", name="visualiserPerformanceCds")
     */

    public function visualiserPerformanceCds(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
        //$user_email = $this->getUser()->getEmail();
        //$utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
		$allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findAll(); //->findByPerFkutilisateur($utilisateur);
            
            return $this->render('visualisation_cds/index.html.twig', array(
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
            
            return $this->render('visualisation_cds/profil.html.twig', array(
                'allUtilisateur' => $allUtilisateur,
                //'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }   
}

    