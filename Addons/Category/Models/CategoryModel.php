<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Addons\Category\Models;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\KazistFactory;
use Kazist\Service\Database\Query;

class CategoryModel {

    public function getInfo() {
        return 'Hello World!';
    }

    public function getDefaultCategory($categories) {
        return $categories[0]->id;
    }

    public function getCategories($parent_id = '') {

        $query = $this->getQuery($parent_id);

        $records = $query->loadObjectList();

        if (!empty($records)) {
            foreach ($records as $key => $record) {
                $records[$key]->children = $this->getCategories($record->id);
            }
        }

        return $records;
    }

    public function getQuery($parent_id) {

        $query = new Query();

        $query->select('mc.*, uu.name as author_name');
        $query->from('#__marketplace_categories', 'mc');
        $query->leftJoin('mc', '#__users_users', 'uu', 'uu.id = mc.created_by');
        $query->where('mc.published=1');
        if ($parent_id) {
            $query->andWhere('mc.parent_id = :parent_id');
            $query->setParameter('parent_id', $parent_id);
        } else {
            $query->andWhere('mc.parent_id IS NULL OR mc.parent_id=0');
        }
        $query->orderBy('mc.title');

        return $query;
    }

}
