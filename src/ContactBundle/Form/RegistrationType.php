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
        $builder->add('name');
    }
    
    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
    
    public function getBlockPrefix() {
       // 
    }
}
