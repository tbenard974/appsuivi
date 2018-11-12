<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
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
		$allAbsence = $this->get('manage.evenement')->visualiserAll($this);
        //$allAbsence = $this->getDoctrine()->getRepository(Absence::class)->findByAbsFkutilisateur($utilisateur);
            
        return $this->render('index.html.twig', array(
            'allAbsence' => $allAbsence,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * @Route("/mobile", name="indexMobile")
     * @Method({"GET"})
     */
    public function indexMobile(Request $request)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user_email = $this->getUser()->getEmail();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiEmail($user_email);
		//select abs_id from absence where abs_fk_idutilisateur=(select uti_id from utilisateur where uti_email='dev@dev.fr');
		// $allAbsence = $this->forward('App\Controller\EvenementController:visualiserAll', array(
        //     'utilisateur' => $utilisateur,
        // ));
        $allAbsence = $this->getDoctrine()->getRepository(Absence::class)->findByAbsFkutilisateur($utilisateur);

        $formatted = [];
        foreach ($allAbsence as $absence) {
            $formatted[] = [
                'id' => $absence->getAbsId(),
                'nom' => $absence->getAbsNom(),
                'dateDebut' => $absence->getAbsDatedebut(),
                'dateFin' => $absence->getAbsDatefin(),
                'lieu' => $absence->getAbsLieu(),
                'idPerformance' => $absence->getAbsFkperformance()->getPerId(),

            ];
        }

        return new JsonResponse($formatted);
    }

}
