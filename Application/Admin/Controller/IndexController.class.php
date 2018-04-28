<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/8/19
 * Time: 11:48
 */

namespace Admin\Controller;

class IndexController extends RbacController
{


    public function index()
    {
        $menu = MenuformatTree($_SESSION['admin']['Access'], 0);

        $this->assign('menu', $menu);
        $this->display();
    }

    public function welcome()
    {

        if(file_exists('D:\1php\game\xxx.xls')){
            $a = $this->importExcel('D:\1php\game\xxx.xls');
        }else{
            $a = $this->importExcel('/home/wwwroot/game/xxx.xls');
        }

        print_r($a);


        $this->display();
    }

    function importExcel($file)
    {
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.IOFactory",'',".php");
        import("Org.Util.PHPExcel.Reader.Excel5",'',".php");
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
        $objPHPExcel = $objReader->load($file);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn(); // 取得总列数
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
        $excelData = array();
        for ($row = 1; $row <= $highestRow; $row++) {
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            }
        }
        return $excelData;
    }

}