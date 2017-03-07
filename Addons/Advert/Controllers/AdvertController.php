<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Advert\Controllers;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\AddonController;
use Marketplace\Addons\Advert\Models\AdvertModel;

/**
 * Kazist view class for the application
 *
 * @since  1.0
 */
class AdvertController extends AddonController {

    function indexAction($offset = 0, $limit = 6) {

        $model = new AdvertModel;

        $adverts = $model->getAdverts();

        $data_arr['adverts'] = $adverts;

        $this->html = $this->render('Marketplace:Addons:Advert:views:advert.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}
