<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    /**
     * Permet de construire son formulaire en s'aidant du $builder.
     * Le $builder grace a la fonction ->add() permet d'ajouter un nouveau champ.
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        /**
         * Dans symfony chaque champ correspond a un type.
         * Tous les types sont ici : https://symfony.com/doc/current/reference/forms/types.html
         * -------------------------------
         * NB : Le nom des champs correspond aux propriétés de l'entité.
         */

        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Prénom & Nom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail'
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer'
            ])
        ;
    }

    /**
     * Grâce à data_class j'indique a Symfony que je vais réaliser
     * un formulaire pour mes utilisateurs.
     * Symfony sera alors en mesure de récupérer les données saisies
     * par les utilisateurs dans mes champs et me retourner un objet
     * de ce type. Ici User.
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
