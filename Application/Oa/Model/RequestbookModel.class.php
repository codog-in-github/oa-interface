<?php
namespace Oa\Model;

use Think\Model;

class RequestbookModel extends Model {
    public function getRequestbookByBkgId($bkgid){
        return $this->where(['bkg_id' => $bkgid])->find();
    }

    public function getRequestbookByCompanyNo($company_no){
        return $this
            ->alias('r')
            ->join('bkg AS b ON b.id = r.bkg_id')
            ->where(['concat(`month`, `month_no`, `tag`)' => $company_no])
            ->find();
    }

    public function updateBook($id, $bkg_id, $data){
        $isEdited = boolval($this->find($id));
        if($isEdited){
            $this->save($data);
        }else{
            $this->add($data);
        }
    }
    public function copy($copyID, $newID){
        $copyData = $this->where(['bkg_id'=>$copyID])->find();
        if($copyData){
            $id =  getRandomID();
            $copyData['id'] = $id;
            $copyData['bkg_id'] = $newID;
            $this->add($copyData);
            return $id;
        }
        return false;
    }
}