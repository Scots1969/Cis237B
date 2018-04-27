<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\ProduceItem;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class TaskType extends AbstractType{

  public function buildForm(FormBuilderInterface $builder, array $options) {

    $builder
    ->add('name', TextareaType::class,['label' => 'Descrption'])
    ->add('expiration_date', DateType::class)
    ->add('icon', ChoiceType::class, [
      'choices' => [
       'Cabbage' => 'cabbage',
       'Pizza' => 'pizza' ,
       'Soda' => 'soda' ,
       'Bread' => 'bread' ,
       'Taco' => 'taco' ,
       'Shrimp' => 'shrimp']])
    ->add('save', SubmitType::class, ['label' => 'Create new Task']);
  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults(['data_class' => ProduceItem::class]);
  }
