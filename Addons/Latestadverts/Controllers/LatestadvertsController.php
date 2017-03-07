<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Latestadverts\Controllers;

use Kazist\KazistFactory;
use Kazist\Controller\AddonController;
use Marketplace\Addons\Latestadverts\Models\LatestadvertsModel;

/**
 * Kazist view class for the application
 *
 * @since  1.0
 */
class LatestadvertsController extends AddonController {

    public $flexview_id = '';

    function indexAction($offset = 0, $limit = 6) {

        $factory = new KazistFactory;
        $model = new LatestadvertsModel;

        $show_categories = $factory->getSetting('marketplace.block.latestadverts.show.categories', $this->flexview_id);

        $model->flexview_id = $this->flexview_id;

        $categories = $model->getAdvertCategories();
        $adverts = $model->getLatestAdverts();

        $data_arr['categories'] = $categories;
        $data_arr['adverts'] = $adverts;
        $data_arr['show_categories'] = $show_categories;

        $this->html = $this->render('Marketplace:Addons:Latestadverts:views:latestadverts.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}
