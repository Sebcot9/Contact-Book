<?php

namespace ContactBundle\Controller;

use ContactBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ContactController
 *
 * @author seb
 */

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
        $form = $this->createForm('contact_form_type', $contact, array('validation_groups'=>array('addContact')));
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $contact->setUser($user);
            $em->persist($contact);
            $em->flush();
            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }
        return $this->render('ContactBundle:Contact:add.html.twig', array(
                    'form' => $form->createView(),
                    'user' => $user,
        ));
    }

    public function supprAction(Request $request, Contact $contact) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success', "Le contact a bien été supprimé");
        
        return $this->redirect($this->generateUrl('fos_user_profile_show'));
    }
    
    public function modifAction(Request $request, Contact $contact) {
        $user = $this->getUser();
        $form = $this->createForm('contact_form_type', $contact, array('validation_groups'=>array('editContact')));
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $contact->setUser($user);
            $em->persist($contact);
            $em->flush();
            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }
        return $this->render('ContactBundle:Contact:edit.html.twig', array(
                    'form' => $form->createView(),
                    'user' => $user,
                    'contact' => $contact,
        ));
        
    }
}
