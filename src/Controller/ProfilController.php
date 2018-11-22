<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Form\ProfilType;
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
        $utilisateur = $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::class)->findOneByUtiId($idUtilisateur);
        

        return $this->render('profil/profilusercds.html.twig', [
            'utilisateur' => $utilisateur,
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
     * @Route("/profil/modif/{idUtilisateur}", name="modifProfil")
     */
    public function modif(Request $request, $idUtilisateur)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $utilisateur = $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::class)->findOneByUtiId($idUtilisateur);
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
}