<?php
/**
 * Created by PhpStorm.
 * User: guillaumeremy-zephir
 * Date: 30/09/2016
 * Time: 09:33
 */

namespace AppBundle\Form\Type;
use AppBundle\Entity\Subject;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
class SubjectType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('title', TextType::class, ['label' => 'Titre'])
			->add('description', TextareaType::class, ['label' => 'Description', 'attr' => ['cols' => 40]])
			->add('save', SubmitType::class);
	}
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver
			->setDefaults(
				[
					'data_class' => Subject::class,
					'method' => 'POST',
				]
			);
	}
}