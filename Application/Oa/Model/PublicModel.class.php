<?php
namespace Oa\Model;

use Think\Model;

class PublicModel extends Model{
    
    public $dataRow = 0;

    public $data = [];

    protected function getResult(){
        $this->data = $this->select();
        // exit ($this ->getLastSql());
        $this->dataRow = count($this->data);
        return  $this;
    }
}