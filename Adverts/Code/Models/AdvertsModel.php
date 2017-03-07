<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Marketplace\Adverts\Code\Models;

defined('KAZIST') or exit('Not Kazist Framework');

use Kazist\Model\BaseModel;
use Kazist\KazistFactory;
use Kazist\Service\Email\Email;
use Marketplace\Adverts\Code\Classes\AdvertAnalyzer;
use Marketplace\Addons\LatestadvertsCode\Models\LatestadvertsModel;
use Kazist\Service\Database\Query;
use Kazist\Service\Media\MediaManager;

/**
 * Description of AdvertModel
 *
 * @author sbc
 */
class AdvertsModel extends BaseModel {

    public $redirect = '';

    public function appendSearchQuery($query) {

        $factory = new KazistFactory();
        $user = $factory->getUser();

        $package_id = $this->request->request->get('package_id');
        $category_id = $this->request->request->get('category_id');
        $view = $this->request->request->get('view');

        $query = parent::getQueryBuilder('#__marketplace_adverts', 'ma');

        if ($package_id) {
            $query->where('ma.package_id=' . $package_id);
        }
        if ($category_id) {
            $query->where('ma.category_id=' . $category_id);
        }
        if ($view = 'mylisting' && $user->id) {
            $query->where('ma.created_by=' . $user->id);
        }


        $query->orderBy('ma.payment_status ', 'DESC');
        $query->orderBy('ma.date_created ', 'DESC');

        return $query;
    }

    public function getAdditionalDetail($items) {

        $tmp_array = array();

        if (!empty($items)) {
            foreach ($items as $item) {

                $tmp_array[] = $this->getItemAdditionDetails($item);
            }
        }

        return $tmp_array;
    }

    public function getItemAdditionDetails($item) {

        $factory = new KazistFactory;

        $default_currency = $factory->getSetting('marketplace_adverts_default_currency');

        $item->images = $factory->getRecords('#__marketplace_adverts_images', 'mai', array('mai.advert_id = :advert_id'), array('advert_id' => $item->id));
        $item->package = $factory->getRecord('#__marketplace_packages', 'mp', array('mp.id = :id'), array('id' => $item->package_id));
        if ($item->currency_id) {
            $item->currency = $factory->getRecord('#__setup_currencies', 'sc', array('sc.id = :id'), array('id' => $item->currency_id));
        } else {
            $item->currency = $factory->getRecord('#__setup_currencies', 'sc', array('sc.code = :code'), array('code' => $default_currency));
        }

        return $item;
    }

    public function getAdvertImages($id) {

        $factory = new KazistFactory;

        $images = $factory->getRecords('#__marketplace_adverts_images', 'mai', array('mai.advert_id = :advert_id'), array('advert_id' => $id));

        return $images;
    }

    public function updateImages($uploaded_image_arr, $id) {

        $factory = new KazistFactory;

        foreach ($uploaded_image_arr as $key => $uploaded_image) {

            $data = new \stdClass();
            $data->title = '';
            $data->advert_id = $id;
            $data->image = $uploaded_image;

            $factory->saveRecord('#__marketplace_adverts_images', $data);
        }
    }

    public function updateMainImage($id) {

        $query = new Query();
        $factory = new KazistFactory;

        $query->select('vvm.*');
        $query->from('#__marketplace_adverts_images', 'vvm');
        $query->where('vvm.advert_id = ' . $id);
        $query->orderBy('vvm.id', 'ASC');
        $image = $query->loadObject();

        $data = new \stdClass();
        $data->id = $id;
        $data->image = $image->image;

        $factory->saveRecord('#__marketplace_adverts', $data);
    }

    public function updateMediaList($uploaded_image_arr, $unique_upload, $id) {

        $query = new Query();
        $factory = new KazistFactory;

        $query->select('mm.*');
        $query->from('#__media_media', 'mm');
        $query->where('mm.id IN (' . implode(',', $uploaded_image_arr) . ')');
        $medias = $query->loadObjectList();


        foreach ($medias as $key => $media) {

            $new_file = str_replace('temp/', $id . '/', $media->file);
            $new_file = str_replace($unique_upload . '/', '', $new_file);

            copy(JPATH_ROOT . $media->file, JPATH_ROOT . $new_file);
            unlink(JPATH_ROOT . $media->file);

            $data = new \stdClass();
            $data->id = $media->id;
            $data->file = $new_file;

            $factory->saveRecord('#__media_media', $data, array('id=:id'), array('id' => $data->id));
        }
    }

