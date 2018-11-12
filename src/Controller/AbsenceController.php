<?php
// src/Controller/AbsenceController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Absence;
use App\Entity\Statusabsence;
use App\Entity\Motifabsence;
use App\Entity\Utilisateur;
use App\Service\FileUploader;
use Psr\Log\LoggerInterface;
use App\Form\AbsenceType;
use App\Entity\Typefichier;

class AbsenceController extends Controller
{
    /**
     * @Route("/absence/demande", name="demandeAbsence")
     */
    public function demande(Request $request, LoggerInterface $logger, FileUploader $fileUploader)
    {
        $absence = new Absence();
        $utilisateur = $this->getDoctrine()->getRepository(Utilisateur::class)->findOneByUtiId(1); #devra être l'utilisateur courant lorsque mécanisme d'authentification
        $status = $this->getDoctrine()->getRepository(Statusabsence::class)->findOneByStaabsNom('En attente');
        #$logger->info($status->getStaabsId());
        $form = $this->createForm(AbsenceType::class, $absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $absence = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            if ($absence->getAbsFkmotifabsence()->getMotabsName()=='Compétition') {

                $typeFichier = $this->getDoctrine()->getRepository(Typefichier::class)->findOneByTypficName('Convocation'); #findOneByTypficName devra être changé par findOneByTypficNom lorsque la base sera recréée
                $fichierTransmis = $form->get('fichier')->getData();
                /* if (is_null($fichierTransmis) {
                 
                } */
                $fichier = $fileUploader->upload($fichierTransmis, $utilisateur);
                $fichier->setFicFktypefichier($typeFichier);
                $absence->setAbsFkfichier($fichier);
                $entityManager->persist($fichier);
            }

            $absence->setAbsFkstatusabsence($status);
            $absence->setAbsFkutilisateur($utilisateur);
            $absence->setUpdateFields($utilisateur->getUtiNom());
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager->persist($absence);
            $entityManager->flush();
    
            return $this->redirectToRoute('index');
        }

        #return $this->render('index.html.twig');
        return $this->render('absence/demande.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}