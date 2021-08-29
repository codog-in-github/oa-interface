<?php
namespace Oa\Model;

use Think\Model;

class RequestbookModel extends Model {
    public function getRequestbookByBkgId($bkgid){
        return $this->where(['bkg_id' => $bkgid])->find();
    }
}