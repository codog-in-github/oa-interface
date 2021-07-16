<?php
namespace Oa\Model;

use Think\Model;

class SelectModel extends Model {
    public function getOption($id,$pid = false){
        $select = $this->find($id);
        switch($select['type']){
            case 'user':{
                $user = new UserModel();
                return $user -> getSelectUser();
            }
            case 'country':{
                $country = new CountryModel();
                if($pid){
                     $country->getPort($pid);
                }else{
                    $country->getCountry();
                }
            }
            default:{
                $option = new OptionModel();
                return $option -> getOption($select['id'],$pid);
            }
        }
    }

}