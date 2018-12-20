<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Entity\Fichier;
use App\Form\ProfildepartementType;
use App\Form\ProfilsportType;
use Symfony\Component\HttpFoundation\Request;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{idUtilisateur}", name="profilusercds")
     */
    
    public function profilusercds($idUtilisateur)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //$user_email = $this->getUser()->getEmail();
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $utilisateur = $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::class)->findOneByUtiId($idUtilisateur);
        

        return $this->render('profil/profilusercds.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    /**
     * @Route("/profil/photos/{idUtilisateur}", name="profilusercdsPhotos")
     */
    
    public function profilusercdsPhotos($idUtilisateur)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        //$user_email = $this->getUser()->getEmail();
        $this->denyAccessUnlessGranted('ROLE_Admin');
        $utilisateur = $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::class)->findOneByUtiId($idUtilisateur);

        $allFiles = $this->getDoctrine()->getRepository(Fichier::class)->findByFicFkutilisateur($utilisateur);
        
        uasort($allFiles, 'self::cmpFicDatedebut'); 

        return $this->render('profil/profilusercdsPhotos.html.twig', [
            'utilisateur' => $utilisateur,
            'allFiles' => $allFiles,
        ]);
    }

    /**
     * @Route("/profil", name="profil")
     */
    
    public function profil()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        

        return $this->render('profil/index.html.twig', [
            'utilisateur' => $utilisateur,
            //'controller_name' => 'ProfilController',
        ]);
    }

    /**
     * @Route("/nouveau/profil", name="nouveauProfil")
     */
    
    public function nouveauProfil(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        $form = $this->createForm(ProfilType::class, $utilisateur);
        $form->get('utiSport')->setData($utilisateur->getUtiFkSport());
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $utiSport = $form->get('utiSport')->getData();
            $utilisateur->setUtiFksport($utiSport);
        
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            return $this->redirectToRoute('profil');
        }



        return $this->render('profil/modif.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profil/modif/sport/{idUtilisateur}", name="modifSportProfil")
     */
    public function modifSportProfil(Request $request, $idUtilisateur)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $utilisateur = $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::class)->findOneByUtiId($idUtilisateur);
        $form = $this->createForm(ProfilsportType::class, $utilisateur);
        $form->get('utiSport')->setData($utilisateur->getUtiFkSport());
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $utiSport = $form->get('utiSport')->getData();
            $utilisateur->setUtiFksport($utiSport);
        
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            return $this->redirectToRoute('profil');
        }



        return $this->render('profil/modifsport.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/profil/modif/departement/{idUtilisateur}", name="modifDepartementProfil")
     */
    public function modifDepartementProfil(Request $request, $idUtilisateur)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $utilisateur = $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::class)->findOneByUtiId($idUtilisateur);
        $form = $this->createForm(ProfildepartementType::class, $utilisateur);
        $form->get('utiDepartement')->setData($utilisateur->getUtiFkDepartement());
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateur = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $utiDepartement = $form->get('utiDepartement')->getData();
            $utilisateur->setUtiFkdepartement($utiDepartement);
        
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            return $this->redirectToRoute('profil');
        }



        return $this->render('profil/modifdepartement.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function cmpFicDatedebut($a, $b) {
        if ($a->getFicDatecreation() == $b->getFicDatecreation()) {
            return 0;
        }
        return ($a->getFicDatecreation() > $b->getFicDatecreation()) ? -1 : 1;
    }
}
