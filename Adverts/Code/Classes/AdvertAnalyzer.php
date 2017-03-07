<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Adverts\Code\Classes;

/**
 * Description of AdvertAnalyzer
 *
 * @author dedan
 */
use Kazist\Service\Database\Query;
use Kazist\KazistFactory;

class AdvertAnalyzer {

    //put your code here

    function processAdvertAnalyzer() {
        $this->activePaidAdverts();
        $this->deactivePaidAdverts();
    }

    function activePaidAdverts() {
        $factory = new KazistFactory();

        $query = $factory->getQueryBuilder('#__marketplace_adverts', 'ma');
        $query->where('payment_status=0');
        $query->andWhere('payment_expiry>:payment_expiry');
        $query->setParameter('payment_expiry', date('Y-m-d H:i:s'));

        $records = $query->loadObjectList();

        foreach ($records as $key => $record) {
            $data = new \stdClass();
            $data->id = $record->id;
            $data->payment_status = 1;
            $factory->saveRecord('#__marketplace_adverts', $data);
        }
    }

    function deactivePaidAdverts() {
        $factory = new KazistFactory();

        $query = $factory->getQueryBuilder('#__marketplace_adverts', 'ma');
        $query->where('payment_status=1');
        $query->andWhere('payment_expiry<:payment_expiry OR payment_expiry IS NULL');
        $query->setParameter('payment_expiry', date('Y-m-d H:i:s'));

        $records = $query->loadObjectList();

        foreach ($records as $key => $record) {
            $data = new \stdClass();
            $data->id = $record->id;
            $data->payment_status = 0;
            $factory->saveRecord('#__marketplace_adverts', $data);
        }
    }

}
