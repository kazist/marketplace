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

namespace Marketplace\Adverts\Code\Controllers\Admin;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Controller\BaseController;
use Kazist\KazistFactory;

class AdvertsController extends BaseController {

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

    public function saveAction($form_data = '') {

        $unique_upload = $this->request->get('unique_upload');

        if ($unique_upload <> '') {
            $this->model->uploadFile();
            exit;
        }

        return parent::saveAction($form_data);
    }

    public function deleteAction($id = 0) {

        $kazifactory = new KazistFactory();

        $advert_id = $this->request->get('advert_id');

        if ($advert_id) {
            $id = $this->request->get('id');
            $kazifactory->deleteRecords('#__marketplace_adverts_images', array('id=:id'), array('id' => $id));

            $this->model->updateMainImage($advert_id);

            return $this->redirectToRoute('admin.marketplace.adverts.edit', array('id' => $advert_id));
        } else {
            return parent::deleteAction($id);
        }
    }

    public function setAdditionalData() {

        $kazifactory = new KazistFactory();

        $this->data_arr['remove_image_url'] = $kazifactory->generateUrl('admin.marketplace.adverts.delete');
        $this->data_arr['save_url'] = $kazifactory->generateUrl('admin.marketplace.adverts.save');
    }

}
