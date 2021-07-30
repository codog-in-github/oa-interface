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
        $this->ajaxSuccess($data);
    }
    public function getlist (){
        $condition = $_REQUEST['condition'];
        $query = [];
        //模糊查询字段
        $likeCondition = [
            'bkg_no' => 'bkg_no',
            'bl_no' => 'bl_no',
            'pod' => 'd.`port`',
            'pol' => 'l.`port`',
            'booker' => 'booker',
            // 'gd' => 'CONCAT(`month`,`month_no`,`tag`)',
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
        //日期
        // if($condition['bkg_date']){
        //     $query['bkg_date'] = [
        //         'BETWEEN',
        //         $condition['bkg_date'],
        //     ];
        // }
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
            //订单状态筛选
            if($_REQUEST['state'] == 'draft'){
                $query[] = [
                    'step' => 'draft',
                    [
                        'cy_cut' => ['ELT', date('Y-m-d',strtotime('-2 day'))],
                        'step' => ['exp', 'IS NULL'],
                    ],
                    '_logic' => 'or',
                ];
            }elseif($_REQUEST['state'] == 'ready'){
                $query['step'] = 'ready';
            }elseif($_REQUEST['state'] == 'complete'){
                $query['step'] = 'complete';
            }else{
                $query[] = [
                    [
                        'cy_cut' => ['GT', date('Y-m-d',strtotime('-2 day'))],
                        'step' => ['exp', 'IS NULL'],
                    ],
                    'step' => 'normal',
                    '_logic' => 'or',

                ];
            }
        }
        $current = $_REQUEST['page']?:0;
        $size = $_REQUEST['page_size']?:100;
        $bkg = new BkgModel();
        // $bkg->getList($query, $current, $size);die($bkg->getlastSql());
        $this->ajaxSuccess($bkg->getList($query, $size, $current));
    }
    public function deleteBkgOrder(){
        $id = $_REQUEST['id'];
        $isDelete = $_REQUEST['is_delete'];
        if(!$id){
            die;
        }
        if($isDelete == 'true' ){
            $deleteInfo = $_SESSION['userInfo']['id']
                . '|' 
                . $_SESSION['userInfo']['name'] 
                . '@'
                . date('Y-m-d H:i:s');
        }else{
            $deleteInfo = null;
        }
        $bkg = new BkgModel();
        $bkg->deleteOrder($id, $deleteInfo);
        $this->ajaxSuccess('');
    }
    public function changeOrderState(){
        $id = $_REQUEST['id'];
        $state = $_REQUEST['state'];
        if($id){
            $this->ajaxSuccess(
                (new ContainerModel())->changeOrderState($id, $state)
            );
        }else{
            $this->ajaxError(3,'has no params');
        }
    }
    public function changeOrderStep(){
        $id = $_REQUEST['id'];
        $step = $_REQUEST['step'];
        if($id && $step){
            $this->ajaxSuccess(
                (new BkgModel())->changeOrderStep($id, $step)
            );
        }else{
            $this->ajaxError(3,'has no params');
        }
    }
}
