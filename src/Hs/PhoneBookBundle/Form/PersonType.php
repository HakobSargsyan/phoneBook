<?php

namespace Hs\PhoneBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname')->add('lastname')->add('company');

        $builder->add('phones', CollectionType::class, array(
                'entry_type'   => PhoneType::class,
                'entry_options'=> [
                    'label' => false
                ],
                'by_reference' => false,
                "allow_add" => true,
                "allow_delete" => true
            )
        );

        $builder->add('Save' ,SubmitType::class, array(
                "attr"=>array(
                    "class"=>"btn btn-success"
                )
            )
        );

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Hs\PhoneBookBundle\Entity\Person'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hs_phonebookbundle_person';
    }


}
