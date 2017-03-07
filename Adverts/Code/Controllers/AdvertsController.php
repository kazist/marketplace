<?php

/*
 * This file is part of Kazist Framework.
 * (c) Dedan Irungu <irungudedan@gmail.com>
 *  For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 * 
 */

/**
 * Description of AdvertsController
 *
 * @author sbc
 */

namespace Marketplace\Adverts\Code\Controllers;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\BaseController;
use Marketplace\Adverts\Code\Models\AdvertsModel;
use Kazist\KazistFactory;

class AdvertsController extends BaseController {

    public function indexAction($offset = 0, $limit = 10) {

        $featured_items = $this->model->getTopFeaturedAdverts();
        $items = $this->model->getRecords($offset = 0, $limit = 10);

        $items = $this->model->getAdditionalDetail($items);
        $featured_items = $this->model->getAdditionalDetail($featured_items);

        $this->data_arr['view'] = $this->request->get('view');
        $this->data_arr['items'] = $items;
        $this->data_arr['featured_items'] = $featured_items;

        return parent::indexAction($offset, $limit);
    }

    public function addAction($id = '') {

        define('UNIQUE_UPLOAD', uniqid());

        $this->data_arr['advert_images'] = $this->model->getAdvertImages($id);
        $this->data_arr['packages'] = $this->model->getPackages();

        $this->setAdditionalData();

        return parent::addAction($id);
    }

    public function editAction($id = '') {

        define('UNIQUE_UPLOAD', uniqid());

        $this->data_arr['advert_images'] = $this->model->getAdvertImages($id);
        $this->data_arr['packages'] = $this->model->getPackages();

        $this->setAdditionalData();

        return parent::editAction($id);
    }

    public function detailAction($id = "") {


        $this->model = new AdvertsModel();

        $item = $this->model->getRecord($id);

        $photos = $this->model->getAdvertPhotos($item->id);
        $item = $this->model->getItemAdditionDetails($item);

        $this->data_arr['view'] = $this->request->get('view');
        $this->data_arr['photos'] = $photos;
        $this->data_arr['item'] = $item;
        $this->data_arr['packages'] = $this->model->getPackages();

        return parent::detailAction($id);
    }

    public function saveAction($form_data = '') {

        $unique_upload = $this->request->get('unique_upload');

        if ($unique_upload <> '') {
            $this->model->uploadFile();
            exit;
        }

        if (WEB_IS_ADMIN) {
            return parent::saveAction($form_data);
        } else {

            $form_data = $this->request->request->get('form');

            $id = $this->model->save($form_data);

            if ($this->model->redirect <> '') {
                return $this->redirect($this->model->redirect);
            } else {
                return $this->redirectToRoute('marketplace.adverts.detail', array('id' => $id));
            }
        }
    }

    public function deleteAction($id = 0) {

        $kazifactory = new KazistFactory();

        $advert_id = $this->request->get('advert_id');

        if ($advert_id) {
            $id = $this->request->get('id');
            $kazifactory->deleteRecords('#__marketplace_adverts_images', array('id=:id'), array('id' => $id));

            $this->model->updateMainImage($advert_id);

            return $this->redirectToRoute('marketplace_adverts.edit', array('id' => $advert_id));
        } else {
            parent::deleteAction($id);
        }
    }

    public function sendmessageAction() {


        $form = $this->request->request->get('form');

        $this->model = new AdvertsModel();
        $this->model->sendMessage($form);

        return $this->redirectToRoute('marketplace.adverts.detail', array('id'=>$form['advert_id']));
    }

    public function setAdditionalData() {

        $kazifactory = new KazistFactory();

        $this->data_arr['remove_image_url'] = $kazifactory->generateUrl('marketplace.adverts.delete');
        $this->data_arr['save_url'] = $kazifactory->generateUrl('marketplace.adverts.save');
    }

    public function cronadvertanalyzerAction() {

        $this->model = new AdvertsModel();
        $this->model->processAdvertAnalyzer();

        return $this->redirectToRoute('home');
    }

}
