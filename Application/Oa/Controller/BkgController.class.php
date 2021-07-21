<?php
namespace Oa\Controller;

use Oa\Model\BkgModel;
use Oa\Model\TraderModel;
use Oa\Model\ShipperModel;
use Oa\Model\PortOfLoadingModel;
use Oa\Model\PortOfDeloveryModel;
use Oa\Model\ContainerModel;
use Oa\Model\ContainerDetailModel;

class BkgController extends AuthController{
    public function saveData(){
        // print_r($_POST);
        $bkgid = $_POST['header']['id'];
        $bkg = new BkgModel();
        $bkg->saveData($_POST['header'],$bkgid);
        $trander = new TraderModel();
        $trander->saveData($_POST['upper'],$bkgid);
        $loading = new PortOfLoadingModel();
        $loading->saveData($_POST['lower']['port_of_loading'],$bkgid);
        $delovery = new PortOfDeloveryModel();
        $delovery->saveData($_POST['lower']['port_of_delivery'],$bkgid);
        $shipper = new ShipperModel();
        unset($_POST['lower']['port_of_loading']);
        unset($_POST['lower']['port_of_delivery']);
        $shipper->saveData($_POST['lower'],$bkgid);
        $container = new ContainerModel();
        $container->saveData($_POST['center'],$bkgid);
        $containerDetail = new ContainerDetailModel();
        if($_POST['detail']){
            foreach($_POST['detail'] as $singleDetail){
                $containerDetail->saveData($singleDetail,$bkgid);
            }
        }
    }
    public function getBkgOrder(){
        $bkg_id = $_GET['bkg_id'];
        if(!$bkg_id){
            exit;
        }
        $models = [
            'bkg' => new BkgModel(),
            'trader' => new TraderModel(),
            'shipper' => new ShipperModel(),
            'loading' => new PortOfLoadingModel(),
            'delovery' => new PortOfDeloveryModel(),
            'container' => new ContainerModel(),
            'detail' => new ContainerDetailModel(),
        ];
        $data = [];
        foreach($models as $k => $model){
            $data[$k] = $model->getData($bkg_id);
        }
        $this->ajaxSuccess($data);
    }
    public function getlist (){
        $condition = $_REQUEST['condition'];
        $query = [];
        //模糊查询字段
        $likeCondition = [
            'bkg_no',
            'bl_no',
            'bkg_type',
            'incoterms',
            'incoterms',
            'bkg_staff',
            'in_sales',
        ];
        foreach($likeCondition as $conditionName){
            if($condition[$conditionName]){
                $query[$conditionName] = [
                    'LIKE',
                    '%'.$condition[$conditionName].'%',
                ];
            }
        }
        //日期
        if($condition['bkg_date']){
            $query['bkg_date'] = [
                'BETWEEN',
                $condition['bkg_date'],
            ];
        }
        //是否被删除
        if($_REQUEST['state'] == 'delete'){
            $query['delete_at'] = [
                'exp',
                'IS NOT NULL'
            ];
        }else{
            $query['delete_at'] = [
                'exp',
                'IS NULL'
            ];
        }
        $current = $_REQUEST['page']?:0;
        $size = $_REQUEST['page_size']?:100;
        $bkg = new BkgModel();
        // $bkg->getList($query, $current, $size);die($bkg->getlastSql());
        $this->ajaxSuccess($bkg->getList($query, $size, $current));
    }
    public function deleteBkgOrder(){
        $id = $_REQUEST['id'];
        if(!$id){
            die;
        }
        $deleteInfo = $_SESSION['userInfo']['id']
            . '|' 
            . $_SESSION['userInfo']['name'] 
            . '@'
            . date('Y-m-d H:i:s');
        $bkg = new BkgModel();
        $bkg->deleteOrder($id, $deleteInfo);
        $this->ajaxSuccess('');
    }
}
