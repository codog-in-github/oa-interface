<?php
namespace Oa\Controller;

class ExportController extends AuthController 
{
    public function bookingNotice(){
        $this->assign($_REQUEST);
        header("Content-type:application/pdf"); 
        header("Content-Disposition:attachment;filename=Export_test.pdf"); 
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
        ]);
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->WriteHTML($this->fetch('booking-notice'));
        $mpdf->Output();
    }
}
