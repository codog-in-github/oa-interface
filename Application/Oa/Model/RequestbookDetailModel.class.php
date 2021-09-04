<?php
namespace Oa\Model;

use Think\Model;

class RequestbookDetailModel extends Model {
    public function getByBkgId($bkgid){
        return $this->where(['bkg_id' => $bkgid])->select();
    }
    public function updateBook($id, $bkg_id, $data){
        $data = json_decode($data['detail'], true);
        foreach ($data as &$item){
            $item['request_id'] = $id;
            $item['bkg_id'] = $bkg_id;
        }
        $this->where(['request_id'=>$id])->delete();
        foreach($data as $rec){
            $this->add($rec);
        }
    }
}