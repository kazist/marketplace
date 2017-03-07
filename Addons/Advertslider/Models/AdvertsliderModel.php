<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Advertslider\Models;

use Kazist\KazistFactory;
use Kazist\Service\Json\Json;
use Kazist\Service\Database\Query;
use Marketplace\Adverts\Code\Models\AdvertsModel;

class AdvertsliderModel {

    public $block_id = '';

    public function getInfo() {
        return 'Hello World!';
    }

    public function getAdverts($package_id = 0, $limit = 10) {

        $advertModel = new AdvertsModel;

        $query = $this->getQuery($package_id);
        $query->setFirstResult(0);
        $query->setMaxResults($limit);

        $records = $query->loadObjectList();

        $records = $advertModel->getAdditionalDetail($records);

        return $records;
    }

    public function getQuery($package_id = 0) {

        $factory = new KazistFactory;

        $query = $factory->getQueryBuilder('#__marketplace_adverts', 'ma');

        $query->leftJoin('ma', '#__setup_currencies', 'ad_swc', 'ma.currency_id=ad_swc.country_id');

        $query->addSelect('ad_swc.code as currency_code');
        $query->addSelect('ad_swc.rate as currency_rate');
        $query->addSelect('ad_swc.buying as currency_buying');
        $query->addSelect('ad_swc.selling as currency_selling');

        $query->where('ma.image>0');

        if ((int) $package_id) {
            $query->andWhere('ma.package_id=' . $package_id);
        }

        $query->addOrderBy('ma.payment_status', 'DESC');
        $query->addOrderBy('ma.date_created', 'DESC');


        return $query;
    }

    public function getDefaultCurrency() {

        $factory = new KazistFactory;

        $currency_code = $factory->getSetting('setup_currency_default_code', $this->flexview_id);

        $query = $factory->getQueryBuilder('#__setup_currencies', 'sc');

        if ($currency_code <> '') {
            $query->where('sc.code=:code');
            $query->setParameter('code', $currency_code);
        } else {
            $query->where('sc.code=:code');
            $query->setParameter('code', 'USD');
        }

        $record = $query->loadObject();

        return $record;
    }

    public function getPackages() {

        $tmp_array = array();
        $factory = new KazistFactory;

        $query = $factory->getQueryBuilder('#__marketplace_packages', 'mp');

        $query->orderBy('mp.title');

        $records = $query->loadObjectList();

        if (!empty($records)) {
            foreach ($records as $key => $record) {
                $tmp_array[$record->id] = $record;
            }
        }

        return $tmp_array;
    }

}
