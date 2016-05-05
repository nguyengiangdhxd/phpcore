<?php
namespace Customer\Controller;
use Customer\Library\CustomerAppAuth;
use Flywheel\Controller\Web;
use Flywheel\Base;
use Toxotes\Content;
use Toxotes\Plugin;
abstract class CustomerBase extends Web{

    public static $language;
    protected static $_user;

    public $_need_login = true;


    public function beforeExecute(){
        parent::beforeExecute();

        if ($this->_need_login == true) {

            $auth = CustomerAppAuth::getInstance();

            if (!$auth->isAuthenticated()) {
                if ($this->request()->isXmlHttpRequest()) {
                    Base::end(json_encode(array(
                        'type' => 0,
                        'error' => 'AUTHENTICATE FAIL',
                        'error_code' => 'E0001',
                        'message' => t('Bạn phải đăng nhập !')
                    )));
                } else {
                    //redirect
                    $this->redirect($this->createUrl('/login', array(
                        'r' => urlencode($this->request()->getUri())
                    )));
                }
            }
        }
        $this->_initTemplate();
    }

    /**
     * Get customer login object
     *
     * @return \Customer
     */
    public function customerLogin() {
        $auth = CustomerAppAuth::getInstance();
        return $auth->getCustomer();
    }

    /**
     * load các include trong template_init
     */
    private function _initTemplate()
    {
        include_once $this->getTemplatePath().DIRECTORY_SEPARATOR.'template_init.php';

        //init js
       # $this->document()->addJs('js/process/common.js');
    }

    /**
     * 404 not found
     *
     * @param null $message
     * @return null
     */
    public function raise404($message = null) {
        #return null;
        return $this->redirect('/khong-thay-trang');
    }

    /**
     * 403 not allow
     *
     * @param null $message
     * @return null
     */
    public function raise403($message = null) {
        return null;
    }

    protected function _registerDefaultTaxonomies() {
        Plugin::registerTaxonomy('category', 'post', array(
            'label' => t('Category'),
            'enable_custom_fields' => true,
        ));

        Plugin::registerTaxonomy('banner', 'post', array(
            'label' => t('Banner'),
            'enable_custom_fields' => false,
        ));

        Plugin::registerTaxonomy('post', 'post', array(
            'label' => t('Post')
        ));

        Plugin::addFilter('term_property_form_category', function() {
            Content::addTermPropertyOpt('cat_view', [
                'label' => t('Category view'),
                'control' => 'select',
                'options' => Content::getCategoryTemplates()
            ], 'category');

            Content::addTermPropertyOpt('post_ordering', [
                'label' => t('Posts ordering'),
                'control' => 'select',
                'options' => [
                    [
                        'label' => t('Created time'),
                        'value' => 'created_time'
                    ],
                    [
                        'label' => t('Publish time'),
                        'value' => 'publish_time'
                    ],
                    [
                        'label' => t('Modified time'),
                        'value' => 'modified_time'
                    ],
                    [
                        'label' => t('Post order'),
                        'value' => 'ordering'
                    ],
                    [
                        'label' => t('Hit'),
                        'value' => 'hits'
                    ]
                ]
            ], 'category');

            Content::addTermPropertyOpt('page_size', [
                'label' => t('Page size'),
                'control' => 'input',
                'type' => 'text',
                'placeholder' => t('Number per page')
            ], 'category');

            Content::addTermPropertyOpt('post_view', [
                'label' => t('Post view'),
                'control' => 'select',
                'options' => Content::getPostTemplates()
            ], 'category');
        });
    }
}
