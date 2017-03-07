<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Menuadvert\Models;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\KazistFactory;
use Marketplace\Adverts\Code\Models\AdvertsModel AS AdvertsMainModel ;

class MenuadvertModel {

    public function getInfo() {
        return 'Hello World!';
    }

    public function getAdverts() {

        $factory = new KazistFactory();
$advertModel = new AdvertsMainModel();

        $query = $factory->getQueryBuilder('marketplace_adverts', 'ma');

        $query->where('ma.published=1');
        $query->having('ma.image<>\'\'');
        $query->orderBy('ma.payment_status', 'DESC');
        $query->orderBy('ma.date_created', 'DESC');

        $query->setFirstResult(0);
        $query->setMaxResults(4);

        $records = $query->loadObjectList();

        $records = $advertModel->getAdditionalDetail($records);


        return $records;
    }

}
