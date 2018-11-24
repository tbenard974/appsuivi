<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Typecompetition;
use App\Entity\Echellecompetition;
use App\Entity\Utilisateur;
use App\Entity\Epreuve;
use App\Form\AjouttypeType;
use App\Form\AjoutechelleType;
use App\Form\AjoutepreuveType;
use Symfony\Component\HttpFoundation\Request;

class AjoutController extends AbstractController
{
    /**
     * @Route("/ajout/typecompetition", name="ajoutTypecompet")
     */

    public function ajoutTypecompet(Request $request)
    {
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        $typecompet = new Typecompetition();
        $form = $this->createForm(AjouttypeType::class, $typecompet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typecompet = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $nomCompetition = $form->get('typcomNom')->getData();
            $descriptionCompetition = $form->get('typcomDescription')->getData();
            
            $typecompet->setTypcomNom($nomCompetition);
            $typecompet->setTypcomDescription($descriptionCompetition);
            $typecompet->setUpdateFields($utilisateur->getUtiNom());
            

            $entityManager->persist($typecompet);
            $entityManager->flush();
            return $this->redirectToRoute('administration');
        }

        return $this->render('ajout/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/typecompetition/{idType}", name="supprimerTypecompet")
     */
    public function supprimerTypecompet(Request $request, $idType)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $typecompet = $this->getDoctrine()->getRepository(\App\Entity\Typecompetition::class)->findOneByTypcomId($idType);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($typecompet);
        $entityManager->flush();
        return $this->redirectToRoute('administration');
    }

    /**
     * @Route("/ajout/echellecompetition", name="ajoutEchellecompet")
     */

    public function ajoutEchellecompet(Request $request)
    {
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        $echellecompet = new Echellecompetition();
        $form = $this->createForm(AjoutechelleType::class, $echellecompet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $echellecompet = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $nomEchelle = $form->get('echcomNom')->getData();
            $descriptionEchelle = $form->get('echcomDescription')->getData();
            $typeEchelle = $form->get('typeCompetition')->getData();
            
            $echellecompet->setEchcomNom($nomEchelle);
            $echellecompet->setEchcomDescription($descriptionEchelle);
            $echellecompet->setEchcomType($typeEchelle->getTypcomNom());

            $echellecompet->setUpdateFields($utilisateur->getUtiNom());
            

            $entityManager->persist($echellecompet);
            $entityManager->flush();
            return $this->redirectToRoute('administration');
        }

        return $this->render('ajout/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/echellecompetition/{idEchelle}", name="supprimerEchellecompet")
     */
    public function supprimerEchellecompet(Request $request, $idEchelle)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $echellecompet = $this->getDoctrine()->getRepository(\App\Entity\Echellecompetition::class)->findOneByEchcomId($idEchelle);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($echellecompet);
        $entityManager->flush();
        return $this->redirectToRoute('administration');
    }

    /**
     * @Route("/ajout/epreuve", name="ajoutEpreuve")
     */

    public function ajoutEpreuve(Request $request)
    {
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        $epreuve = new Epreuve();
        $form = $this->createForm(AjoutepreuveType::class, $epreuve);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $epreuve = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $nomEpreuve = $form->get('eprNom')->getData();
            $descriptionEpreuve = $form->get('eprDescription')->getData();
            
            $epreuve->setEprNom($nomEpreuve);
            $epreuve->setEprDescription($descriptionEpreuve);
            $epreuve->setUpdateFields($utilisateur->getUtiNom());
            

            $entityManager->persist($epreuve);
            $entityManager->flush();
            return $this->redirectToRoute('administration');
        }

        return $this->render('ajout/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/epreuve/{idEpreuve}", name="supprimerEpreuve")
     */
    public function supprimerEpreuve(Request $request, $idEpreuve)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $epreuve = $this->getDoctrine()->getRepository(\App\Entity\Epreuve::class)->findOneByEprId($idEpreuve);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($epreuve);
        $entityManager->flush();
        return $this->redirectToRoute('administration');
    }
}
