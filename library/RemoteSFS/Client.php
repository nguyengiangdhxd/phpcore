<?php
namespace RemoteSFS;

use Flywheel\Config\ConfigHandler;

class Client {
    public $connectTimeout = 0;

    protected static $_instance;

    protected $_httpCode;

    protected $_httpHeader;

    protected $_response;
    protected $_rawResponse;

    protected $_secret;
    protected $_serviceUrl;

    private function __construct() {
        $config = ConfigHandler::get('sfs');
        if (!isset($config['service_url']) || null == $config['service_url']) {
            throw new \RuntimeException(get_class($this) .": config service_url not found!");
        }
        $this->setSecret($config['secret_key']);
        $this->setServiceUrl($config['service_url']);
    }

    /**
     * @return Client
     */
    public static function getInstance() {
        if (null == self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret) {
        $this->_secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getSecret() {
        return $this->_secret;
    }

    /**
     * @param mixed $serviceUrl
     */
    public function setServiceUrl($serviceUrl) {
        $this->_serviceUrl = $serviceUrl;
    }

    /**
     * @return mixed
     */
    public function getServiceUrl() {
        return $this->_serviceUrl;
    }

    /**
     * @return mixed
     */
    public function getHttpCode() {
        return $this->_httpCode;
    }

    /**
     * @return mixed
     */
    public function getHttpHeader()
    {
        return $this->_httpHeader;
    }

    /**
     * Get raw response not decode
     * @return mixed
     */
    public function getRawResponse() {
        return $this->_rawResponse;
    }

    /**
     * @return mixed
     */
    public function getResponse() {
        return $this->_response;
    }

    /**
     * uploading file to SFS
     * result:
     *  - width: image's width
     *  - height: image's height
     *  - mime: image's mime type
     *  - file: image's path after upload to sfs
     *  - url: image's url after upload
     *  - bucket: image's bucket name
     *
     * @param Upload $uploader
     * @throws \RuntimeException
     * @return mixed
     */
    public function upload($uploader) {
        $file = $uploader->getFile();
        $url = $uploader->getUrl();

        $mime = '';

        if (!$file && !$url) {
            throw new \RuntimeException(get_class($this) .":File or URL cannot be empty!");
        }

        if ($file && !$url) {
            $mime = $this->getMime($file);
        }

        if ($file) {
            $post['filedata'] = '@' .$file .';type=' .$mime;
        }

        if ($url) {
            $post['url'] = $url;
        }

        $post['bucket'] = $uploader->getBucket();
        $post['key'] = $this->getSecret();
        $post['use_filename'] = $uploader->getFileName();

        $option = array(
            'overwrite' => $uploader->getOverwrite()
        );

        $post['options'] = json_encode($option);

        if (($transform = $uploader->getTransformation())) {
            $post['transformation'] = json_encode($transform);
        }

        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $this->getServiceUrl() .'/upload');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->connectTimeout);
        curl_setopt($ch, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $this->_rawResponse = curl_exec($ch);
        $this->_response = json_decode($this->_rawResponse, true);

        $error = curl_errno($ch);
        $errorMess = curl_error($ch);
        if ($error) {
            throw new \RuntimeException("CURL Error: {$errorMess}[{$error}]");
        }

        $this->_httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // close curl resource to free up system resources
        curl_close($ch);

        return $this->_httpCode == 200;
    }

    public function getMime($file) {
        if (!file_exists($file)) {
            return null;
        }

        if (function_exists("finfo_file")) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
            $mime = finfo_file($finfo, $file);
            finfo_close($finfo);
            return $mime;
        } else if (function_exists("mime_content_type")) {
            return mime_content_type($file);
        } else if (!stristr(ini_get("disable_functions"), "shell_exec")) {
            // http://stackoverflow.com/a/134930/1593459
            $file = escapeshellarg($file);
            $mime = shell_exec("file -bi " . $file);
            return $mime;
        }

        return null;
    }

    /**
     * Get the header info to store.
     */
    function getHeader($ch, $header) {
        $i = strpos($header, ':');
        if (!empty($i)) {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->_httpHeader[$key] = $value;
        }
        return strlen($header);
    }
}