    public function uploadFile() {

        $factory = new KazistFactory;
        $media_manager = new MediaManager();

        $session = $this->container->get('session');
        $unique_upload = $this->request->get('unique_upload');

        $media_ids = array();
        $fileTypes = array('jpg', 'jpeg', 'gif', 'png');

        $uploaddir = 'uploads/' . str_replace('.', '/', 'marketplace.adverts.temp.' . $unique_upload);
        $upload_path = JPATH_ROOT . '/' . $uploaddir;

        $factory->makeDir($upload_path);

        if (!empty($this->request->files)) {
            foreach ($this->request->files as $name => $uploadedFile) {
                $original_name = preg_replace("/[^A-Za-z0-9.]/", '-', $uploadedFile->getClientOriginalName());
                $web_file = $uploaddir . '/' . $original_name;

                $upload_detail['name'] = $uploadedFile->getClientOriginalName();
                $upload_detail['title'] = $uploadedFile->getClientOriginalName();
                $upload_detail['description'] = $uploadedFile->getClientOriginalName();
                $upload_detail['route'] = 'marketplace.adverts';

                $upload_detail['file'] = $web_file;
                $upload_detail['extension'] = $uploadedFile->getClientOriginalExtension();
                $upload_detail['type'] = $media_manager->getFileType($upload_detail['extension']);
                $upload_detail['not_found'] = 0;


                if (in_array($upload_detail['extension'], $fileTypes)) {
                    $file = $uploadedFile->move($upload_path, $original_name);
                    $media_ids[] = $factory->saveRecordByEntity('#__media_media', $upload_detail);
                }
            }
        }

        if (!$session->has('uploaded_image_arr')) {
            $session->set('uploaded_image_arr', $media_ids);
        } else {

            $uploads = $session->get('uploaded_image_arr');
            $new_media_ids = (!is_array($uploads)) ? $media_ids : array_merge($uploads, $media_ids);

            $session->set('uploaded_image_arr', $new_media_ids);
        }
    }

    public function save($form) {

        $email = new Email();
        $factory = new KazistFactory;

        $default_gateway = $factory->getSetting('finance_gateway_default_gateway');

        $session = $this->container->get('session');
        $document = $this->container->get('document');
        $uploaded_image_arr = $session->get('uploaded_image_arr');

        $id = parent::save($form);

        $uploaddir = 'uploads/' . str_replace('.', '/', 'marketplace.adverts.' . $id);
        $upload_path = JPATH_ROOT . '/' . $uploaddir;
        $factory->makeDir($upload_path);

        if (!empty($uploaded_image_arr)) {
            $this->updateMediaList($uploaded_image_arr, $form['unique_upload'], $id);
            $this->updateImages($uploaded_image_arr, $id);
        }
        $this->updateMainImage($id);

        $session->remove('uploaded_image_arr');

        if (!WEB_IS_ADMIN) {

            $advert = $this->getAdvert($id);
            $package_price = $this->getPackagePrice($advert->package_price_id);

            $advert->payment_price = $package_price->price;
            $msg = 'Advert Save Successfully.';

            $factory->saveRecord('#__marketplace_adverts', $advert);


            if ($advert->payment_price && !$advert->payment_status) {

                $msg .= ' Proceed With Payment.';

                $factory->enqueueMessage($msg, 'info');

                $this->redirect = $this->generateUrl('finance.payments.newpayment', array(
                    'path' => 'marketplace.adverts',
                    'gateway_id' => $default_gateway,
                    'pay_subset_id' => $document->subset_id,
                    'amount' => $advert->payment_price,
                    'item_id' => $advert->id,
                    'description' => 'Advert: ' . $form['title']
                ));
            }

            if (!$form['id']) {
                $owner = $factory->getUser();
                $admins = $factory->getRecords('#__users_users', 'uu', array('is_admin=1'));
                $params = $factory->getRecord('#__marketplace_adverts', 'ma', array('id=:id'), array('id' => $id));

                $email->sendDefinedLayoutEmail('marketplace.adverts.owner.addnew', $owner->email, $params);
                $email->sendDefinedLayoutEmail('marketplace.adverts.admin.addnew', $admins, $params);
            }
        }

        return $id;
    }

