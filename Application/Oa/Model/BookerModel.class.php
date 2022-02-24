<?php
namespace Oa\Model;

use Think\Model;

class BookerModel extends Model {
    protected $_fields =  [
        'id',
        'booker',
        'tel',
        'place',
        'staff',
        'staff_tel',
        'short_name',
    ];

    public function getOption(){
        return $this
            ->field($this->_fields)
            ->where(['delete_at'=> ['EXP', 'IS NULL']])
            ->select();
    }

    public function getBooker($booker){
        return $this
            ->where([
                'booker'=>$booker,
            ])
            ->where(['delete_at'=> ['EXP', 'IS NULL']])
            ->field($this->_fields)
            ->find();
    }

    public function getList($query, $size=10, $current = 0){
        $total = $this->_beforeList($query)->count();
        $list = $this
            ->_beforeList($query)
            ->limit($current * $size, $size)
            ->field($this->_fields)
            ->select();
        return [
            'total' => $total,
            'list' => $list,
            'current' => $current,
        ];
    }

    public function deleteById($id){
        return $this
            ->where(['id' => $id])
            ->save(['delete_at' => getDeleteUserInfo()]);
    }

    private function _beforeList($query){
        return $this
            ->where($query)
            ->where(['delete_at' => ['EXP', 'IS NULL']]);
    }
}