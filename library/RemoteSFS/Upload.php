<?php
namespace RemoteSFS;

class Upload {
    protected $_bucket;

    protected $_fileName = false;

    protected $_overwrite = false;

    protected $_url = null;

    protected $_file = null;

    protected $_transformation = array();

    public function __construct($_bucket) {
        $this->_bucket = $_bucket;
    }

    /**
     * @return mixed
     */
    public function getBucket()
    {
        return $this->_bucket;
    }

    /**
     * @param null $file
     */
    public function setFile($file)
    {
        $this->_file = realpath($file);
    }

    /**
     * @return null
     */
    public function getFile()
    {
        return $this->_file;
    }

    /**
     * @param boolean $fileName
     */
    public function setFileName($fileName)
    {
        $this->_fileName = $fileName;
    }

    /**
     * @return boolean
     */
    public function getFileName()
    {
        return $this->_fileName;
    }

    /**
     * @param null $url
     */
    public function setUrl($url)
    {
        $this->_url = $url;
    }

    /**
     * @return null
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @param boolean $overwrite
     */
    public function setOverwrite($overwrite)
    {
        $this->_overwrite = $overwrite;
    }

    /**
     * @return boolean
     */
    public function getOverwrite()
    {
        return $this->_overwrite;
    }

    /**
     * @return array
     */
    public function getTransformation()
    {
        return $this->_transformation;
    }

    public function addTransformation($method, $params) {
        if (is_array($params)) {
            $t = array();
            foreach ($params as $p => $v) {
                $t[] = "{$p}_{$v}";
            }
            $params = implode('-', $t);
        }

        $this->_transformation[] = array(
            'method' => $method,
            'params' => $params
        );
    }
} 