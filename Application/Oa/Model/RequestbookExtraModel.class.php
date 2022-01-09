<?php
namespace Oa\Model;

use Think\Model;

class RequestbookExtraModel extends Model {

    protected $_rowNum = 5;
    protected $_colNum = 2;

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
        for($row=0; $row < $this->_rowNum; $row++){
            for($col=0; $col<$this->_colNum ;$col++){
                $update['label_'.($row * $this->_colNum + $col)] = $data[$row][$col]['label'];
                $update['value_'.($row * $this->_colNum + $col)] = $data[$row][$col]['value'];
            }
        }
        // dump($update);
        $this->where(['request_id'=>$id])->delete();
        $this->add($update);
    }
}