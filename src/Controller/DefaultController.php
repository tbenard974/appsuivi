<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Absence;
use App\Entity\Statusabsence;
use App\Entity\Motifabsence;
use App\Entity\Utilisateur;
use \DateTime;

class DefaultController extends Controller
{
    public function cmp($a, $b) {
        if ($a->getAbsDatedebut() == $b->getAbsDatedebut()) {
            return 0;
        }
        return ($a->getAbsDatedebut() < $b->getAbsDatedebut()) ? -1 : 1;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);

        if ($this->getUser()->getRole()=='ROLE_Admin'){
            return $this->redirectToRoute('visualiserProfilCds');
        }

        if ($utilisateur->getUtiPremiereconnexion() == true){
            $entityManager = $this->getDoctrine()->getManager();
            $utilisateur->setUtiPremiereconnexion(false);
            $entityManager->persist($utilisateur);
            $entityManager->flush();
            return $this->redirectToRoute('nouveauProfil');
        }
        
		//$allAbsence = $this->get('manage.evenement')->visualiserAll($this);
        $allAbsence = $this->getDoctrine()->getRepository(Absence::class)->findByAbsFkutilisateur($utilisateur);
        /*$date_now = new DateTime("now");
        $array = array();
            foreach ($allAbsence as $user1) {
                $user1->getAbsDatedebut();
                foreach ($allAbsence as $user2) {
                    $user2->getAbsDatedebut();      
                }    
            } */
        uasort($allAbsence, 'self::cmp');     
        return $this->render('index.html.twig', array(
            'allAbsence' => $allAbsence,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }
}
