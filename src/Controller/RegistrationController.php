<?php
// src/Controller/RegistrationController.php
namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        // Create a new blank Users and process the form
        $Users = new Users();
        $form = $this->createForm(UsersType::class, $Users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new Userss password
            $encoder = $this->get('security.password_encoder');
            $password = $encoder->encodePassword($Users, $Users->getPlainPassword());
            $Users->setPassword($password);

            // Set their role
            $Users->setRole('ROLE_Users');

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($Users);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('auth/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}