<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use App\Entity\Echellecompetition;
use App\Entity\Epreuve;
use App\Entity\Niveaulisteministerielle;
use App\Entity\Sport;
use App\Entity\Jointuresport;
use App\Entity\Typecompetition;


class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration", name="administration")
     */
    public function administration()
    {
        $allCategorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $allEchellecompetition = $this->getDoctrine()->getRepository(Echellecompetition::class)->findAll();
        #$allEpreuve= $this->getDoctrine()->getRepository(Epreuve::class)->findAll();
        $allJoispo= $this->getDoctrine()->getRepository(Jointuresport::class)->findAll();
        $allEpreuve = array();
        $allEpreuve[] = $allJoispo[0];
        foreach($allJoispo as $joispo){
            foreach($allEpreuve as $epr){
                if ($joispo->getJoispoFkepreuve() != $epr->getJoispoFkepreuve()){
                    if ($joispo->getJoispoFksport() != $epr->getJoispoFksport()) {
                        $allEpreuve[]=$joispo;
                    }
                }
            }
        }

        $allNiveaulisteministerielle = $this->getDoctrine()->getRepository(Niveaulisteministerielle::class)->findAll();
        $allSport = $this->getDoctrine()->getRepository(Sport::class)->findAll();
        $allTypecompetition = $this->getDoctrine()->getRepository(Typecompetition::class)->findAll();

        
        return $this->render('administration/index.html.twig', [
            'allCategorie' => $allCategorie,
            'allEchellecompetition' => $allEchellecompetition,
            'allEpreuve' => $allEpreuve,
            #'allJoispo' => $allJoispo,
            'allNiveaulisteministerielle' => $allNiveaulisteministerielle,
            'allSport' => $allSport,
            'allTypecompetition' => $allTypecompetition,
        ]);
    }
}
