<?php

namespace Oa\Controller;

use Oa\Model\HandlingModel;

class ExportController extends AuthController
{
    public function bookingNotice()
    {
        $this->_exportPdf('booking-notice', $_REQUEST);
    }
    public function handling()
    {
        (new HandlingModel())->saveData($_REQUEST);
        $this->_exportPdf('handling', $_REQUEST, [
            'orientation' => 'L',
        ]);
    }
    public function getHandlngData()
    {
        $bkg_id = $_REQUEST['bkg_id'];
        if (!$bkg_id) {
            $this->ajaxError();
        }
        $this->ajaxSuccess(
            (new HandlingModel())->getDataByBkgId($bkg_id)
        );
    }
    protected function _exportPdf($temp, $data, $extra = [])
    {
    $this->assign(rmSepStr($data));
        header("Content-type:application/pdf");
        header("Content-Disposition:attachment;filename=Export_test.pdf");
        $default = [
        ];

        $mpdf = new \Mpdf\Mpdf(array_merge($default, $extra));
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->WriteHTML($this->fetch($temp));
        $mpdf->Output();
    }
}
