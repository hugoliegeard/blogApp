<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    #[Route('/')]
    # Ex. http://127.0.0.1:8000/
    public function home(PostRepository $postRepository)
    {
        /**
         * CONSIGNE : Afficher les 5 derniers articles de ma base
         * find : Récupérer un élément dans la BDD via son ID
         * findOneBy : Récupérer un élément via des critères. Ex. Un article via son 'SLUG'
         * findAll : Récupérer et filtrer tous les éléments.
         * findBy : Récupérer des éléments via des critères.
         * --------------------------------------------------
         * NOTA BENE : Vous avez la possibilité de créer vos propres requêtes :
         * https://symfony.com/doc/current/doctrine.html#querying-with-the-query-builder
         */
        return $this->render('default/home.html.twig', [
            'posts' => $postRepository->findAll()
        ]);
    }

    #[Route('/categorie/{id}')]
    # Ex. Politique http://127.0.0.1:8000/categorie/5
    # Ex. Economie http://127.0.0.1:8000/categorie/4
    # {slug} représente un paramètre de la route.
    public function category($id, CategoryRepository $categoryRepository)
    {
        # Récupération d'une catégorie via son ID
        $category = $categoryRepository->find($id);

        return $this->render('default/category.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/article/{slug}')]
    public function post(Post $post)
    {
        # Récupération d'un article (post) via son alias
        # $post = $postRepository->findOneBy(['slug'=> $slug]); # Version 1
        # $post = $postRepository->findOneBySlug($slug); # Version 2
        # Version 3 : https://symfony.com/doc/current/doctrine.html#automatically-fetching-objects-entityvalueresolver
        dd($post);

        return $this->render('default/post.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/page/contact.html')]
    # Ex. http://127.0.0.1:8000/page/contact.html
    public function contact()
    {
        return new Response('
            <h1>Contactez-nous</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos dolorem itaque repudiandae. At consequuntur debitis expedita fuga fugit harum mollitia numquam odio quia quis? Dignissimos ducimus eius id nemo quibusdam.</p>
        ');
    }








    #[Route('/search/{specialite}')]
        # {slug} représente un paramètre de la route.
    public function searchSpecialite($specialite)
    {
        # TODO Rechercher dans ma BDD tous les medecins qui font cette spécialité.
        # TODO Retourner le résultat dans ma vue, pour affichage...

        return new Response("
            <h1>Vous recherchez un spécialiste : $specialite</h1>
        ");
    }















}
