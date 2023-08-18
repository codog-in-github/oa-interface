<?php

namespace Oa\Controller;

use Oa\Model\HandlingModel;

use Oa\Model\RequestbookModel;
use Oa\Model\RequestbookDetailModel;
use Oa\Model\RequestbookExtraModel;
use Oa\Model\BookingNoticeModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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
        '三井住友銀行' => '三井住友銀行 三宮支店
普通預金 2294279
カ）ハルミグミ',
        '姫路信用金庫' => '姫路信用金庫 春日野支店
普通預金 0292540
カ）ハルミグミ',
        '住信SBIネット銀行' => '住信SBIネット銀行 法人第一支店
普通預金 1330488
カ）ハルミグミ',
    ];

    public function bookingNotice()
    {
        $base64 = imgToBase64(__DIR__.'/../../../Public/chz.png');
        $this->assign('img',$base64);

        $_REQUEST['address'] = $this->address[$_REQUEST['address']];
        if(!$_REQUEST['consiginee']) unset($_REQUEST['consiginee']);

        (new BookingNoticeModel())->setRemarks($_REQUEST);
        
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
        $id = $_POST['id'];
        $bkg_id = $_POST['bkg_id'];
        $_POST['detail'] = json_decode($_POST['detail'], true);
        $_POST['extra'] = json_decode($_POST['extra'], true);
        $models = [
            new RequestbookModel(),
            new RequestbookDetailModel(),
            new RequestbookExtraModel(),
        ];
        foreach($models as $model){
            $model -> updateBook($id, $bkg_id, $_POST);
        }
        
        $logo = imgToBase64(__DIR__.'/../../../Public/chz.png');
        $sign = imgToBase64(__DIR__.'/../../../Public/chz-sign.png');
        $this->assign('img',$logo);
        $this->assign('signImg',$sign);
        
        $this->assign('moneyMap', ['USD'=>' $']);
        
        $_POST['address'] = $this->address[$_REQUEST['address']];
        $_POST['bank'] = $this->bank[$_REQUEST['bank']];

        // dump($_POST);die;
        $this->_exportPdf('requestbook', $_POST, [
            'margin_left'=>10,
            'margin_right'=>10,
            'margin_top'=>10,
            'margin_bottom'=>10,
        ],[
            'name' => '請求書-' . $_POST['no'] . '-' . $_POST['bkg_id']
        ]);
    }

    protected function _exportPdf($temp, $data, $extra = [], $emailInfo = false)
    {
        $this->assign(rmSepStr($data));

        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        // dump($fontData);die;
        $default = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'fontDir' => array_merge($fontDirs, [
                __DIR__.'/../../../Public/fonts',
            ]),
            'fontdata' => $fontData + [
                'deng' => [
                    'R' => 'Deng.ttf',
                    'B' => 'Dengb.ttf',
                ]
            ],
            // 'default_font' => 'msyh'
        ];
        $mpdf = new \Mpdf\Mpdf(array_merge($default, $extra));
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        // $this->display($temp);die;
        $mpdf->WriteHTML($this->fetch($temp));
        if($emailInfo) {
            $tmpPdf = ENTRY_PATH . '/tmp/' . $emailInfo['name'] . '.pdf';
            $mpdf->Output($tmpPdf);
            $this->_sendMail(
                array_merge($emailInfo, [ 'path' => $tmpPdf ])
            );
            unlink($tmpPdf);
        }
        $mpdf->Output();
    }
    
    private function _sendMail($pdf) {
        $env = getCustomEnv();
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $env['SMTP_HOST'];                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $env['SMTP_USERNAME'];                     //SMTP username
            $mail->Password   = $env['SMTP_PASSWORD'];                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $env['SMTP_PORT'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($env['SMTP_USERNAME'], 'system');
            $mail->addAddress($env['MAIL_TO']);               //Name is optional
            //Attachments
            $mail->addAttachment($pdf['path']);            //Add attachments

            //Content
            $mail->Subject = $pdf['name'];
            $mail->Body    = 'no replay';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
