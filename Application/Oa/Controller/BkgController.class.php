<?php
namespace Oa\Controller;

use Oa\Model\BkgExpendModel;
use Oa\Model\BkgModel;
use Oa\Model\TraderModel;
use Oa\Model\ShipperModel;
use Oa\Model\PortOfLoadingModel;
use Oa\Model\PortOfDeloveryModel;
use Oa\Model\ContainerModel;
use Oa\Model\BookerModel;
use Oa\Model\ContainerTypeModel;
use Oa\Model\ContainerDetailModel;
use Oa\Model\HandlingModel;
use Oa\Model\RequestbookModel;
use Oa\Model\RequestbookDetailModel;

class BkgController extends AuthController{
    public function saveData(){
        // print_r($_POST);
        $bkgid = $_POST['header']['id'];
        $bkg = new BkgModel();
        //检查bkgno 是否重复
        $count = $bkg->checkBkgNo($bkgid, $_POST['header']['bkg_no']);
        if($count){
            // $this->ajaxError(7,$bkg->getLastSql());
            $this->ajaxError(7,'BKG NO EXISTS');
            die;
        }
        $bkg->saveData($_POST['header'],$bkgid);
        //检查bkgno 是否重复
        $trander = new TraderModel();
        $trander->saveData($_POST['upper'], $bkgid);
        $loading = new PortOfLoadingModel();
        $loading->saveData($_POST['lower']['port_of_loading'], $bkgid);
        $delovery = new PortOfDeloveryModel();
        $delovery->saveData($_POST['lower']['port_of_delivery'], $bkgid);
        $shipper = new ShipperModel();
        unset($_POST['lower']['port_of_loading']);
        unset($_POST['lower']['port_of_delivery']);
        $shipper->saveData($_POST['lower'], $bkgid);
        $container = new ContainerModel();
        $container->saveData($_POST['center'], $bkgid);
        $containerDetail = new ContainerDetailModel();
        if($_POST['detail']){
            foreach($_POST['detail'] as $singleDetail){
                $containerDetail->saveData($singleDetail,$bkgid);
            }
        }
        if($_POST['copy_id']){
            (new HandlingModel())->copy($_POST['copy_id'], $bkgid);
            $reqID = (new RequestbookModel())->copy($_POST['copy_id'], $bkgid, $bkg->getLastDg());
            (new RequestbookDetailModel())->copy($_POST['copy_id'], $bkgid, $reqID);
        }
        $this->ajaxSuccess();
    }

    public function getBkgOrder(){
        $bkg_id = $_GET['bkg_id'];
        if(!$bkg_id){
            exit;
        }
        $models = [
            'bkg'       => new BkgModel(),
            'trader'    => new TraderModel(),
            'shipper'   => new ShipperModel(),
            'loading'   => new PortOfLoadingModel(),
            'delivery'  => new PortOfDeloveryModel(),
            'container' => new ContainerModel(),
            'type'      => new ContainerTypeModel(),
            'detail'    => new ContainerDetailModel(),
        ];
        $data = [];
        foreach($models as $k => $model){
            $data[$k] = $model->getData($bkg_id);
        }
        if($data['trader']['booker']){
            $data['booker'] = (new BookerModel())->getBooker($data['trader']['booker']);
        }
        $this->ajaxSuccess(clearEmptyDate($data));
    }

    public function getBkgOrderID(){
        $this->_checkParams(['no', 'type'], 'POST', [
            function($no){
                return $no !== '';
            },
            function($type){
                return $type == 1 || $type == 2;
            }
        ]);
        $where = [];
        switch($_REQUEST['type']){
            case 1:{
                $where['bkg_no'] = $_REQUEST['no'];
                break;
            }
            case 2:{
                $where['CONCAT(`month`,`month_no`,`tag`)'] = $_REQUEST['no'];
                break;
            }
        }

        $where['delete_at'] = [
            ['exp', 'IS NULL'],
            ['eq', ''],
            'or'
        ];
        $id = (new BkgModel())
            ->where($where)
            ->find()['id'];
        if($id){
            $this->ajaxSuccess($id);
        }else{
            $this->ajaxError(998, 'CAN NOT FOUND THIS ORDER');
        }
    }

