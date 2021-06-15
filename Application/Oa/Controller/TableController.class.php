<?php
namespace Oa\Controller;

use Oa\Controller\AuthController;
use Oa\Model\TableModel;
use Oa\Model\TableDataModel;
use Oa\Model\TableConfigDetailModel as DetailModel;

class TableController extends AuthController
{
    public function getTableConfig(){
        if(!$_GET['table_id']){
            $this->ajaxReturn([
                'error' => parent::WITHOUT_TABLEID,
                'data'  => [],
                'message' => 'WITHOUT_TABLEID',
            ]);
        }
        $tm = new TableModel();
        $tm->getTableConfig($_GET['table_id']);
        $ids = array_column($tm->data,'id');
        $dm = new DetailModel();
        $dm->getDetail($ids);
        addIntoArray($tm->data, 'detail', 'id', $dm->data, 'config_id');
        // print_r($tm->data);die;
        $this->sqlResultAjaxReturn($tm);
    }

    public function getTableData(){
        if(!$_GET['table_id']){
            $this->ajaxReturn([
                'error' => parent::WITHOUT_TABLEID,
                'data'  => [],
                'message' => 'WITHOUT_TABLEID',
            ]);
        }
        $tdm = new TableDataModel();

        $col = array_column($_POST['col'], 'col');
        $col[] = 'id';

        $this->sqlResultAjaxReturn(
            $tdm->getTableData($_GET['table_id'],$col)
        );
    }
}
