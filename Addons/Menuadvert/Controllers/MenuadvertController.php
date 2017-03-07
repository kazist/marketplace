<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Menuadvert\Controllers;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\KazistFactory;
use Kazist\Controller\AddonController;
use Marketplace\Addons\Menuadvert\Models\MenuadvertModel;

/**
 * Kazist view class for the application
 *
 * @since  1.0
 */

class MenuadvertController extends AddonController {

    function indexAction($offset = 0, $limit = 6) {

        $factory = new KazistFactory;
        $model = new MenuadvertModel;

        $adverts = $model->getAdverts();

        $data_arr['adverts'] = $adverts;

        $this->html = $this->render('Marketplace:Addons:Menuadvert:views:menuadvert.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}
