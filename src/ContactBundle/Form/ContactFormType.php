<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace ContactBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotNull;
/**
 * Description of RegistrationType
 *
 * @author seb
 */
class ContactFormType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
       $builder
                ->add('nom', 'text', array(
                    'label' => 'Nom',
                    'attr'=>array(
                        'class' => 'form-control',
                    )))
                ->add('prenom', 'text',array(
                    'label' => 'Prénom',
                    'attr'=>array(
                        'class' => 'form-control',
                    )))
                ->add('email', 'email', array(
                    'required' => true,
                    'label' => 'E-mail',
                    'attr'=>array(
                    'class' => 'form-control',
                    )))
                ->add('tel', 'text',array(
                    'label' => 'Téléphone',
                    'attr'=>array(
                        'class' => 'form-control',
                    )))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' =>'ContactBundle\Entity\Contact',
            'intention' =>'contact_form',
        ));
    }
    
    public function getName() {
        return 'contact_form_type';
    }
    
    public function getBlockPrefix() {
       // 
    }
}
