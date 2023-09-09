<?php
namespace Oa\Model;

use Think\Model;

class DepartmentModel extends Model {
    public function listAll () {
        return $this->field(['id', 'name'])->select();
    }
    public function map () {
        $map = [];
        $list = $this->field(['id', 'name'])->select();
        foreach($list as $row) {
            $map[$row['id']] = $row['name'];
        }
        return $map;
    }
    public function mapAcc () {
        $map = [];
        $list = $this->field(['id', 'acc_name'])->select();
        foreach($list as $row) {
            $map[$row['id']] = $row['acc_name'];
        }
        return $map;
    }
    public function sign ($id) {
        return $this->find($id)['request_sign'];
    }
}