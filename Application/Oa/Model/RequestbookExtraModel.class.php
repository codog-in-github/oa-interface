<?php
namespace Oa\Model;

use Think\Model;

class RequestbookExtraModel extends Model {

    const ROW_NUM = 5;
    const COL_NUM = 2;

    public static function getExtraMaxSize(){
        return self::ROW_NUM * self::COL_NUM;
    }

    public function getByRequestId($requestId){
        return $this->where(['request_id' => $requestId])->find();
    }


    public function updateBook($id, $bkg_id, $data){
        $data = $data['extra'];
        // dump($data);
        $update = [
            'id' => $id,
            'bkg_id' => $bkg_id,
            'request_id' => $id,
        ];
        for($row=0; $row < self::ROW_NUM; $row++){
            for($col=0; $col<self::COL_NUM ;$col++){
                $update['label_'.($row * self::COL_NUM + $col)] = $data[$row][$col]['label'];
                $update['value_'.($row * self::COL_NUM + $col)] = $data[$row][$col]['value'];
            }
        }
        // dump($update);
        $this->where(['request_id'=>$id])->delete();
        $this->add($update);
    }
}