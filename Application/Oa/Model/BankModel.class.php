<?php
namespace Oa\Model;

use Think\Model;

class BankModel extends Model {
    public function listAll () {
        return $this->field(['id', 'name'])->select();
    }
    public function sign ($id) {
        return $this->find($id)['request_sign'];
    }
}