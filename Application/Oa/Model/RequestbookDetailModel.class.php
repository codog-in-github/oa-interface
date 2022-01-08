<?php
namespace Oa\Model;

use Think\Model;

class RequestbookDetailModel extends Model {
    public function getByBkgId($bkgid){
        return $this->where(['bkg_id' => $bkgid])->select();
    }

    public function getByRequestId($reqID){
        return $this->where(['request_id' => $reqID])->select();
    }
    
    public function updateBook($id, $bkg_id, $data){
        $data = $data['detail'];
        foreach ($data as &$item){
            $item['request_id'] = $id;
            $item['bkg_id'] = $bkg_id;
        }
        $this->where(['request_id'=>$id])->delete();
        foreach($data as $rec){
            unset($rec['id']);
            $this->add($rec);
        }
    }

    public function copy($copyID, $newID, $reqID){
        $copyData = $this->where(['bkg_id'=>$copyID])->select();
        if($copyData){
            foreach($copyData as $row){
                unset($row['id']);
                $row['bkg_id'] = $newID;
                $row['request_id'] = $reqID;
                $this->add($row);
            }
        }
    }
}