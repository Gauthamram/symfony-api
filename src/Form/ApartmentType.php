<?php
namespace App\Form;

use App\Entity\Apartment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ApartmentType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
            ->add('street',TextType::class)
            ->add('move_in_date',DateTimeType::class, array(
            	'widget' => 'single_text'
            ))
            ->add('town',TextType::class)
            ->add('country',TextType::class)
            ->add('post_code',IntegerType::class)
            ->add('contact_email',EmailType::class)
            ->add('user_id',IntegerType::class)
            ->add('submit', SubmitType::class);
	}

	 /**
     * [configureOptions]
     * @param  OptionsResolver $resolver
     * @return
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'      => Apartment::class,
            'csrf_protection'   => false,
        ));
    }
}