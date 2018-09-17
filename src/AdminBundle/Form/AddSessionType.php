<?php
/**
 * Created by PhpStorm.
 * User: HUDU0995
 * Date: 25/07/2018
 * Time: 17:04
 */

namespace AdminBundle\Form;


use AppBundle\Entity\QuestadpQuestionnaires;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\QuestadpSession;
use Symfony\Component\Form\Extension\DataCollector\EventListener\DataCollectorListener;

class AddSessionType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class)
            ->add('id_questionnaire', EntityType::class, array(
                'class' => 'AppBundle:QuestadpQuestionnaires',
                'choice_label' => 'libelle',
            ));


        $builder->get('id_questionnaire')
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
            'data_class' => QuestadpSession::class,
        ));
    }



}