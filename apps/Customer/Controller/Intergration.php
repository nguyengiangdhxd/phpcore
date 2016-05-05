<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/12/2015
 * Time: 9:48 AM
 */

namespace Customer\Controller;

use Core\CustomerAuth;
use Core\IntergrationApp\Factory;
use Exception;



# các xử thao tác xử lý với bizwebdđược viết ở đây
# tại đây xử lý các vấn đề check login của , xác nhận kết nối
# đẩy dữ liệu cần thiết
# su các phương thức đã viết trong library/BizWeb
class Intergration extends CustomerBase{

    #region -- Quy trình tích hợp các hệ thống khác --

    /**
     * Action mặc định sẽ nhận diện việc tích hợp với đối tượng nào để xử lý
     * @author kiennx
     */
    public function executeDefault() {
        $app_key = $this->get('app_key');

        if (empty($app_key)) {
            throw new \Exception("App key could not be blank");
        }

        $app = Factory::createApplication($app_key); // nếu app_key bằng bizweb thì cài bizweb , nếu là haravan thì cài haranvan
        $isConfirmed = $app->isConfirmed($this);

        if (!$isConfirmed) {
            $this->setLayout('blank');
            $this->setView('Intergration/install_app');
            $this->view()->assign([
                'customer' => CustomerAuth::getInstance()->getCustomer(),
                'app_data' => $app->getConfirmData($this)
            ]);
            return $this->renderComponent();
        }

        $url = $app->createAuthorizeUrl($this);
        $this->redirect($url);
        return null;
    }

    /**
     * Lưu thông tin Authorize
     * @author kiennx
     */
    public function executeAuthorize() {
        $app_key = $this->request()->get('app_key');

        if (empty($app_key)) {
            throw new \Exception("App key could not be blank");
        }

        $app = Factory::createApplication($app_key);
        $app->authorize($this);
    }

    public function executeConfirm() {
        $this->setLayout('blank');
        $this->setView('Intergration/install_app');
        /*$this->view()->assign([
            'customer' => CustomerAuth::getInstance()->getCustomer(),
            'app_data' => $app->getConfirmData($this)
        ]);*/
        return $this->renderComponent();
    }
    #endregion

}