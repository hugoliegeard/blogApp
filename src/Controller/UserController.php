<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    #[Route('/inscription.html')]
    public function register(Request $request,
                             UserPasswordHasherInterface $hasher,
                             EntityManagerInterface $manager)
    {

        # Documentation complete ici
        # https://symfony.com/doc/3.x/doctrine/registration_form.html

        # Création d'un "user" vide.
        # Il sera rempli par la suite avec les données remplit de notre visiteur.
        $user = new User();

        # Création du formulaire
        # Process :
        # 1. Je crée mon objet vide
        # 2. Je le passe à mon formulaire
        # 3. J'affiche mon formulaire sur la page
        # 4. Mon utilisateur soumet le formulaire qu'il a rempli
        # 5. Symfony traite le formulaire
        # 6. Je reçois mon objet rempli avec les données saisies
        $form = $this->createForm(UserType::class, $user);

        # Passer la requête au formulaire pour traitement
        # Process :
        # 1. Mon utilisateur soumet son formulaire
        # 2. La requête contient les informations soumises via POST
        # 3. Je passe la requête à Symfony (handleRequest)
        # 4. Symfony me retourne mon objet rempli.
        $form->handleRequest($request);

        # Si mon formulaire a été soumis par l'utilisateur.
        if ($form->isSubmitted()) {

            # Encodage du mot passe
            $hashedPassword = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            # Sauvegarde dans la BDD
            $manager->persist($user);
            $manager->flush();

            # Redirection
            return $this->redirectToRoute('app_default_home');

        }

        # Passage du formulaire à la vue
        return $this->render('user/register.html.twig', [
            'form' => $form
        ]);
    }

}