<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ContactBundle\Controller;

/**
 * Description of ContactController
 *
 * @author seb
 */
use ContactBundle\Entity\User;
use ContactBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller {

    //put your code here
    public function indexAction(Request $request) {
        $user = $this->getUser();
        if (!empty($user)) {
            $user_id = $user->getId();
        } 
        else {
            $user_id = null;
        }
        $contacts = $this->getDoctrine()->getRepository('ContactBundle:Contact')->findBy(array(
            'user' => $user_id
        ));

        return $this->render('ContactBundle:Connect:user.html.twig', array(
                    'contacts' => $contacts,
                    'user' => $user
        ));
    }

    public function addAction(Request $request) {
        $contact = new Contact();
        $user = $this->getUser();
        $formBuilder = $this->get('form.factory')->createBuilder('form', $contact);
        $formBuilder
                ->add('nom', 'text')
                ->add('prenom', 'text')
                ->add('email', 'email', array('required' => false))
                ->add('tel', 'text')
                ->add('Enregistrer', 'submit')
        ;
        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $contact->setUser($user);
            $em->persist($contact);
            $em->flush();
            $this->redirect('ContactBundle:Connect:user.html.twig');
        }
        return $this->render('ContactBundle:Contact:add.html.twig', array(
                    'form' => $form->createView(),
                    'user' => $user,
        ));
    }

}
