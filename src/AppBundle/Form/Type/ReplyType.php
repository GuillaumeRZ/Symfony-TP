<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Reply;

class ReplyType extends AbstractType {

	public function buildForm( FormBuilderInterface $builder, array $options ) {
		$builder
			->add( 'author', TextType::class, ['label' => 'Nom'])
			->add( 'mail' )
			->add( 'title' )
			->add( 'text', TextareaType::class,
				['label' => 'Réponse', 'attr' => ['cols' => 40]]
			);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' => Reply::class,
			'method'     => 'POST',
		));
	}
}