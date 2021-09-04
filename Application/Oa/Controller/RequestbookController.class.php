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
        if(!$bkg_id){
            exit;
        }

        $rb =  (new RequestbookModel())->getRequestbookByBkgId($bkg_id);
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
            'no' => $data['bkg']['dg'],
            'booker_place' => $data['detail'][0]['booker_place'],
            'date' => date('Y-m-d'),
            'booker_name' => $data['trader']['booker'],
        ];
        if($isSave){
            $default = $rb + $default;
        }
        $extraDefault = [
            '積地/揚地：' => exportToGetPort($data['loading']['port']) . '⇒' . exportToGetPort($data['delivery']['port']),
            '出港日：' => $data['loading']['etd'],
            '船名：' => $data['shipper']['vessel_name'],
            'VAN 日：' => implode(
                ',',
                array_map(
                    function($item){return substr($item['vanning_date'],0,10);}
                    ,$data['detail']
                )
            ),
            'B/L NO：' => $data['bkg']['bl_no'],
            'EXCH：' => 'USD|1',
        ];
        if($isSave){
            $rbe = (new RequestbookExtraModel()) -> getByBkgId($bkg_id);
            $rbd = (new RequestbookDetailModel()) -> getByBkgId($bkg_id);
        }else{
            $cols = [
                '積地/揚地：',
                '出港日：',
                '船名：',
                'VAN 日：',
                'B/L NO：',
                '許可書：',
                'コンテナNO：',
                'EXCH：',
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
    
}
