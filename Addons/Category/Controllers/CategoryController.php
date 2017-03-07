<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Category\Controllers;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\AddonController;
use Marketplace\Addons\Category\Models\CategoryModel;

/**
 * Kazist view class for the application
 *
 * @since  1.0
 */
class CategoryController extends AddonController {

    function indexAction($offset = 0, $limit = 6) {

        $model = new CategoryModel;


        $categories = $model->getCategories();
        $default_category_id = $model->getDefaultCategory($categories);

        $data_arr['categories'] = $categories;
        $data_arr['default_category_id'] = $default_category_id;

        $this->html = $this->render('Marketplace:Addons:Category:views:category.twig', $data_arr);

        $response = $this->response($this->html);



        return $response;
    }

}