    public function getPackages() {

        $tmp_array = array();

        $query = new Query();
        $query->select('mp.*');
        $query->from('#__marketplace_packages', 'mp');
        $query->orderBy('mp.id', 'ASC');

        $records = $query->loadObjectList();

        foreach ($records as $record) {
            $record->prices = $this->getPrices($record->id);
            $tmp_array[$record->id] = $record;
        }

        return $tmp_array;
    }

    public function getPrices($package_id) {


        $query = new Query();
        $query->select('mpp.*');
        $query->from('#__marketplace_packages_prices', 'mpp');
        $query->where('mpp.package_id=' . $package_id);
        $query->orderBy('mpp.price', 'ASC');

        $records = $query->loadObjectList();

        return $records;
    }

    /**
     * 
     * @param array $form
     * @return type
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     */
    public function saveAdvert($form) {


        $factory = new KazistFactory();
        $session = $factory->getSession();
        $kazi_url = $session->get('kazi_url');

        $form['published'] = ($form['id']) ? $form['published'] : 1;

        $id = $factory->saveRecord('#__marketplace_adverts', $form);

        if ($id) {
            $advert = $this->getAdvert($id);
            $package_price = $this->getPackagePrice($advert->package_price_id);

            $advert->payment_price = $package_price->price;
            $msg = 'Advert Save Successfully.';

            $factory->saveRecord('#__marketplace_adverts', $advert);

            if ($advert->payment_price && !$advert->payment_status) {
                $msg .= ' Proceed With Payment.';
                $factory->enqueueMessage($msg, 'info');
                $redirect = $this->generateUrl('finance.payments.newpayment', array(
                    'app_id' => $kazi_url->app_id,
                    'com_id' => $kazi_url->com_id,
                    'subset_id' => $kazi_url->subset_id,
                    'item_id' => $id,
                    'amount' => $advert->payment_price,
                    'description' . 'Advert: ' . $form['title']
                ));
            } else {
                $factory->enqueueMessage($msg, 'info');
                $redirect = $this->generateUrl('marketplace.adverts.detail', array('id', $id));
            }

            $this->saveAdvertPhotos($id);
        } else {

            $msg = 'Saving Advert Failed.';
            $factory->enqueueMessage($msg, 'info');
            $redirect = $this->generateUrl('marketplace.adverts.edit');
        }

        return $redirect;
    }

    public function saveAdvertPhotos($advert_id) {

        $advert_analyzer = new AdvertAnalyzer();
        $factory = new KazistFactory();

        $media_ids = $factory->uploadMedia('photo');

        if (!empty($media_ids)) {

            foreach ($media_ids as $media_id) {
                $std_class = new \stdClass();

                $std_class->advert_id = $advert_id;
                $std_class->image = $media_id;

                $factory->saveRecord('#__marketplace_adverts_images', $std_class);
            }

            $advert_analyzer->updateAdvertImageFromList($advert_id);
        }
    }

    public function sendMessage($form) {
        $tmp_array = array();
        $factory = new KazistFactory();
        $email = new Email();

        if ($this->sendMessageValidator($form)) {

            $tmp_array['advert'] = $this->getAdvert($form['advert_id']);
            $tmp_array['user'] = $this->getAdvertOwner($tmp_array['advert']->created_by);
            $tmp_array['message'] = $form;

            $email->sendDefinedLayoutEmail('marketplace.adverts.sendmessage', $tmp_array['user']->email, $tmp_array);
            $email->sendDefinedLayoutEmail('marketplace.adverts.sendmessage.thankyou', $form['email'], $tmp_array);

            $factory->saveRecord('#__marketplace_adverts_messages', $form);
        }
    }

    public function sendMessageValidator($form) {
        $is_valid = true;

        return $is_valid;
    }

    public function getAdvertPhotos($advert_id) {

        $factory = new KazistFactory();



        $user_id = $this->request->request->get('user_id');
        $limit = $this->request->request->get('limit', 10);
        $offset = $this->request->request->get('offset', 0);

        $query = new Query();
        $query->select('mm.file, mm.title');
        $query->from('#__marketplace_adverts_images', 'mmp');
        $query->leftJoin('mmp', '#__media_media', 'mm', 'mm.id = mmp.image');

        if ($advert_id) {
            $query->where('mmp.advert_id=:advert_id');
            $query->setParameter('advert_id', $advert_id);
        } else {
            $query->where('1=-1');
        }

        $query->orderBy('mmp.id ', 'DESC');



        $records = $query->loadObjectList();


        return $records;
    }

