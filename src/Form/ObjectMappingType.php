<?php

namespace App\Form;

use App\FormDTO\ObjectMappingDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectMappingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('columnName', ChoiceType::class, [
                'label'                     => false,
                'choices'                   => $options['choices'],
                'choice_label'              => function (string $choice) {
                    return $choice;
                },
                'choice_translation_domain' => false,
                'required'                  => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', ObjectMappingDTO::class);
        $resolver->setRequired('choices');
    }
}
