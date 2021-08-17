<?php

namespace Oa\Controller;

use Oa\Model\HandlingModel;

class ExportController extends AuthController
{
    public function bookingNotice()
    {
        $base64 = imgToBase64(__DIR__.'/../../../Public/chz.png');
        $this->assign('img',$base64);
        $this->_exportPdf('booking-notice', $_REQUEST);
    }
    public function handling()
    {
        (new HandlingModel())->saveData($_REQUEST);
        $this->_exportPdf('handling', $_REQUEST, [
            'orientation' => 'L',
            'margin_left'=>4,
            'margin_right'=>4,
            'margin_top'=>4,
            'margin_bottom'=>4,
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
        $default = [
            'mode' => 'utf-8',
            'format' => 'A4',
        ];
        $mpdf = new \Mpdf\Mpdf(array_merge($default, $extra));
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->WriteHTML($this->fetch($temp));
        $mpdf->Output();
    }
}
