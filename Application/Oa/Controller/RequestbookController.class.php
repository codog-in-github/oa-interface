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
    protected function _getBkgInfo($bkgId){
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
        $bkgInfo = [];
        foreach($models as $k => $model){
            $bkgInfo[$k] = $model->getData($bkgId);
        }
        if($bkgInfo['trader']['booker']){
            $bkgInfo['booker'] = (new BookerModel())->getBooker($bkgInfo['trader']['booker']);
        }
        return $bkgInfo;
    }

    protected function _getDefault($bkgInfo){
        return [
            'tel' => $bkgInfo['booker']['tel'],
            'booker_place' => $bkgInfo['booker']['place'],
            'no' => $bkgInfo['bkg']['dg'],
            // 'booker_place' => $bkgInfo['detail'][0]['booker_place'],
            'date' => date('Y-m-d'),
            'booker_name' => $bkgInfo['trader']['booker'],
        ];
    }

    protected function _getDefaultExtra($bkgInfo){
        return [
            '積地/揚地' => exportToGetPort($bkgInfo['loading']['port']) . '->' . exportToGetPort($bkgInfo['delivery']['port']),
            '出港日' => $bkgInfo['loading']['etd'],
            '船名' => $bkgInfo['shipper']['vessel_name'],
            'VAN 日' => implode(
                ',',
                array_map(
                    function($item){return substr($item['vanning_date'],0,10);}
                    ,$bkgInfo['detail']
                )
            ),
            'B/L NO' => $bkgInfo['bkg']['bl_no'],
            'RATE' => 'USD|1',
            'CARRIER' => $bkgInfo['shipper']['carrier'],
            'C/STAFF' => $bkgInfo['shipper']['c_staff'],
            'VESSEL NAME' => $bkgInfo['shipper']['bl_no'],
            'VOYAGE' => $bkgInfo['shipper']['voyage'],
            'ETA' => $bkgInfo['delivery']['eta'],
            'BKG NO.' => $bkgInfo['bkg']['bkg_no'],
            'COMMON' => $bkgInfo['container']['common'],
        ];
    }

    protected function _formatEmptyExtra($extraDefault){
        $cols = [
            '',
            '',
        ];
        $extra = [];
        foreach($cols as $i => $col){
            $extra['label_'.$i] = $col;
            $extra['value_'.$i] = $extraDefault[$col]?:'';
        }
        return $extra;
    }

    protected function _getBookDetail($bkg_id, $copy_bkg_id){
        $isCopy = boolval($copy_bkg_id);
        $requestBook =  (new RequestbookModel())->getRequestbookByBkgId($isCopy? $copy_bkg_id :$bkg_id);
        $isSaved = boolval($requestBook);
        if($isSaved && $isCopy){
            unset($requestBook['id']);
            $requestBook['bkg_id'] = $bkg_id;
        }
        $bkgInfo = $this->_getBkgInfo(bkg_id);;
        $default = $this->_getDefault($bkgInfo);
        if($isSaved){
            $default = $requestBook + $default;
        }
        $extraDefault = _getDefaultExtra($bkgInfo);
        // var_dump($isSaved);die;
        if($isSaved){
            $extra = (new RequestbookExtraModel()) -> getByBkgId($isCopy? $copy_bkg_id :$bkg_id);
            if(!$extra){
                $extra = $this->_formatEmptyExtra($extraDefault);
            }
            $detail = (new RequestbookDetailModel()) -> getByBkgId($isCopy? $copy_bkg_id :$bkg_id);
            if($isCopy && $detail){
                foreach($detail as &$row){
                    unset($row['id']);
                    unset($row['request_id']);
                    unset($row['bkg_id']);
                }
            }
        }else{
            $extra = $this->_formatEmptyExtra($extraDefault);
            $detail = [];
        }
        $default['extra'] = $extra;
        $default['detail'] = $detail;
        $default['extraDefault'] = $extraDefault;
        $this->ajaxSuccess(clearEmptyDate($default));
    }

    public function getBook(){
        $bkg_id = $_GET['bkg_id'];
        $copy_bkg_id = $_GET['copy_bkg_id'];
        if(!$bkg_id){
            exit;
        }
        $this->_getBookDetail($bkg_id, $copy_bkg_id);
    }

    public function getBookList(){
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
