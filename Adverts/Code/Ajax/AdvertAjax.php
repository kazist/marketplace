<?php

/**
 * @copyright  Copyright (C) 2012 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Marketplace\Adverts\Ajax;

defined('KAZIST') or exit('Not Kazist Framework');

use Marketplace\Adverts\Models\AdvertModel;
use Kazist\KazistFactory;

/**
 * Dashboard Controller class for the Application
 *
 * @since  1.0
 */
class AdvertAjax {

    /**
     * Save functions
     *
     * @return  void
     *
     * @since   1.0
     * @throws  \RuntimeException
     */
    public function ajaxloadcategoryadverts() {

        $advertModel = new AdvertModel();
        echo $advertModel->loadBlockCategoryAdverts();
        exit;
    }

}
