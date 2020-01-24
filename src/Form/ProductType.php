<?php

namespace App\Form\Type;

use App\Entity\Product;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName', TextType::class)
            ->add('productId', TextType::class)
            ->add('productManager', TextType::class, [
                'required' => false,
            ])
            ->add('salesStartDate', DateType::class)


            ->add('save', SubmitType::class, ['label' => 'Add a new product']);


        $builder->get('salesStartDate')
            ->addModelTransformer(new CallbackTransformer(
                function ($in) {

                    return $in;
                },
                function ($out) {
                    return $out->format('yyyy-mm-dd');
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}