    public function getPackagePrice($package_price_id) {

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('mpp.*');
        $query->from('#__marketplace_packages_prices', 'mpp');

        if ($package_price_id) {
            $query->where('mpp.id=:id');
            $query->setParameter('id', $package_price_id);
        } else {
            $query->where('1=-1');
        }



        $records = $query->loadObject();


        return $records;
    }

    public function getAdvertOwner($created_by) {

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('uu.*');
        $query->from('#__users_users', 'uu');
        if ($created_by) {
            $query->where('id=:id');
            $query->setParameter('id', $created_by);
        } else {
            $query->where('1=-1');
        }



        $record = $query->loadObject();

        return $record;
    }

    public function getAdvert($advert_id) {

        $factory = new KazistFactory();

        $session = $factory->getSession();

//$email->debug_exit = true;
        $uri = $session->get('uri');

        $query = new Query();
        $query->select('ma.*');
        $query->from('#__marketplace_adverts', 'ma');
        if ($advert_id) {
            $query->where('id=:id');
            $query->setParameter('id', $advert_id);
        } else {
            $query->where('1=-1');
        }



        $record = $query->loadObject();
        $record->url = $this->generateUrl('marketplace.adverts.detail', array('id', $advert_id));

        return $record;
    }

    public function getCategories($parent_id = '') {

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('mc.*');
        $query->from('#__marketplace_categories', 'mc');
        if ($parent_id) {
            $query->where('parent_id=:parent_id');
            $query->setParameter('parent_id', $parent_id);
        }
        $query->orderBy('mc.id ', 'DESC');



        $records = $query->loadObjectList();

        if (!empty($records)) {
            foreach ($records as $key => $record) {
                $records[$key]->children = $this->getCategories($record->id);
            }
        }

        return $records;
    }

    public function getPackagePrices() {

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('mpp.*');
        $query->from('#__marketplace_packages_prices', 'mpp');
        $query->orderBy('mpp.id ', 'DESC');



        $records = $query->loadObjectList();

        return $records;
    }

    public function getCountries() {

        $tmparray = array();

        $factory = new KazistFactory();


        $query = new Query();
        $query->select('swc.id AS value, swc.name AS text');
        $query->from('#__setup_countries', 'swc');
        $query->orderBy('swc.id ', 'DESC');



        $records = $query->loadObjectList();

        if (!empty($records)) {
            foreach ($records as $record) {
                $tmparray[] = array('value' => $record->value, 'text' => $record->text);
            }
        }

        return $tmparray;
    }

    public function getTopFeaturedAdverts() {

        $package_id = $this->request->request->get('package_id');
        $category_id = $this->request->request->get('category_id');

        $query = $this->getQueryBuilder('#__marketplace_adverts', 'ma');

        $query->orderBy('ma.date_created ', 'DESC');

        if ($package_id) {
            $query->where('ma.package_id=:package_id');
            $query->setParameter('package_id', $package_id);
        }
        if ($category_id) {
            $query->where('ma.category_id=:category_id');
            $query->setParameter('category_id', $category_id);
        }

        $query->setFirstResult(0);
        $query->setMaxResults(10);

        $records = $query->loadObjectList();

        return $this->getAdditionalDetail($records);
    }

    public function loadBlockCategoryAdverts() {

        $paths = array();

        $object_arr = new \stdClass();
        $factory = new KazistFactory();
        $latestadverts_model = new LatestadvertsModel();



        $category_id = $this->request->request->get('category_id');

        $object_arr->adverts = $latestadverts_model->getLatestAdverts($category_id, 3);

        $template = 'category.adverts.twig';
        $paths[] = JPATH_ROOT . '/applications/Marketplace/Addons/Latestadverts/views';

        $html = $factory->renderData($object_arr, $template, $paths);


        return $html;
    }

    public function processAdvertAnalyzer() {

        $advertAnalyzer = new AdvertAnalyzer();
        $advertAnalyzer->processAdvertAnalyzer();
    }

}
