<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ContactBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BSC;
/**
 * Description of ConnectController
 *
 * @author seb
 */
class ConnectController extends BSC {
    //put your code here
    protected function renderLogin(array $param) {
        
        return $this
                ->container
                ->get('templating')
                ->renderResponse('Contact:Connect:user.html.twig', $param);

    }
}
