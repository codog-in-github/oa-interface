<?php
namespace Oa\Model;

use Think\Model;

class ContainerModel extends Model {
    public function saveData($container,$bkgid){
        if($container['container']){
            $containerType = new ContainerTypeModel();
            foreach($container['container'] as $oneType){
                $containerType->saveData($oneType, $bkgid);
            }
        }
        unset($container['container']);
        $this->where([
            'id'=>$bkgid,
        ]);
        $container['id'] = $bkgid;
        if($this->count() == 0){
            $this->add($container);
        }else{
            $this->save($container);
        }
    }

    public function getData($bkg_id){
        $containerData = $this->find($bkg_id);
        return $containerData;
    }

    public function changeOrderState($id, $state){
        return $this->save([
            'id' => $id,
            'state' => $state,
        ]);
    }

}