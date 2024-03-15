<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /*
     * PENSE BÊTE :
     * Authentification dans Symfony
     *   1. make:user
     *   2. make:auth
     *   3. Mettre a jour le lien de redirection dans votre Authenticator
     *   4. Personnalisé l'url de connexion & déconnexion
     *   5. Personnalisé votre formulaire
     *   6. Enjoy your ride !
     */

    #[Route(path: '/connexion.html', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
         if ($this->getUser()) {
             return $this->redirectToRoute('app_default_home');
         }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/deconnexion.html', name: 'app_logout')]
    public function logout(): void
    {
    }
}
