<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 12/24/15
 * Time: 12:18
 */

namespace Core\Items;


class SalePriceFileAnalyser
{
    /** @var \PHPExcel_Reader_IReader */
    protected $_PHPExcel_Reader;

    /** @var  \PHPExcel */
    protected $_PHPExcel;

    /** @var string $file */
    protected $_file;

    /** @var null|string base store directory */
    protected $_base_dir;

    /**
     * excel's content
     * @var array
     */
    protected $_content;

    public function __construct($file_path, $base_dir = null)
    {
        $this->_file = $file_path;
        $this->_base_dir = ($base_dir)? $base_dir : RUNTIME_PATH .'/sale_prices_file/';
    }

    /**
     * Get file path
     *
     * @return string
     */
    public function getFilePath() {
        return rtrim($this->getBaseDir(), '/') .'/' .$this->_file;
    }

    /**
     * Mapping excel structures with data
     *
     * @return array
     */
    public function getMapping() {
        return [
            0 => 'setFileDataItemTitle',    //cột 1 tiêu đề sản phẩm
            1 => 'setFileDataItemTags',     //cột 2 tags sản phẩm
            7 => 'setFileDataVariantSku',   //cột 8 sku của variant
            8 => 'setFileDataVariantId',    //cột 9 mongoId của variant
            11 => 'setFileDataVariantSalePrice',  //cột 11 giá bán sản phẩm
            13 => 'setFileDataItemId'        //cột 14 Id sản phẩm
        ];
    }

    /**
     * Get base dir storing file
     *
     * @return string
     */
    public function getBaseDir() {
        return $this->_base_dir;
    }

    /**
     * Parsing excel sale price content
     *
     * @return SalePriceFileParsedResult
     */
    public function parse() {
        //validate file first
        $this->validate();

        $content = (array) $this->getContent();
        $mapping = $this->getMapping();

        //list manager
        $result = new SalePriceFileParsedResult();
        $content = array_slice($content, 1); //skip table header
        foreach($content as $row) {
            $parsingResult = new SalePriceFileParsedRowResult();
            for($i = 0, $size = sizeof($row); $i < $size; ++$i) {
                if (isset($mapping[$i])) {
                    $parsingResult->{$mapping[$i]}($row[$i]);
                }
            }

            /*if(!$parsingResult->validate()) {//not need
                $result->totalError++;
            }*/
            $result->addRow($parsingResult);
            $result->totalRows++;
        }

        return $result;
    }

    /**
     * Validate files
     *
     * @param null $file_path
     */
    public function validate($file_path = null) {
        if (!$file_path) {
            $file_path = rtrim($this->getBaseDir(), '/') .'/' .$this->_file;
        }

        //check file exist;
        if (!file_exists($file_path)) {
            throw new \RuntimeException('File ' .$file_path .' not exist!');
        }
    }

    /**
     * Get excel file's content
     * @return array
     */
    public function getContent() {
        if (!$this->_content) {
            $this->_content = $this->getPHPExcel()
                ->getActiveSheet()
                ->toArray();
        }
        return $this->_content;
    }

    /**
     * Get PHPExcel handling excel data
     *
     * @return \PHPExcel
     * @throws \PHPExcel_Reader_Exception
     */
    public function getPHPExcel() {
        if (!$this->_PHPExcel) {
            $reader = $this->getPHPExcelReader();
            $this->_PHPExcel = $reader->load($this->getFilePath());
        }

        return $this->_PHPExcel;
    }

    /**
     * Get PHPReader
     *
     * @return \PHPExcel_Reader_IReader
     * @throws \PHPExcel_Reader_Exception
     */
    public function getPHPExcelReader() {
        if (!$this->_PHPExcel_Reader) {
            $this->_PHPExcel_Reader = \PHPExcel_IOFactory::createReaderForFile($this->getFilePath());
        }

        return $this->_PHPExcel_Reader;
    }

    /**
     * destruct object
     */
    public function __destruct() {
        $this->_content = [];
        $this->_PHPExcel = null;
        $this->_PHPExcel_Reader = null;
    }
}