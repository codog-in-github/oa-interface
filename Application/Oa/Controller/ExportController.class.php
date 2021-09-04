<?php

namespace Oa\Controller;

use Oa\Model\HandlingModel;

use Oa\Model\RequestbookModel;
use Oa\Model\RequestbookDetailModel;
use Oa\Model\RequestbookExtraModel;

class ExportController extends AuthController
{
    
    private $address = [
        '本社' =>  '本社〒650-0041
兵庫県神戸市中央区新港町8番2号 新港貿易会館4F
TEL: 078-381-7888　FAX: 078-381-7887',

        '九州営業所' => '九州営業所〒812-0016
福岡県福岡市博多区博多駅南4-4-17 第5博多IR BLD.602
TEL: 092-409-5608　FAX: 092-409-5609',
    ];

    private $bank = [
        '三井住友銀行' => '三井住友銀行 三宮支店 普通預金 2294279
カ）ハルミグミ',
        '姫路信用金庫' => '姫路信用金庫 春日野支店 普通預金 0292540
        カ）ハルミグミ',
'住信SBIネット銀行' => '住信SBIネット銀行 法人第一支店 普通預金 1330488
カ）ハルミグミ',
    ];

    public function bookingNotice()
    {
        $base64 = imgToBase64(__DIR__.'/../../../Public/chz.png');
        $this->assign('img',$base64);

        $_REQUEST['address'] = $this->address[$_REQUEST['address']];
        if(!$_REQUEST['consiginee']) unset($_REQUEST['consiginee']);
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
    public function requestbook()
    {
        $id = $_REQUEST['id'];
        $bkg_id = $_REQUEST['bkg_id'];
        $models = [
            new RequestbookModel(),
            new RequestbookDetailModel(),
            new RequestbookExtraModel(),
        ];
        foreach($models as $model){
            $model -> updateBook($id,$bkg_id,$_POST);
        }
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
        // $this->display($temp);die;
        $mpdf->WriteHTML($this->fetch($temp));
        $mpdf->Output();
    }
}