    public function getlist (){
        $condition = $_REQUEST['condition'];
        $query = [];
        //模糊查询字段
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
                    '%' . $condition[$conditionName].'%',
                ];
            }
        }

        if($condition['dg']){
            $query['_string'] = "CONCAT(`month`,`month_no`,`tag`) LIKE '%$condition[dg]%'";
        }

        //是否被删除
        if($_REQUEST['state'] == 'delete'){
            $query['b.delete_at'] = [
                'exp',
                'IS NOT NULL'
            ];
        } else {
            $query['b.delete_at'] = [
                'exp', 'IS NULL'
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
            } elseif($_REQUEST['state'] == 'ready') {
                $query['step'] = 'ready';
            } elseif($_REQUEST['state'] == 'complete') {
                $query['step'] = 'complete';
            } else{
                $query[] = [
                    [
                        'cy_cut' => ['GT', date('Y-m-d',strtotime('-2 day'))],
                        'step'   => ['exp', 'IS NULL'],
                    ],
                    'step'   => 'normal',
                    '_logic' => 'or',
                ];
            }
        }
        
        $current = $_REQUEST['page'] ?: 0;
        $size = $_REQUEST['page_size'] ?: 100;
        $bkg = new BkgModel();
        // $bkg->getList($query, $current, $size);die($bkg->getlastSql());
        $this->ajaxSuccess($bkg->getList($query, $size, $current));
    }
    public function getlist2 (){
        $condition = $_REQUEST['condition'];
        $query = [];
        //模糊查询字段
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
                    '%' . $condition[$conditionName].'%',
                ];
            }
        }

        if($condition['dg']){
            $query['_string'] = "CONCAT(`month`,`month_no`,`tag`) LIKE '%$condition[dg]%'";
        }
        $query['b.delete_at'] = [
            'exp', 'IS NULL'
        ];
        
        $current = $_REQUEST['page'] ?: 0;
        $size = $_REQUEST['page_size'] ?: 100;
        $bkg = new BkgModel();
        $this->ajaxSuccess($bkg->getlist2($_REQUEST['status'], $query, $size, $current));
    }

    public function getReqlist (){
        $condition = $_REQUEST['condition'];
        $query = [];
        //模糊查询字段
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

        $query['request_step'] = [
            'eq',
            $_REQUEST['req_state'] ?: 0
        ];
        //是否被删除
        $query['b.delete_at'] = [
            'exp', 'IS NULL'
        ];
        $having = [];
        if($condition['income_real_time']) {
            $having[] = "( MAX( rb.income_real_time ) BETWEEN {$condition['income_real_time'][0]} AND {$condition['income_real_time'][1]} OR MIN( rb.income_real_time ) BETWEEN '{$condition['income_real_time'][0]}' AND '{$condition['income_real_time'][1]}' )";
        }
        if($condition['request_date']) {
            $having[] = "( MAX( rb.date ) BETWEEN '{$condition['request_date'][0]}' AND '{$condition['request_date'][1]}' OR MIN( rb.date ) BETWEEN '{$condition['request_date'][0]}' AND '{$condition['request_date'][1]}' ) ";
        }
        
        $current = $_REQUEST['page'] ?: 0;
        $size = $_REQUEST['page_size'] ?: 100;
        $bkg = new BkgModel();
        // $bkg->getReqList($query, $current, $size);die($bkg->getlastSql());
        $this->ajaxSuccess(
            $bkg->getReqList($query, join(' AND ', $having), $size, $current)
        );
    }

    public function getCalendar(){
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        $bkg_type = $_REQUEST['bkg_type'];
        if($start_date && $end_date){
            $list = (new BkgModel())->getCalendarData($start_date, $end_date, $bkg_type);
            foreach($list as &$bkg){
                $bkg['lp'] = trim(explode('(',$bkg['lp'])[1], ')');
                $bkg['dp'] = trim(explode('(',$bkg['dp'])[1], ')');
                if($bkg['doc_cut']){
                    $bkg['cy_cut'] = $bkg['doc_cut'];
                }
                $bkg['calendar_status'] = $bkg['calendar_status'] ?: explode('|', $bkg['state'])[0];
                $bkg['short_name'] = $bkg['short_name'] ?: mb_substr($bkg['booker'], 0, 1, 'utf-8');
            }
            $this->ajaxSuccess($list);
        }
        $this->ajaxError(self::ILLEGAL_PARAMS, 'ILLEGAL_PARAMS');
    }

    public function getDetailCalendar(){
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];
        if($start_date && $end_date){
            $list = (new BkgModel())->getDetailCalendarData($start_date, $end_date);
            foreach($list as &$bkg){
                $bkg['lp'] = trim(explode('(',$bkg['lp'])[1], ')');
                $bkg['dp'] = trim(explode('(',$bkg['dp'])[1], ')');
                $bkg['calendar_status'] = $bkg['calendar_status'] ?? explode('|', $bkg['state'])[0];
                $bkg['short_name'] = $bkg['short_name'] ?: mb_substr($bkg['booker'], 0, 1, 'utf-8');
                $bkg['transprotation_short_name'] = $bkg['transprotation_short_name'] ?: mb_substr($bkg['transprotation'], 0, 1, 'utf-8');
            }
            $this->ajaxSuccess($list);
        }
        $this->ajaxError(self::ILLEGAL_PARAMS);
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
            $this->ajaxError(self::ILLEGAL_PARAMS, 'ILLEGAL_PARAMS');
        }
    }

    public function changeRequestDetail(){
        $this->_checkParams(['id']);
        $id = $_REQUEST['id'];
        $expend = $_REQUEST['expend'];
        $income = $_REQUEST['income'];

        if($expend){
            $expend_detail = [];
            $expend_total = 0;
            foreach($expend as $e){
                $expend_detail[] = $e['price'] . ',' . $e['date'] . ',' . $e['name'];
                $expend_total += $e['price'];
            }
            $expend_detail = implode('|', $expend_detail);
        }else{
            $expend_total = 0;
            $expend_detail = '';
        }

        if($income){
            $income_detail = [];
            $income_total = 0;
            foreach($income as $e){
                $income_detail[] = $e['price'] . ',' . $e['date']. ',' . $e['name'];
                $income_total += $e['price'];
            }
            $income_detail = implode('|', $income_detail);
        }else{
            $income_total = 0;
            $income_detail = '';
        }

        $bkg = new BkgModel();
        $bkg->changeReqInfo([
            'expend_total' => $expend_total,
            'expend_detail' => $expend_detail,
            'income_total' => $income_total,
            'income_detail' => $income_detail,
            'id' => $id,
        ]);
        $this->ajaxSuccess();
    }

    public function changeOrderStep(){
        $this->_checkParams(['step', 'id']);
        $id = $_REQUEST['id'];
        $step = $_REQUEST['step'];
        $this->ajaxSuccess(
            (new BkgModel())->changeOrderStep($id, $step)
        );
    }

    public function changeOrderRequestStep(){
        $id = $_REQUEST['id'];
        $step = $_REQUEST['step'];
        if ($id && ($step || $step === '0'|| $step === 0)) {
            $this->ajaxSuccess(
                (new BkgModel())->changeOrderRequestStep($id, $step)
            );
        } else {
            $this->ajaxError(3, 'has no params');
        }
    }

    public function setCalendarStatus(){
        $id = $_REQUEST['id'];
        $status = $_REQUEST['status'];
        if($id){
            (new BkgModel())->setCalendarStatus($id, $status);
            $this->ajaxSuccess();
        }else{
            $this->ajaxError(self::ILLEGAL_PARAMS, 'ILLEGAL_PARAMS');
        }
    }

    public function incomeList () {
        $bkgId = $_REQUEST['bkgId'];
        $model = new RequestbookModel();
        $list = $model->getList($bkgId);
        $this->ajaxSuccess($list);
    }

    public function expendList () {
        $bkgId = $_REQUEST['bkgId'];
        $model = new BkgExpendModel();
        $this->ajaxSuccess(
            $model->getList($bkgId)
        );
    }

    public function mvRequestStep() {
        $id = $_REQUEST['id'];
        $step = $_REQUEST['step'];
        $model = new BkgModel();
        $model->mvRequestStep($id, $step);
        $this->ajaxSuccess();
    }
}
