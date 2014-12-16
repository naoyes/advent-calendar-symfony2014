<?php

namespace MyApp\VichUploaderDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text')
            ->add('imageFile','file') // 第1引数は Entity において UploadableField アノテーションが付与されているプロパティ
            ->add('save','submit', ['label' => '更新'])
        ;
    }

    public function getName()
    {
        return 'product_image';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => '\MyApp\VichUploaderDemoBundle\Entity\Product',
        ]);
    }
}
