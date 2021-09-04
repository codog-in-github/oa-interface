<?php
namespace Oa\Model;

use Think\Model;

class RequestbookExtraModel extends Model {

    protected $_rowNum = 5;
    protected $_colNum = 2;

    public function getByBkgId($bkgid){
        return $this->where(['bkg_id' => $bkgid])->find();
    }

    public function updateBook($id, $bkg_id, $data){
        $data = json_decode($data['extra'], true);
        // dump($data);
        $update = [
            'id' => $bkg_id,
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
        if($this->find($bkg_id)){
            $this->save($update);
        }else{
            $this->add($update);
        }
    }
}