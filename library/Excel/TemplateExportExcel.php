<?php
namespace Excel;
use Core\CustomerAuth;
use Mongodb\ConnectMongoDB;
use PHPExcel_Shared_Date;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Color;
use PHPExcel_Style_Fill;
use PHPExcel_Style_NumberFormat;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/26/2015
 * Time: 9:13 AM
 */

class TemplateExportExcel {

    public function beforeExecute()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 50000000);
    }

    public static function exportExcel($fields, $rows, $filename)
    {
        $objPHPExcel = new \PHPExcel();
        $sheet_index = 0;
        $row_index = 1;
        $col_index = null;
        #region thêm style cho excel

        $objPHPExcel_tmp = $objPHPExcel->setActiveSheetIndex($sheet_index);

        #end thêm mới excel cho sản phẩm


        if (is_array($fields) && count($fields)) {
            foreach ($fields as $key => $col_index_name) {
                $col_index = self::getNextCol($col_index);
                $objPHPExcel_tmp->setCellValue($col_index . $row_index, $col_index_name);
            }
        }

        /*
         * Ghi d? li?u
         */
        if (is_array($rows) && count($rows)) {
            foreach ($rows as $row_data) {
                $col_index = null;
                $row_index++;
                if(is_array($row_data) && count($row_data)) {
                    foreach($row_data as $cell_data) {
                        $objPHPExcel_tmp->setCellValue(self::getNextCol($col_index) . $row_index, $cell_data);
                    }
                }
            }
        }


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0


        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit();
    }

    /**
     * @param $col
     * @return null|string
     */
    public static function getNextCol(&$col)
    {
        $alphabets = array(
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"
        );



        if (is_null($col)) {
            $col = "A";
            return $col;
        }

        if (in_array($col, $alphabets)) {
            foreach ($alphabets as $key => $value) {
                if ($value == $col) {
                    if (isset($alphabets[$key + 1])) {
                        $col = $alphabets[$key + 1];
                        return $col;
                    }
                }
            }
        }

        return null;
    }


    /**
     * xuất excel cho itemd
     * @param $filename
     * @param array $conditional
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    public static function exportExcelProduct($filename, $conditional = [])
    {

        $objPHPExcel = new \PHPExcel();
        $sheet_index = 0;
        $cel_index = 1;
        $styleRow = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => ''),
                'size'  => 11,
                'name'  => 'Times New Roman'
            ));
        foreach(array('A1','B1','C1','D1','E1','F1','G1','H1', 'I1', 'J1', 'K1', 'L1', 'M1','N1') as $itemHeader){
            $objPHPExcel->getActiveSheet()->getStyle($itemHeader)->applyFromArray($styleRow);
            $objPHPExcel->getActiveSheet()->getStyle($itemHeader)->applyFromArray( // màu cho row
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'c2d699'), // mau xanh cho row
                        'size'  => 12,
                    )
                )
            );

            $objPHPExcel->getActiveSheet()->getStyle($itemHeader)->getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'rotation'   => 0,
                    'wrap'       => true
                )
            );
        }
        $objPHPExcel->setActiveSheetIndex($sheet_index)
            ->setCellValue('A1', 'Tên sản phẩm')
            ->setCellValue('B1', 'Tags sản phẩm')
            ->setCellValue('C1', 'Link gốc')
            ->setCellValue('D1', 'Người Bán')
            ->setCellValue('E1', 'Website')
            ->setCellValue('F1', 'Địa điểm đăng bán')
            ->setCellValue('G1', 'Mẫu')
            ->setCellValue('H1', 'SKU')
            ->setCellValue('I1', 'ID mẫu')
            ->setCellValue('J1', 'Giá thấp nhất (CNY)')
            ->setCellValue('K1', 'Giá cao nhất (CNY)')
            ->setCellValue('L1','Giá bán (VND)')
            ->setCellValue('M1','Lần cập nhật cuối từ nguồn')
            ->setCellValue('N1','ID sản phẩm')
        ;


        #region thêm độ rộng trên excel
        foreach(range('B','M') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }
        /**
         * thêm cỡ chữ và định dạng cho content
         */
        $styleRowContent = array(
            'font'  => array(
                'color' => array('rgb' => ''),
                'size'  => 11,
                'name'  => 'Times New Roman'
            ));
        foreach(array('A','B','C','D','E','F','G','H', 'I', 'J', 'K', 'L', 'M','N') as $rows) {
            $objPHPExcel->getActiveSheet()
                ->getStyle($rows)
                ->getAlignment()
                ->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getStyle($rows)->applyFromArray($styleRowContent);
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30); // set độ cao cho header
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(50);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30); // cột id sản phẩm cuối cùng
        }
        #endregion
        $limit = 300;
        $dataItems = ItemHelper::executeGetItems($conditional, $limit); // giá trị set lại sau
        if(is_array($dataItems) && count($dataItems) > 0) {
            foreach ($dataItems as $item) {
                /** @var $item \Mongodb\Items */
                $dataVariants = ItemHelper::executeGetItemsVariant($item);
                foreach ($dataVariants as $itemVariant) {
                    $cel_index++;
                    /** @var  $itemVariant \Mongodb\ItemVariant */
                    $optionKeys = $itemVariant->getOptKeys();
                    $optionKey = [];
                    foreach ($optionKeys as $key => $val) {
                        $optionKey[] = $val['title'];
                    }
                    $lastTimeUpdateFromSource = $item->getLastUpdateFromSource()->format('H:i:s d/m/Y');
                    $objPHPExcel->setActiveSheetIndex($sheet_index)
                        ->setCellValue("A" . $cel_index, $item->getTitle() ? $item->getTitle() : $item->getTitleOrigin())
                        ->setCellValue("B" . $cel_index, $item->getTagsProduct() ? implode(',',$item->getTagsProduct()) : '')
                        ->setCellValue("D" . $cel_index, $item->getSellerName())
                        ->setCellValue("E" . $cel_index, $item->getHomeLand())
                        ->setCellValue("F" . $cel_index, $item->getItemLocation())
                        ->setCellValue("G" . $cel_index, implode(',', $optionKey))
                        ->setCellValue("H" . $cel_index, $itemVariant->getSku() ? $itemVariant->getSku() : '')
                        ->setCellValue("I" . $cel_index, $itemVariant->getId()->{'$id'})
                        ->setCellValue('J' . $cel_index, ItemHelper::getMinPriceTable($itemVariant))
                        ->setCellValue("K" . $cel_index, ItemHelper::getMaxPriceTable($itemVariant))
                        ->setCellValue("L" . $cel_index, $itemVariant->getSalePrice() ? $itemVariant->getSalePrice() : '')
                        ->setCellValue('M' . $cel_index,$item->getLastUpdateFromSource() ? $lastTimeUpdateFromSource :'')
                        ->setCellValue("N" . $cel_index, $item->getId()->{'$id'});
                    #region --format theo kiểu số và thời gian--
                    $objPHPExcel->getActiveSheet()->getStyle('J' . $cel_index)->getNumberFormat()->setFormatCode('#,##0.0');
                    $objPHPExcel->getActiveSheet()->getStyle('K' . $cel_index)->getNumberFormat()->setFormatCode('#,##0.0');
                    $objPHPExcel->getActiveSheet()->getStyle('L' . $cel_index)->getNumberFormat()->setFormatCode('#,##0.0');
                    #endregion --format theo kiểu số--
                    $objPHPExcel->getSheet($sheet_index)->getCellByColumnAndRow(0,1)->getHyperlink()->setUrl($item->getOriginalLink());
                    $objPHPExcel->getActiveSheet()->setCellValue('C'. $cel_index, 'Link gốc');
                    $objPHPExcel->getActiveSheet()->getCell('C'. $cel_index)->getHyperlink()->setUrl($item->getOriginalLink());
                    $objPHPExcel->getActiveSheet()->getCell('C'. $cel_index)->getHyperlink()->setTooltip('Link gốc sản phẩm');

                    $styleArray = array(
                        'font'  => array(
                            'bold'  => true,
                            'color' => array('rgb' => '#0086b3'),
                            'size'  => 11,
                            'name'  => 'Times New Roman'
                        ));
                    $objPHPExcel->getActiveSheet()->getStyle('C'. $cel_index)->applyFromArray($styleArray);
                }
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * hàm xác định border của khối excel
     * @var array
     */
    private static $default_style =  array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        )
    );
    /**
     * viết hộ
     */
    public static function executeExcelOrderHang(){

        $objPHPExcel = new \PHPExcel();
        $sheet_index = 0;
        $cel_index = 16; // vì dữ liệu cứng lên để tạm 16 , khi có dât để thành 15

        #style cho khối ở trên cùng
        // merge cột
        $styleArray = self::$default_style;
        $objPHPExcel->getActiveSheet()->getStyle('A3:D13')->applyFromArray($styleArray); // taoj border cho tọa độ mình muốn
        // xét trong một khoảng

        #region merge các cột lại với nhau

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:D1');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:D2');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:C3');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A4:C4');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A5:C5');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A6:C6');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A7:C7');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A8:C8');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A9:C9');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A10:D10');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A11:C11');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A12:C12');
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A13:C13');
        #end region merge các cột với nhau


     /*   foreach(array('A','B','C','D') as $rows) {
            $objPHPExcel->getActiveSheet()
                ->getStyle($rows)
                ->getAlignment()
                ->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20); // set độ cao cho header

        }*/

        $styleRowHeader = array( // mau cho chữ
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '0000'),
                'size'  => 11,
                'name'  => 'Times New Roman'
            ));
        foreach(array('A1','B1', 'C1', 'D1') as $value){
            $objPHPExcel->getActiveSheet()->getStyle($value)->applyFromArray($styleRowHeader);
            $objPHPExcel->getActiveSheet()->getStyle($value)->applyFromArray( // màu cho row
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'ffc000'), // mau vang cho row
                        'size'  => 12,
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle($value)->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            $objPHPExcel->getActiveSheet()->getStyle($value)->getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'rotation'   => 0,
                    'align' => 'middle',
                    'wrap'       => true
                )
            );
        }

        foreach(array('A2','B2', 'C2', 'D2') as $key){
            $objPHPExcel->getActiveSheet()->getStyle($key)->applyFromArray($styleRowHeader);
            $objPHPExcel->getActiveSheet()->getStyle($key)->applyFromArray( // màu cho row
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'ffc000'), // mau vang cho row
                        'size'  => 12,
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle($key)->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            $objPHPExcel->getActiveSheet()->getStyle($key)->getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'rotation'   => 0,
                    'wrap'       => true
                )
            );
        }

        foreach(array('A10','B10', 'C10', 'D10') as $itemHeaders){
            $objPHPExcel->getActiveSheet()->getStyle($itemHeaders)->applyFromArray($styleRowHeader);
            $objPHPExcel->getActiveSheet()->getStyle($itemHeaders)->applyFromArray( // màu cho row
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'ffc000'), // mau vang cho row
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle($itemHeaders)->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            $objPHPExcel->getActiveSheet()->getStyle($itemHeaders)->getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'rotation'   => 0,
                )
            );
        }

        $styleRow = array( // mau cho chữ
            'font'  => array(
                'bold'  => false,
                'color' => array('rgb' => '0000'),
                'size'  => 11,
                'name'  => 'Times New Roman'
            ));
        foreach(array('A8','B8', 'C8') as $i){
            $objPHPExcel->getActiveSheet()->getStyle($i)->applyFromArray($styleRow);
            $objPHPExcel->getActiveSheet()->getStyle($i)->applyFromArray( // màu cho row
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'cc99fe'), // mau vang cho row
                        'size'  => 11,
                    )
                )
            );

        }
        foreach(array('A9','B9', 'C9') as $j){
            $objPHPExcel->getActiveSheet()->getStyle($j)->applyFromArray($styleRow);
            $objPHPExcel->getActiveSheet()->getStyle($j)->applyFromArray( // màu cho row
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'cc99fe'), // mau vang cho row
                        'size'  => 11,
                    )
                )
            );
        }
        foreach(array('A13','B13', 'C13') as $k){
            $objPHPExcel->getActiveSheet()->getStyle($k)->applyFromArray($styleRow);
            $objPHPExcel->getActiveSheet()->getStyle($k)->applyFromArray( // màu cho row
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '008001'), // mau vang cho row
                        'size'  => 11,
                    )
                )
            );
        }


        $objPHPExcel->getActiveSheet()->getCell('A1')->setValue('TỔNG KẾT ĐƠN HÀNG CỦA KHÁCH');
        $objPHPExcel->getActiveSheet()->getCell('A2')->setValue('Các phí tính bằng NDT');
        $objPHPExcel->getActiveSheet()->getCell('A3')->setValue('Tổng tiền đơn hàng (NDT)');
        $objPHPExcel->getActiveSheet()->getCell('A4')->setValue('Bảo hiểm (NDT)');
        $objPHPExcel->getActiveSheet()->getCell('A5')->setValue('Phụ phí (NDT)');
        $objPHPExcel->getActiveSheet()->getCell('A6')->setValue('Tổng trả lại + bồi thường (NDT)');
        $objPHPExcel->getActiveSheet()->getCell('A7')->setValue('Tổng tiền công (NDT)');
        $objPHPExcel->getActiveSheet()->getCell('A8')->setValue('Tổng tiền tính NDT');
        $objPHPExcel->getActiveSheet()->getCell('A9')->setValue('Tỷ giá');
        $objPHPExcel->getActiveSheet()->getCell('A11')->setValue('Tổng phí VCQT (VNĐ)');
        $objPHPExcel->getActiveSheet()->getCell('A12')->setValue('Tổng phí đóng gỗ (VNĐ)');
        $objPHPExcel->getActiveSheet()->getCell('A13')->setValue('Tổng giá trị cần thanh toán (VNĐ)');
        $objPHPExcel->getActiveSheet()->getCell('A10')->setValue('Các phí tính bằng VNĐ');
        #end style cho khối ở trên cùng

        #region --xét dữ liệu vào trong excel--
        $objPHPExcel->getActiveSheet()->getCell('D3')->setValue(424.3);
        $objPHPExcel->getActiveSheet()->getCell('D4')->setValue(0);
        $objPHPExcel->getActiveSheet()->getCell('D5')->setValue(0);
        $objPHPExcel->getActiveSheet()->getCell('D6')->setValue(138);
        $objPHPExcel->getActiveSheet()->getCell('D7')->setValue(18);
        $objPHPExcel->getActiveSheet()->getCell('D8')->setValue(1305);
        $objPHPExcel->getActiveSheet()->getCell('D9')->setValue(7999);
        $objPHPExcel->getActiveSheet()->getCell('D11')->setValue(98945);
        $objPHPExcel->getActiveSheet()->getCell('D12')->setValue(3434);
        $objPHPExcel->getActiveSheet()->getCell('D13')->setValue(1124);


        #endregion --xét dữ liệu vào trongexcel--





        $styleRow = array( // mau cho chữ
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '1262bb'),
                'size'  => 11,
                'name'  => 'Times New Roman'
            ));


        foreach(array('A15','B15','C15','D15','E15','F15','G15','H15', 'I15', 'J15', 'K15', 'L15', 'M15','N15', 'O15', 'P15', 'Q15','R15') as $itemHeader){
            $objPHPExcel->getActiveSheet()->getStyle($itemHeader)->applyFromArray($styleArray);
            $objPHPExcel->getActiveSheet()->getStyle($itemHeader)->applyFromArray($styleRow);
            $objPHPExcel->getActiveSheet()->getStyle($itemHeader)->applyFromArray( // màu cho row
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '93ccdd'), // mau xanh cho row
                        'size'  => 12,
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle($itemHeader)->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


            $objPHPExcel->getActiveSheet()->getStyle($itemHeader)->getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'rotation'   => 0,
                    'wrap'       => true
                )
            );
        }
        foreach(array('E','F','G','H', 'I', 'J', 'K', 'L', 'M','N','O','P','Q','R') as $rows) {
            $objPHPExcel->getActiveSheet()
                ->getStyle($rows)
                ->getAlignment()
                ->setWrapText(true);
            $objPHPExcel->getActiveSheet()->getRowDimension('15')->setRowHeight(45); // set độ cao cho header
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension($rows)->setWidth(20);

            $objPHPExcel->getActiveSheet()->getStyle($rows)->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            $objPHPExcel->getActiveSheet()->getStyle($rows)->getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'rotation'   => 0,
                    'wrap'       => true
                )
            );
        }
        $objPHPExcel->setActiveSheetIndex($sheet_index)
            ->setCellValue('A15', 'Khách hàng')
            ->setCellValue('B15', 'Mã Shop')
            ->setCellValue('C15', 'Mã vận đơn')
            ->setCellValue('D15', 'Người Bán')
            ->setCellValue('E15', 'Mã sản phẩm')
            ->setCellValue('F15', 'Sản phẩm')
            ->setCellValue('G15', 'Color-size')
            ->setCellValue('H15', 'Số lượng')
            ->setCellValue('I15', 'Giá tệ/ 1 sp')
            ->setCellValue('J15', 'Phụ phí')
            ->setCellValue('K15', 'Tổng giá')
            ->setCellValue('L15','Tổng ship')
            ->setCellValue('M15','Tổng shop = Tổng đơn giá + Tổng phí VC')
            ->setCellValue('N15','Tổng trả lại')
            ->setCellValue('O15','Tổng bồi thường')
            ->setCellValue('P15','Trạng thái')
            ->setCellValue('Q15','Ghi chú')
            ->setCellValue('R15','Ghi chú')

        ;

        // border cho row

        #endregion
        /*$limit = 300;
        $conditional = [];
        $dataItems = self::executeGetItems($conditional, $limit); // giá trị set lại sau
        if(is_array($dataItems) && count($dataItems) > 0) {
            foreach ($dataItems as $item) {*/
                    $objPHPExcel->setActiveSheetIndex($sheet_index)
                        ->setCellValue("A" . $cel_index,  '')
                        ->setCellValue("B" . $cel_index,  'OCT-201-20-01001')
                        ->setCellValue("C" . $cel_index,  '安士迪旗舰店')
                        ->setCellValue("D" . $cel_index, 'http://world.tmall.com/item/')
                        ->setCellValue("E" . $cel_index,'6')
                        ->setCellValue("F" . $cel_index, '19.8')
                        ->setCellValue("G" . $cel_index, '')
                        ->setCellValue("H" . $cel_index, '118.8')
                        ->setCellValue("I" . $cel_index, '')
                        ->setCellValue('J' . $cel_index, '')
                        ->setCellValue("K" . $cel_index, '')
                        ->setCellValue("L" . $cel_index, '')
                        ->setCellValue('M' . $cel_index,'')
                        ->setCellValue("N" . $cel_index, '')
                        ->setCellValue("O" . $cel_index, '')
                        ->setCellValue("P" . $cel_index, '')
                        ->setCellValue("Q" . $cel_index, '')
                    ;
        $objPHPExcel->setActiveSheetIndex($sheet_index)
            ->setCellValue("A17",  '')
            ->setCellValue("B17", '')
            ->setCellValue("C17",  '')
            ->setCellValue("D17" , '')
            ->setCellValue("E17",'')
            ->setCellValue("F17", '')
            ->setCellValue("G17" , 6)
            ->setCellValue("H17" , '')
            ->setCellValue("I17", 0)
            ->setCellValue('J17', '')
            ->setCellValue("K17" , 0)
            ->setCellValue("L17" , 118.1)
            ->setCellValue('M17',0)
            ->setCellValue("N17", 0)
            ->setCellValue("O17", '')
            ->setCellValue("P17" , '')
            ->setCellValue("Q17", 'Đã giao hàng')

        ;
        foreach(array('I17','K17','L17', 'M17', 'N17','O17', 'P17') as $cell){
            $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray($styleRowHeader);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray( // màu cho row
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '00ff01'), // mau vang cho row
                        #'size'  => 12,
                    )
                )
            );
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
            $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->applyFromArray(
                array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'rotation'   => 0,
                )
            );
        };

        /*    }
        }*/

        $name = 'TỔNG KẾT ĐƠN' . "-" . date('Y/m/d H:i', time());
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $name . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;

    }


    private static function ConvertExcel($keyWord){
        switch ($keyWord) {
            case '-1':
                return "O1";
                break;
            case '1':
                return "S1";
                break;
            case '2':
                return "S2";
                break;
            case '3':
                return "Adj1";
                break;
            case '4':
                return "Adj2";
                break;
            case '5':
                return "Adj3";
                break;
            default:
                return '';
        }
    }

    public static function exportExcelIDE($filename)
    {
        $objPHPExcel = new \PHPExcel();
        $sheet_index = 0;
        $cel_index = 1;
        $objPHPExcel->setActiveSheetIndex($sheet_index)
            ->setCellValue('A1', 'Trung')
            ->setCellValue('B1', 'Việt')
            #->setCellValue('C1', 'Group')
        ;


        #region thêm độ rộng trên excel

       /* foreach(array('A','B','C') as $rows) {*/
       /*     $objPHPExcel->getActiveSheet()*/
       /*         ->getStyle($rows)*/
       /*         ->getAlignment();*/
       /*        # ->setWrapText(true);*/
       /*     $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30); // set độ cao cho header*/
       /*     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);*/
       /*     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);*/
       /*     #$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);*/
       /* }*/



        #endregion
        $mandango = ConnectMongoDB::getConnection();
        $conditional = [];
        $translatorRepo = new \Mongodb\TranslatorKeywordRepository($mandango);
        $translatorKeyWord = $translatorRepo->createQuery()->criteria($conditional)->all();
            foreach ($translatorKeyWord as $item) {
                    $cel_index++;
                    /** @var  \Mongodb\TranslatorKeyword $item */
                    $objPHPExcel->setActiveSheetIndex($sheet_index)
                        ->setCellValue("A" . $cel_index, $item->getKeyword_china() ? $item->getKeyword_china() : '')
                        ->setCellValue("B" . $cel_index, $item->getKeyword_vi() ? $item->getKeyword_vi() : '')  ;
                       # ->setCellValue("C" . $cel_index, self::ConvertExcel($item->getWeighted()));

            }


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

}