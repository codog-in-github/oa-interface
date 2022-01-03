<?php
namespace Oa\Controller;

use Oa\Model\BkgModel;
use Oa\Model\TraderModel;
use Oa\Model\ShipperModel;
use Oa\Model\PortOfLoadingModel;
use Oa\Model\PortOfDeloveryModel;
use Oa\Model\ContainerModel;
use Oa\Model\BookerModel;
use Oa\Model\ContainerTypeModel;
use Oa\Model\ContainerDetailModel;
use Oa\Model\RequestbookModel;
use Oa\Model\RequestbookExtraModel;
use Oa\Model\RequestbookDetailModel;

class RequestbookController extends AuthController{
    public function saveData(){
        // print_r($_POST);
    }

    public function getBook(){
        $bkg_id = $_GET['bkg_id'];
        $copy_bkg_id = $_GET['copy_bkg_id'];
        if(!$bkg_id){
            exit;
        }
        $bookId = '';
        $rb =  (new RequestbookModel())->getRequestbookByBkgId($copy_bkg_id?:$bkg_id);
        if($rb && $copy_bkg_id){
            $bookId = $rb['id'];
            unset($rb['id']);
            $rb['bkg_id'] = $bkg_id;
        }
        $isSave = boolval($rb);

        $models = [
            'bkg' => new BkgModel(),
            'trader' => new TraderModel(),
            'shipper' => new ShipperModel(),
            'loading' => new PortOfLoadingModel(),
            'delivery' => new PortOfDeloveryModel(),
            'container' => new ContainerModel(),
            'type' => new ContainerTypeModel(),
            'detail' => new ContainerDetailModel(),
        ];
        $data = [];
        foreach($models as $k => $model){
            $data[$k] = $model->getData($bkg_id);
        }
        if($data['trader']['booker']){
            $data['booker'] = (new BookerModel())->getBooker($data['trader']['booker']);
        }
        
        $default = [
            'tel' => $data['booker']['tel'],
            'booker_place' => $data['booker']['place'],
            'no' => $data['bkg']['dg'],
            // 'booker_place' => $data['detail'][0]['booker_place'],
            'date' => date('Y-m-d'),
            'booker_name' => $data['trader']['booker'],
        ];
        if($isSave){
            $default = $rb + $default;
        }
        $extraDefault = [
            '積地/揚地' => exportToGetPort($data['loading']['port']) . '->' . exportToGetPort($data['delivery']['port']),
            '出港日' => $data['loading']['etd'],
            '船名' => $data['shipper']['vessel_name'],
            'VAN 日' => implode(
                ',',
                array_map(
                    function($item){return substr($item['vanning_date'],0,10);}
                    ,$data['detail']
                )
            ),
            'B/L NO' => $data['bkg']['bl_no'],
            'RATE' => 'USD|1',
            'CARRIER' => $data['shipper']['carrier'],
            'C/STAFF' => $data['shipper']['c_staff'],
            'VESSEL NAME' => $data['shipper']['bl_no'],
            'VOYAGE' => $data['shipper']['voyage'],
            'ETA' => $data['delivery']['eta'],
        ];
        // var_dump($isSave);die;
        if($isSave){
            $rbe = (new RequestbookExtraModel()) -> getByBkgId($bkg_id);
            if(!$rbe){
                $cols = [
                    '',
                    '',
                ];
                $rbe = [];
                foreach($cols as $i => $col){
                    $rbe['label_'.$i] = $col;
                    $rbe['value_'.$i] = $extraDefault[$col]?:'';
                }
            }
            $rbd = (new RequestbookDetailModel()) -> getByBkgId($copy_bkg_id?:$bkg_id);
            if($copy_bkg_id && $rbd){
                foreach($rbd as &$row){
                    unset($row['id']);
                    unset($row['request_id']);
                    unset($row['bkg_id']);
                }
            }
        }else{
            $cols = [
                '',
                '',
            ];
            $rbe = [];
            foreach($cols as $i => $col){
                $rbe['label_'.$i] = $col;
                $rbe['value_'.$i] = $extraDefault[$col]?:'';
            }
            $rbd = [];
        }
        $default['extra'] = $rbe;
        $default['detail'] = $rbd;
        $default['extraDefault'] = $extraDefault;
        $this->ajaxSuccess(clearEmptyDate($default));
    }

    public function hasBookByCompanyNo(){
        $company_no = $_GET['company_no'];
        $copy_field = $_GET['copy_field'];
        $bkg_id = (new RequestbookModel())->getRequestbookByCompanyNo($company_no, $copy_field)['bkg_id'];
        if($bkg_id){
            $this->ajaxSuccess($bkg_id);
        }else{
            $this->ajaxError(999, 'CAN\'T FIND THIS ORDER');
        }
    }

    public function hasBook(){
        $bkg_id = $_GET['bkg_id'];
        $this->ajaxSuccess(boolval((new RequestbookModel())->getRequestbookByBkgId($bkg_id)));
    }
    
}
