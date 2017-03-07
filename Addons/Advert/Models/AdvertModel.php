<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Advert\Models;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\KazistFactory;
use Kazist\Service\Database\Query;
use Marketplace\Adverts\Code\Models\AdvertsModel;

class AdvertModel {

    public function getInfo() {
        return 'Hello World!';
    }

    public function getAdverts() {

        $advertModel = new AdvertsModel;
        $query = $this->getQuery();
        // print_r((string)$query); exit;

        $query->setFirstResult(1);
        $query->setMaxResults(3);

        $records = $query->loadObjectList();

        $records = $advertModel->getAdditionalDetail($records);

        return $records;
    }

    public function getQuery() {

        $query = new Query();

        $query->select('ma.*, mm.file as advert_image, uu.name as author_name');
        $query->from('#__marketplace_adverts', 'ma');
        $query->leftJoin('ma', '#__media_media', 'mm', ' mm.id = ma.image');
        $query->leftJoin('ma', '#__users_users', 'uu', 'uu.id = ma.created_by');
        $query->where('ma.published=1');
        $query->orderBy('ma.payment_status ', 'DESC');
        $query->addOrderBy('ma.date_created ', 'DESC');

        return $query;
    }

    public function getImages($record) {

        $query = new Query();

        $query->select(' mm.file as media_file, mm.title as media_title');
        $query->from('#__marketplace_adverts_images', 'mai');
        $query->leftJoin('mai', '#__media_media', 'mm', 'mm.id = mai.image');
        $query->where('mai.advert_id=:advert_id');
        $query->setParameter('advert_id', $record->id);

        $records = $query->loadObjectList();

        return $records;
    }

}
