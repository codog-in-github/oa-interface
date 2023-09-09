<?php
namespace Oa\Controller;

use Oa\Model\ContainerModel;
use Oa\Model\ContainerDetailModel;

class ContainerController extends AuthController{
    public function getlist (){
        $condition = $_REQUEST['condition'];
        $query = [];
        //模糊查询字段
        $likeCondition = [
            'bkg_no'         => 'bkg_no',
            'booker_place'   => 'booker_place',
            'transprotation' => 'transprotation',
            'booker'         => 'booker',
        ];
        foreach($likeCondition as $conditionName =>$colNmae){
            if($condition[$conditionName]){
                $query[$colNmae] = [
                    'LIKE',
                    '%' . $condition[$conditionName] . '%',
                ];
            }
        }
        $timeCondition = [
            'cy_cut'=>'cy_cut',
            'vanning_date'=>'vanning_date',
        ];
        foreach($timeCondition as $conditionName => $colNmae){
            if($condition[$conditionName][0] && $condition[$conditionName][1]){
                $query[$colNmae] = [
                    'BETWEEN',
                    $condition[$conditionName]
                ];
            }
        }
        $current = $_REQUEST['page'] ?: 0;
        $size = $_REQUEST['page_size'] ?: 100;
        $this->ajaxSuccess((new ContainerDetailModel())->getList($query, $size, $current));
    }

    public function confirm(){
        $id = $_REQUEST['id'];
        $this->ajaxSuccess((new ContainerDetailModel())->confirm($id));
    }
}
