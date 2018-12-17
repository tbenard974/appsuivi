<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Performance;
use App\Entity\Sport;
use App\Entity\Jointuresport;
use App\Entity\Fichier;
use App\Form\FiltresportType;
use App\Form\FiltresportdateType;
use App\Form\FiltredateType;

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

        /*
            return $this->render('/visualisation_cds/index.html.twig', array(
                'allPerf' => $allPerformance,
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));*/
    }  
    
    

    /**
     * @Route("/visualisation/performance/photos/{idPerformance}", name="visualiserPerformanceCdsPhotos")
     */

    public function visualiserPerformanceCdsPhotos(Request $request, $idPerformance)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $allFiles = $this->getDoctrine()->getRepository(Fichier::class)->findByFicFkperformance($idPerformance); //->findByPerFkutilisateur($utilisateur);

            return $this->render('/visualisation_cds/visualiserPerformanceCdsPhotos.html.twig', array(
                'allFiles' => $allFiles,
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
     * @Route("/visualisation/performance/cds/date", name="visualiserPerformanceCdsDate")
     */

    public function visualiserPerformanceCdsDate(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $sport = array();
        $form = $this->createForm(FiltredateType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $DateDebut = $form->get('Datedebut')->getData();
            $DateDebut =$DateDebut->format('Y-m-d H:i:s');
            $DateFin = $form->get('Datefin')->getData();
            $DateFin = $DateFin->format('Y-m-d H:i:s');
            return $this->redirectToRoute('visualiserPerformanceCdsDateDatedebutDatefin',array('datedebut' => $DateDebut, 'datefin' => $DateFin));
        }

        return $this->render('/visualisation_cds/filtredate.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/visualisation/performance/cds/sportdate", name="visualiserPerformanceCdsSportDate")
     */

    public function visualiserPerformanceCdsSportDate(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $sport = array();
        $form = $this->createForm(FiltresportdateType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $DateDebut = $form->get('Datedebut')->getData();
            $DateDebut =$DateDebut->format('Y-m-d H:i:s');
            $DateFin = $form->get('Datefin')->getData();
            $DateFin = $DateFin->format('Y-m-d H:i:s');
            $sport2 = $form->get('spoId')->getData();
            if($sport2 =="Aucun"){
                $sport2 = 0;
            }
            else{
                $sport2 = $form->get('spoId')->getData()->getSpoId();
            }
            return $this->redirectToRoute('visualiserPerformanceCdsSportDateDatedebutDatefin',array('idSport' => $sport2,'datedebut' => $DateDebut, 'datefin' => $DateFin));
        }

        return $this->render('/visualisation_cds/filtresportdate.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/visualisation/performance/cds/sportdate/{idSport}/{datedebut}/{datefin}", name="visualiserPerformanceCdsSportDateDatedebutDatefin")
     */

    public function visualiserPerformanceCdsSportDateDatedebutDatefin(Request $request, $idSport, $datedebut, $datefin)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $allJointure = $this->getDoctrine()->getRepository(Jointuresport::class)->findByJoispoFksport($idSport); //->findByPerFkutilisateur($utilisateur);
        $allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findByPerFkjointuresport($allJointure);

            return $this->render('/visualisation_cds/date.html.twig', array(
                'allPerf' => $allPerformance,
                'datedebut' => $datedebut,
                'datefin'=> $datefin,
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/visualisation/performance/cds/date/{datedebut}/{datefin}", name="visualiserPerformanceCdsDateDatedebutDatefin")
     */

    public function visualiserPerformanceCdsDateDatedebutDatefin(Request $request, $datedebut, $datefin)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $allPerformance = $this->getDoctrine()->getRepository(Performance::class)->findAll(); //->findByPerFkutilisateur($utilisateur);

            return $this->render('/visualisation_cds/date.html.twig', array(
                'allPerf' => $allPerformance,
                'datedebut' => $datedebut,
                'datefin'=> $datefin,
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
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

    