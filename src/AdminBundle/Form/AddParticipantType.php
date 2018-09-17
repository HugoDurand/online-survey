<?php
/**
 * Created by PhpStorm.
 * User: HUDU0995
 * Date: 25/07/2018
 * Time: 17:04
 */

namespace AdminBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\QuestadpParticipants;

class AddParticipantType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('session', EntityType::class, array(
                'class' => 'AppBundle:QuestadpSession',
                'choice_label' => 'libelle',
                'choice_value' => 'id',
            ));

        $builder->get('session')
            ->addModelTransformer(new CallbackTransformer(
                function ($originalDescription) {

                    return $originalDescription;
                },
                function ($submittedDescription) {

                    return $submittedDescription->getId();
                }
            ));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => QuestadpParticipants::class,
        ));
    }


}