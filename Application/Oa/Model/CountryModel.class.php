<?php
namespace Oa\Model;

use Think\Model;

class CountryModel extends Model {

    public function getAll(){
        $fields = [
            'id',
            'pid',
            'label',
            'code',
        ];
        return  $this 
            -> field($fields)
            -> where('`pid` = 0')
            -> select();
    }
    public function getCountry(){
        $fields = [
            'id',
            'pid',
            'code',
            '`code` as `value`',
            'label',
        ];
        return  $this 
            -> field($fields)
            -> where('`pid` = 0')
            -> select();
    }
    public function getPort($code){
        
        $fields = [
            'p.id',
            'p.pid',
            'p.label',
            'p.`code`',
            'p.`code` as `value`',
        ];
        return $this 
            -> field($fields)
            ->join('JOIN country AS p ON country.id = p.pid')
            -> where([
                'country.`code`'=>$code
            ])
            -> select();
    }

    public function getCountryList(){
        return $this->getPortList(0);
    }

    public function getPortList($pid){
        return $this->where(['pid' => $pid])->select();
    }

    public function searchPortList($like){
        return $this
            ->where([
                'label' => ['like', "%$like%"],
                'code' => ['like', "%$like%"],
                '_logic' => 'or'
            ])
            ->select();
    }

    public function editPort($id, $data){
        return $this->where(['id' => $id])->select();
    }

    public function deletePort($id){
        return $this->where(['id' => $id])->delete();
    }

    public function addCountry($data){
        return $this->add([
            'pid' => 0,
            'label' => $data['label'],
            'code' => $data['code'],
        ]);
    }

    public function addPort($data){
        return $this->add($data);
    }
}