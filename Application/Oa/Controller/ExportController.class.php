<?php

namespace Oa\Controller;

use Oa\Model\AccountingSubjectModel;
use Oa\Model\BankModel;
use Oa\Model\HandlingModel;

use Oa\Model\RequestbookModel;
use Oa\Model\RequestbookDetailModel;
use Oa\Model\RequestbookExtraModel;
use Oa\Model\BookingNoticeModel;
use Oa\Model\DepartmentModel;
use PHPMailer\PHPMailer\PHPMailer;

class ExportController extends AuthController
{

    public function bookingNotice()
    {
        $base64 = imgToBase64(__DIR__.'/../../../Public/chz.png');
        $this->assign('img',$base64);

        $department = new DepartmentModel();
        $_REQUEST['address'] = $department->sign($_POST['address']);
        if(!$_REQUEST['consiginee']) unset($_REQUEST['consiginee']);

        (new BookingNoticeModel())->setRemarks($_REQUEST);
        
        $this->_exportPdf('booking-notice', $_REQUEST);
    }

    public function handling()
    {
        (new HandlingModel())->saveData($_REQUEST);
        $this->_exportPdf('handling', $_REQUEST, [
            'orientation'   => 'L',
            'margin_left'   => 4,
            'margin_right'  => 4,
            'margin_top'    => 4,
            'margin_bottom' => 4,
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
    
        $bank = new BankModel();
        $department = new DepartmentModel();
        $_POST['bank'] = $bank->sign($_POST['bank']);
        $_POST['address'] = $department->sign($_POST['address']);

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
            $mail->isSMTP();
            $mail->Host       = $env['SMTP_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $env['SMTP_USERNAME'];
            $mail->Password   = $env['SMTP_PASSWORD'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
            $mail->Port       = $env['SMTP_PORT']; 

            //Recipients
            $mail->setFrom($env['SMTP_USERNAME'], 'system');
            $mail->addAddress($env['MAIL_TO']);
            //Attachments
            $mail->addAttachment($pdf['path']);

            //Content
            $mail->Subject = $pdf['name'];
            $mail->Body    = 'no replay';

            $mail->send();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function accountingIncome () {
        $condition = $_REQUEST;
        $query = [];
        $likeCondition = [
            'bkg_no' => 'bkg_no',
            'bl_no'  => 'bl_no',
            'pod'    => 'd.`port`',
            'pol'    => 'l.`port`',
            'booker' => 'booker',
        ];

        foreach($likeCondition as $conditionName =>$colNmae){
            if($condition[$conditionName]){
                $query[$colNmae] = [
                    'LIKE',
                    '%'.$condition[$conditionName].'%',
                ];
            }
        }

        if($condition['dg']){
            $query['_string'] = "CONCAT(`month`,`month_no`,`tag`) LIKE '%$condition[dg]%'";
        }
        $query['request_step'] = [ 'eq', $condition['request_step']];
        $query['b.delete_at'] = [ 'exp', 'IS NULL' ];
        if($condition['income_real_time']) {
            $query['income_real_time'] = [
                'BETWEEN', $condition['income_real_time']
            ];
        }
        if($condition['request_date']) {
            $query['rb.date'] =  [
                'BETWEEN', $condition['request_date']
            ];
        }
        
        $as = new AccountingSubjectModel();
        $dep = new DepartmentModel();
        $depMap = $dep->mapAcc();
        $asMap = $as->map();
        $title = [
            '//識別フラグ',
            '伝番',
            '日付',
            '借方科目',
            '借方科目名称',
            '借方科目正式名称',
            '借方補助',
            '借方補助名称',
            '借方課区',
            '借方税区',
            '借方税入力方法',
            '借方金額',
            '借方消費税',
            '貸方科目',
            '貸方科目名称',
            '貸方科目正式名称',
            '貸方補助',
            '貸方補助名称',
            '貸方課区',
            '貸方税区',
            '貸方税入力方法',
            '貸方金額',
            '貸方消費税',
            '摘要',
            '借方取引科目',
            '貸方取引科目',
            '借方部門コード',
            '借方部門名称',
            '貸方部門コード',
            '貸方部門名称',
        ];
        $rb = new RequestbookModel();
        $data = $rb->export($query);
        $result = [];
        foreach($data as $group) {
            $type = [];
            foreach($group as $row) {
                if(strpos($row['booker_name'], '立替')) {
                    $type['立替'][] = $row;
                } else {
                    $type[$row['tax']][] = $row;
                }
            }
            $types[] = $type;
            $calTotal = function ($rows) {
                $total = 0;
                foreach($rows as $row) {
                    $total += $row['total'];
                }
                return $total;
            };
            $getNo = function ($row) {
                if($row['bkg_no']) {
                    return $row['bkg_no'];
                }
                if($row['bl_no']) {
                    return $row['bl_no'];
                }
                for($i = 0; $i < 10; $i++) {
                    if($row['label_' . $i] === '許可書') {
                        return $row['value_' . $i];
                    }
                }
                return $row['request_no'];
            };
            if($type['立替']) {
                foreach($type['立替'] as $row) {
                    $result[] = [
                        1000, // '//識別フラグ',
                        0, // '伝番',
                        str_replace('-', '', $row['date']), // '日付',
                        152, // '借方科目',
                        '売掛金', // '借方科目名称',
                        '売掛金', // '借方科目正式名称',
                        $asMap[$row['booker_name']]['id'] ?: 99, // '借方補助',
                        $asMap[$row['booker_name']]['name'] ?: $row['booker_name'], // '借方補助名称',
                        null, // '借方課区',
                        null, // '借方税区',
                        null, //'借方税入力方法',
                        $row['total'], // '借方金額',
                        0, // '借方消費税',
                        183, // '貸方科目',
                        '仮払金', // '貸方科目名称',
                        '仮払金', // '貸方科目正式名称',
                        null, // '貸方補助',
                        null, // '貸方補助名称',
                        null, // '貸方課区',
                        null, // '貸方税区',
                        null, // '貸方税入力方法',
                        $row['total'], // '貸方金額',
                        0, // '貸方消費税',
                        $row['booker_name'] . ' ' . $row['item_name'] . ' ' . $getNo($row),  // '摘要',
                        null, // '借方取引科目',
                        null, // '貸方取引科目',
                        $row['address'], // '借方部門コード',
                        $depMap[$row['address']], //'借方部門名称',
                        $row['address'], // '貸方部門コード',
                        $depMap[$row['address']], // '貸方部門名称',
                    ];
                }
            }
            if($type['免']) {
                $row = $type['免'][0];
                $total = $calTotal($type['免']);
                $itemName = join(
                    ',',
                    array_map(function ($item) {
                        return $item['item_name'];
                    }, $type['免'])
                );
                $result[] = [
                    1000, // '//識別フラグ',
                    0, // '伝番',
                    str_replace('-', '', $row['date']), // '日付',
                    152, // '借方科目',
                    '売掛金', // '借方科目名称',
                    '売掛金', // '借方科目正式名称',
                    $asMap[$row['booker_name']]['id'] ?: 99, // '借方補助',
                    $asMap[$row['booker_name']]['name'] ?: $row['booker_name'], // '借方補助名称',
                    null, // '借方課区',
                    null, // '借方税区',
                    null, //'借方税入力方法',
                    $total, // '借方金額',
                    0, // '借方消費税',
                    614, // '貸方科目',
                    '輸出免税', // '貸方科目名称',
                    '輸出入業受取収入（免税）', // '貸方科目正式名称',
                    null, // '貸方補助',
                    null, // '貸方補助名称',
                    '輸出売', // '貸方課区',
                    null, // '貸方税区',
                    null, // '貸方税入力方法',
                    $total, // '貸方金額',
                    0, // '貸方消費税',
                    $row['booker_name'] . ' ' . $itemName . ' ' . $getNo($row), // '摘要',
                    null, // '借方取引科目',
                    null, // '貸方取引科目',
                    $row['address'], // '借方部門コード',
                    $depMap[$row['address']], //'借方部門名称',
                    $row['address'], // '貸方部門コード',
                    $depMap[$row['address']], // '貸方部門名称',
                ];
            }
            if($type['课']) {
                $row = $type['课'][0];
                $total = $calTotal($type['课']);
                $itemName = join(
                    ',',
                    array_map(function ($item) {
                        return $item['item_name'];
                    }, $type['课'])
                );
                $result[] = [
                    1000, // '//識別フラグ',
                    0, // '伝番',
                    str_replace('-', '', $row['date']), // '日付',
                    152, // '借方科目',
                    '売掛金', // '借方科目名称',
                    '売掛金', // '借方科目正式名称',
                    $asMap[$row['booker_name']]['id'] ?: 99, // '借方補助',
                    $asMap[$row['booker_name']]['name'] ?: $row['booker_name'], // '借方補助名称',
                    null, // '借方課区',
                    null, // '借方税区',
                    null, //'借方税入力方法',
                    $total, // '借方金額',
                    0, // '借方消費税',
                    613, // '貸方科目',
                    '輸出课税', // '貸方科目名称',
                    '輸出入業受取収入', // '貸方科目正式名称',
                    null, // '貸方補助',
                    null, // '貸方補助名称',
                    '売上', // '貸方課区',
                    '10%', // '貸方税区',
                    null, // '貸方税入力方法',
                    $total, // '貸方金額',
                    0, //'貸方消費税',
                    $row['booker_name'] . ' ' . $itemName . ' '. $getNo($row), // '摘要',
                    null, // '借方取引科目',
                    null, // '貸方取引科目',
                    $row['address'], // '借方部門コード',
                    $depMap[$row['address']], //'借方部門名称',
                    $row['address'], // '貸方部門コード',
                    $depMap[$row['address']], // '貸方部門名称',
                ];
            }
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=tmp.csv');
        header('Cache-Control: max-age=0');
        $f = fopen('php://output', 'a');
        fputcsv(
            $f,
            // $title,
            mb_convert_encoding($title,  "SJIS-win", "utf-8")
        );
        foreach($result as $row) {
            fputcsv(
                $f,
                // $row,
                mb_convert_encoding($row,  "SJIS-win", "utf-8"),
            );
        }
        fclose($f);
    }
}
