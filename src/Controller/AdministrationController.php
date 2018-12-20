<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use App\Entity\Echellecompetition;
use App\Entity\Epreuve;
use App\Entity\Niveaulisteministerielle;
use App\Entity\Sport;
use App\Entity\Departement;
use App\Entity\Jointuresport;
use App\Entity\Typecompetition;
class AdministrationController extends AbstractController
{
    /**
     * @Route("/administration/typecompetition", name="administrationtypecompetition")
     */
    public function administrationtypecompetition()
    {
        $allTypecompetition = $this->getDoctrine()->getRepository(Typecompetition::class)->findBy(array(), array('typcomNom' => 'ASC'));
        return $this->render('administration/typecompetition.html.twig', [
            'allTypecompetition' => $allTypecompetition,
        ]);
    }

    /**
     * @Route("/administration/departement", name="administrationdepartement")
     */
    public function administrationdepartement()
    {
        $allDepartement = $this->getDoctrine()->getRepository(Departement::class)->findBy(array(), array('depNom' => 'ASC'));
        return $this->render('administration/departement.html.twig', [
            'allDepartement' => $allDepartement,
        ]);
    }

    /**
     * @Route("/administration/echellecompetition", name="administrationechellecompetition")
     */
    public function administrationechellecompetition()
    {
        $allEchellecompetition = $this->getDoctrine()->getRepository(Echellecompetition::class)->findBy(array(), array('echcomNom' => 'ASC'));
        return $this->render('administration/echellecompetition.html.twig', [
            'allEchellecompetition' => $allEchellecompetition,
        ]);
    }

    /**
     * @Route("/administration/epreuve", name="administrationepreuve")
     */
    public function administrationepreuve()
    {
        $allJoispoepr= $this->getDoctrine()->getRepository(Jointuresport::class)->findByJoispoFkcategorie(null);
        $allJoispocat= $this->getDoctrine()->getRepository(Jointuresport::class)->findByJoispoFkepreuve(null);
        $allEpreuve = array();
        if($allJoispoepr != null){
            $allEpreuve[] = $allJoispoepr[0];
            foreach($allJoispoepr as $joispo){
                $flag = false;
                foreach($allEpreuve as $epr){
                    if ($joispo->getJoispoFkepreuve() == $epr->getJoispoFkepreuve()){
                        if ($joispo->getJoispoFksport() == $epr->getJoispoFksport()) {
                            $flag = true;
                        }
                    }
                }
                if ($flag == false){
                    if ($joispo->getJoispoFkcategorie() == null) {
                        $allEpreuve[]=$joispo;
                    }
                }
            }
        }
        return $this->render('administration/epreuve.html.twig', [
            'allEpreuve' => $allEpreuve,
        ]);
    }

    /**
     * @Route("/administration/categorie", name="administrationcategorie")
     */
    public function administrationcategorie()
    {
        $allJoispocat= $this->getDoctrine()->getRepository(Jointuresport::class)->findByJoispoFkepreuve(null);
        $allCategorie = array();
        if($allJoispocat != null){
            $allCategorie[] = $allJoispocat[0];
            foreach($allJoispocat as $joispo){
                $flag = false;
                foreach($allCategorie as $cat){
                    if ($joispo->getJoispoFkcategorie() == $cat->getJoispoFkcategorie()){
                        if ($joispo->getJoispoFksport() == $cat->getJoispoFksport()) {
                            $flag = true;
                        }
                    }
                }
                if ($flag == false){
                    if ($joispo->getJoispoFkepreuve() == null) {
                        $allCategorie[]=$joispo;
                    }
                }
            }
        }

        return $this->render('administration/categorie.html.twig', [
            'allCategorie' => $allCategorie,
        ]);
    }

    /**
     * @Route("/administration/sport", name="administrationsport")
     */
    public function administrationsport()
    {
        $allSport = $this->getDoctrine()->getRepository(Sport::class)->findBy(array(), array('spoNom' => 'ASC'));
        return $this->render('administration/sport.html.twig', [
            'allSport' => $allSport,
        ]);
    }

    /**
     * @Route("/administration/niveauliste", name="administrationniveauliste")
     */
    public function administrationniveauliste()
    {
        $allNiveaulisteministerielle = $this->getDoctrine()->getRepository(Niveaulisteministerielle::class)->findBy(array(), array('nivlisminNom' => 'ASC'));
        return $this->render('administration/niveauliste.html.twig', [
            'allNiveaulisteministerielle' => $allNiveaulisteministerielle,
        ]);
    }


    /**
     * @Route("/administration", name="administration")
     */
    public function administration()
    {
        #$allCategorie = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $allEchellecompetition = $this->getDoctrine()->getRepository(Echellecompetition::class)->findBy(array(), array('echcomNom' => 'ASC'));
        #$allEpreuve= $this->getDoctrine()->getRepository(Epreuve::class)->findAll();
        $allJoispoepr= $this->getDoctrine()->getRepository(Jointuresport::class)->findByJoispoFkcategorie(null);
        $allJoispocat= $this->getDoctrine()->getRepository(Jointuresport::class)->findByJoispoFkepreuve(null);
        $allEpreuve = array();
        if($allJoispoepr != null){
            $allEpreuve[] = $allJoispoepr[0];
            foreach($allJoispoepr as $joispo){
                $flag = false;
                foreach($allEpreuve as $epr){
                    if ($joispo->getJoispoFkepreuve() == $epr->getJoispoFkepreuve()){
                        if ($joispo->getJoispoFksport() == $epr->getJoispoFksport()) {
                            $flag = true;
                        }
                    }
                }
                if ($flag == false){
                    if ($joispo->getJoispoFkcategorie() == null) {
                        $allEpreuve[]=$joispo;
                    }
                }
            }
        }
        $allCategorie = array();
        if($allJoispocat != null){
            $allCategorie[] = $allJoispocat[0];
            foreach($allJoispocat as $joispo){
                $flag = false;
                foreach($allCategorie as $cat){
                    if ($joispo->getJoispoFkcategorie() == $cat->getJoispoFkcategorie()){
                        if ($joispo->getJoispoFksport() == $cat->getJoispoFksport()) {
                            $flag = true;
                        }
                    }
                }
                if ($flag == false){
                    if ($joispo->getJoispoFkepreuve() == null) {
                        $allCategorie[]=$joispo;
                    }
                }
            }
        }
        $allNiveaulisteministerielle = $this->getDoctrine()->getRepository(Niveaulisteministerielle::class)->findBy(array(), array('nivlisminNom' => 'ASC'));
        $allSport = $this->getDoctrine()->getRepository(Sport::class)->findBy(array(), array('spoNom' => 'ASC'));
        $allTypecompetition = $this->getDoctrine()->getRepository(Typecompetition::class)->findBy(array(), array('typcomNom' => 'ASC'));

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