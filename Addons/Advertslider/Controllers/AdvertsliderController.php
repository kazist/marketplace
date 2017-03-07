<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Advertslider\Controllers;

use Kazist\Controller\AddonController;
use Marketplace\Addons\Advertslider\Models\AdvertsliderModel;

/**
 * Kazist view class for the application
 *
 * @since  1.0
 */
class AdvertsliderController extends AddonController {

    public $flexview_id = '';

    function indexAction($package_id = 0, $limit = 6) {

        $slider_limit = 6;

        $model = new AdvertsliderModel;

        $model->flexview_id = $this->flexview_id;

        $adverts = $model->getAdverts($package_id, $limit);
        $packages = $model->getPackages();
        $default_currency = $model->getDefaultCurrency();

        $data_arr['slider_limit'] = $slider_limit;
        $data_arr['adverts'] = $adverts;
        $data_arr['packages'] = $packages;
        $data_arr['default_currency'] = $default_currency;

        $this->html = $this->render('Marketplace:Addons:Advertslider:views:advertslider.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}
