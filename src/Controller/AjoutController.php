<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Typecompetition;
use App\Entity\Departement;
use App\Entity\Echellecompetition;
use App\Entity\Utilisateur;
use App\Entity\Epreuve;
use App\Entity\Categorie;
use App\Entity\Jointuresport;
use App\Entity\Sport;
use App\Entity\Niveaulisteministerielle;
use App\Form\AjouttypeType;
use App\Form\AjoutcategorieType;
use App\Form\AjoutdepartementType;
use App\Form\AjoutechelleType;
use App\Form\AjoutepreuveType;
use App\Form\AjoutsportType;
use App\Form\AjoutniveaulisteType;
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
            return $this->redirectToRoute('administrationtypecompetition');
        }

        return $this->render('ajout/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ajout/departement", name="ajoutDepartement")
     */

    public function ajoutDepartement(Request $request)
    {
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        $departement = new Departement();
        $form = $this->createForm(AjoutdepartementType::class, $departement);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departement = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $nomDepartement = $form->get('depNom')->getData();
            
            $departement->setDepNom($nomDepartement);
            $departement->setUpdateFields($utilisateur->getUtiNom());

            $entityManager->persist($departement);
            $entityManager->flush();
            return $this->redirectToRoute('administrationdepartement');
        }

        return $this->render('ajout/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/departement/{idDepartement}", name="supprimerDepartement")
     */
    public function supprimerDepartement(Request $request, $idDepartement)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $departement = $this->getDoctrine()->getRepository(\App\Entity\Departement::class)->findOneByDepId($idDepartement);
        $existe = $this->getDoctrine()->getRepository(\App\Entity\Utilisateur::class)->findByUtiFkdepartement($departement);
        
        if ($existe == null){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($departement);
            $entityManager->flush();
            return $this->redirectToRoute('administrationdepartement');
        }
        else{
            return $this->redirectToRoute('impossiblesupprimerdepartement');
        }
    }

    /**
     * @Route("impossible/supprimer/departement", name="impossiblesupprimerdepartement")
     */
    public function impossiblesupprimerdepartement()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('impossible/supprimerdepartement.html.twig');

    }
        

     /**
     * @Route("/supprimer/typecompetition/{idType}", name="supprimerTypecompet")
     */
    public function supprimerTypecompet(Request $request, $idType)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $typecompet = $this->getDoctrine()->getRepository(\App\Entity\Typecompetition::class)->findOneByTypcomId($idType);
        $echellecompet = $this->getDoctrine()->getRepository(\App\Entity\Typecompetition::class)->findOneByTypcomId($idType);
        $existe = $this->getDoctrine()->getRepository(\App\Entity\Performance::class)->findByPerFktypecompetition($typecompet);
        
        if ($existe == null){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typecompet);
            $entityManager->flush();
            return $this->redirectToRoute('administrationtypecompetition');
        }
        else{
            return $this->redirectToRoute('impossiblesupprimertypecompetition');
        }
        
    }

    /**
     * @Route("impossible/supprimer/typecompetition", name="impossiblesupprimertypecompetition")
     */
    public function impossiblesupprimertypecompetition()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('impossible/supprimertypecompetition.html.twig');

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
            return $this->redirectToRoute('administrationechellecompetition');
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
        $existe = $this->getDoctrine()->getRepository(\App\Entity\Performance::class)->findByPerFkechellecompetition($echellecompet);
        
        if ($existe == null){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($echellecompet);
            $entityManager->flush();
        return $this->redirectToRoute('administrationechellecompetition');
        }
        else{
            return $this->redirectToRoute('impossiblesupprimerechellecompetition');
        }
        
    }

     /**
     * @Route("impossible/supprimer/echellecompetition", name="impossiblesupprimerechellecompetition")
     */
    public function impossiblesupprimerechellecompetition()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        return $this->render('impossible/supprimerechellecompetition.html.twig');

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
            $nomSport = $form->get('spoId')->getData();
            
            $epreuve->setEprNom($nomEpreuve);
            $epreuve->setEprDescription($descriptionEpreuve);
            $epreuve->setUpdateFields($utilisateur->getUtiNom());

            $sport = new Jointuresport();
            $sport->setJoispoFksport($nomSport);
            $sport->setJoispoFkepreuve($epreuve);
            $sport->setUpdateFields($utilisateur->getUtiNom());

            $entityManager->persist($epreuve);
            $entityManager->persist($sport);
            $entityManager->flush();
            return $this->redirectToRoute('administrationepreuve');
        }

        return $this->render('ajout/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/epreuve/{idEpreuve}/{idSport}", name="supprimerEpreuve")
     */
    public function supprimerEpreuve(Request $request, $idEpreuve, $idSport)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $epreuve = $this->getDoctrine()->getRepository(\App\Entity\Epreuve::class)->findOneByEprId($idEpreuve);
        $sport = $this->getDoctrine()->getRepository(\App\Entity\Sport::class)->findOneBySpoId($idSport);
        $jointure = $this->getDoctrine()->getRepository(\App\Entity\Jointuresport::class)->findOneBy(array('joispoFkepreuve' => $epreuve, 'joispoFksport' => $sport, 'joispoFkcategorie' => null));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($jointure);
        $entityManager->flush();
        return $this->redirectToRoute('administrationepreuve');
    }

    /**
     * @Route("/ajout/categorie", name="ajoutCategorie")
     */

    public function ajoutCategorie(Request $request)
    {
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        $categorie = new Categorie();
        $form = $this->createForm(AjoutcategorieType::class, $categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $nomCategorie = $form->get('catNom')->getData();
            $descriptionCategorie = $form->get('catDescription')->getData();
            $nomSport = $form->get('spoId')->getData();
            
            $categorie->setCatNom($nomCategorie);
            $categorie->setCatDescription($descriptionCategorie);
            $categorie->setUpdateFields($utilisateur->getUtiNom());

            $sport = new Jointuresport();
            $sport->setJoispoFksport($nomSport);
            $sport->setJoispoFkcategorie($categorie);
            $sport->setUpdateFields($utilisateur->getUtiNom());
            
            $entityManager->persist($categorie);
            $entityManager->persist($sport);
            $entityManager->flush();
            return $this->redirectToRoute('administrationcategorie');
        }

        return $this->render('ajout/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/categorie/{idCategorie}/{idSport}", name="supprimerCategorie")
     */
    public function supprimerCategorie(Request $request, $idCategorie, $idSport)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $categorie = $this->getDoctrine()->getRepository(\App\Entity\Categorie::class)->findOneByCatId($idCategorie);
        $sport = $this->getDoctrine()->getRepository(\App\Entity\Sport::class)->findOneBySpoId($idSport);
        $jointure = $this->getDoctrine()->getRepository(\App\Entity\Jointuresport::class)->findOneBy(array('joispoFkcategorie' => $categorie, 'joispoFksport' => $sport, 'joispoFkepreuve' => null));
        $entityManager = $this->getDoctrine()->getManager();
        //$entityManager->remove($categorie);
        $entityManager->remove($jointure);
        $entityManager->flush();
        return $this->redirectToRoute('administrationcategorie');
    }

    /**
     * @Route("/ajout/sport", name="ajoutSport")
     */

    public function ajoutSport(Request $request)
    {
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        $sport = new Sport();
        $form = $this->createForm(AjoutsportType::class, $sport);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sport = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $nomSport = $form->get('spoNom')->getData();
            $descriptionSport = $form->get('spoDescription')->getData();
            
            $sport->setSpoNom($nomSport);
            $sport->setSpoDescription($descriptionSport);
            $sport->setUpdateFields($utilisateur->getUtiNom());
            

            $entityManager->persist($sport);
            $entityManager->flush();
            return $this->redirectToRoute('administrationsport');
        }

        return $this->render('ajout/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/sport/{idSport}", name="supprimerSport")
     */
    public function supprimerSport(Request $request, $idSport)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $sport = $this->getDoctrine()->getRepository(\App\Entity\Sport::class)->findOneBySpoId($idSport);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($sport);
        $entityManager->flush();
        return $this->redirectToRoute('administrationsport');
    }

    /**
     * @Route("/ajout/niveauliste", name="ajoutNiveauliste")
     */

    public function ajoutNiveauliste(Request $request)
    {
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
        $niveauliste = new Niveaulisteministerielle();
        $form = $this->createForm(AjoutniveaulisteType::class, $niveauliste);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $niveauliste = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            
            $nomNiveauliste = $form->get('nivlisminNom')->getData();
            $descriptionNiveauliste = $form->get('nivlisminDescription')->getData();
            
            $niveauliste->setNivlisminNom($nomNiveauliste);
            $niveauliste->setNivlisminDescription($descriptionNiveauliste);
            $niveauliste->setUpdateFields($utilisateur->getUtiNom());
            

            $entityManager->persist($niveauliste);
            $entityManager->flush();
            return $this->redirectToRoute('administrationniveauliste');
        }

        return $this->render('ajout/ajout.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/supprimer/niveauliste/{idniveauliste}", name="supprimerNiveauliste")
     */
    public function supprimerNiveauliste(Request $request, $idniveauliste)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $niveauliste = $this->getDoctrine()->getRepository(\App\Entity\Niveaulisteministerielle::class)->findOneByNivlisminId($idniveauliste);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($niveauliste);
        $entityManager->flush();
        return $this->redirectToRoute('administrationniveauliste');
    }
}
