<?php

namespace Oa\Model;

use Think\Model;

class BkgExpendModel extends Model {
    public function getList($bkgId) {
        return $this->where([
            'bkg_id' => ['eq', $bkgId]
        ])->select();
    }
    public function updateByBkg ($bkgId, $data) {
        $this->delete([
            'bkg_id' => ['eq', $bkgId]
        ]);
        return $this->addAll($data);
    }
}