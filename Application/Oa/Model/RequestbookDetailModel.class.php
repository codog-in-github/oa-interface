<?php
namespace Oa\Model;

use Think\Model;

class RequestbookDetailModel extends Model {
    public function getByBkgId($bkgid){
        return $this->where(['bkg_id' => $bkgid])->select();
    }
}