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
    public function getPort($countryId){
        
        $fields = [
            'id',
            'pid',
            'label',
            'code',
            '`code` as `value`',
        ];
        return  $this 
            -> field($fields)
            -> where([
                'pid'=>$countryId
            ])
            -> select();
    }

}