<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Latestadverts\Models;

use Kazist\KazistFactory;
use Kazist\Service\Database\Query;
use Marketplace\Adverts\Code\Models\AdvertsModel AS AdvertsMainModel ;

class LatestadvertsModel {

    public $block_id = '';

    public function getInfo() {
        return 'Hello World!';
    }

    public function getLatestAdverts($category_id = '', $limit = '') {

        $factory = new KazistFactory;
        $advertModel = new AdvertsMainModel();

        $limit = ($limit) ? $limit : $factory->getSetting('job.block.latestadverts.limit', $this->flexview_id);

        $query = $this->getQuery($category_id);

        $query->setFirstResult(0);
        $query->setMaxResults(3);

        $records = $query->loadObjectList();
        $records = $advertModel->getAdditionalDetail($records);
        return $records;
    }

    public function getAdvertCategories() {

        $query = new Query();

        $query->select('mc.*, (SELECT COUNT(*) FROM #__marketplace_adverts WHERE category_id = mc.id) AS counter');
        $query->from('#__marketplace_categories', 'mc');
        $query->having('counter>4');
        $query->where('mc.published=1');
        $query->orderBy('counter', 'DESC');

        $query->setFirstResult(0);
        $query->setMaxResults(8);

        $records = $query->loadObjectList();

        return $records;
    }

    public function getQuery($category_id = '') {
        $factory = new KazistFactory;

        if (!$category_id) {
            $category_id = $factory->getSetting('job.block.latestadverts.category', $this->flexview_id);
        }

        $query = new Query();

        $query->select('ma.*,mc.title AS category_title, mm.file as advert_image, uu.name as author_name');
        $query->from('#__marketplace_adverts', 'ma');
        $query->leftJoin('ma', '#__marketplace_categories', 'mc', 'ma.category_id = mc.id');
        $query->leftJoin('ma', '#__media_media', 'mm', 'mm.id = ma.image');
        $query->leftJoin('ma', '#__users_users', 'uu', 'uu.id = ma.created_by');

        $query->where('ma.published=1');
        if ((int) $category_id) {
            $query->andwhere('ma.category_id=:category_id');
            $query->setParameter('category_id', $category_id);
        }
        $query->orderBy('ma.payment_status', 'DESC');
        $query->orderBy('ma.date_created', 'DESC');

        return $query;
    }

}
