<?php

namespace App\Form;

use App\FormDTO\MappingDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MappingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contextMapping', CollectionType::class, [
                'entry_type'    => ObjectMappingType::class,
                'entry_options' => [
                    'choices' => $options['columns'],
                ],
            ])
            ->add('filterMapping', CollectionType::class, [
                'entry_type'    => ObjectMappingType::class,
                'entry_options' => [
                    'choices' => $options['columns'],
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', MappingDTO::class);
        $resolver->setRequired('columns');
    }
}
