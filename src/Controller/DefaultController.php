<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Absence;
use App\Entity\Statusabsence;
use App\Entity\Motifabsence;
use App\Entity\Utilisateur;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
		//select abs_id from absence where abs_fk_idutilisateur=(select uti_id from utilisateur where uti_email='dev@dev.fr');
		$allAbsence = $this->getDoctrine()->getRepository(Absence::class)->findByAbsFkutilisateur($utilisateur);
            
            return $this->render('index.html.twig', array(
                'allAbsence' => $allAbsence,
                'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }

}
