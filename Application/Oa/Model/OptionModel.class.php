<?php
namespace Oa\Model;

use Think\Model;

class OptionModel extends Model {
    public function getOption($selectId, $pid = false){
        $fields = [
            'id',
            'label',
            'extra',
        ];
        $map = [
            'select_id' => $selectId,
        ];
        if($pid){
            $map['pid'] = $pid;
        }
        return $this->field($fields)->where($map)->select();
    }

}