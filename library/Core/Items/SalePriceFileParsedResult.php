<?php
/**
 * Created by PhpStorm.
 * User: luuhieu
 * Date: 12/25/15
 * Time: 15:18
 */

namespace Core\Items;


class SalePriceFileParsedResult
{
    /** @var SalePriceFileParsedRowResult[]  */
    protected $_rows = [];

    public $totalRows = 0;

    public $totalError = 0;

    public function addRow(SalePriceFileParsedRowResult $row) {
        $this->_rows[] = $row;
    }

    public function getRows() {
        return $this->_rows;
    }
}