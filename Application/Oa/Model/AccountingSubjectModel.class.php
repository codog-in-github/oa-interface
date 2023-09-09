<?php
namespace Oa\Model;

use Think\Model;

class AccountingSubjectModel extends Model {
    public function map($key = 'company_name') {
        $data = $this->select();
        $arr = [];
        foreach($data as $row) {
            $arr[$row[$key]] = $row;
        }
        return $arr;
    }
}