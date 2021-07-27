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
    ];
    public function getOption(){
        return $this->field($this->_fields)
            ->select();
    }
    public function getBooker($booker){
        return $this
            ->where([
                'booker'=>$booker,
            ])
            ->field($this->_fields)
            ->find();
    }
}