<?php
namespace Oa\Model;

use Think\Model;

class HandlingModel extends Model{
    public function getDataByBkgId($bkg_id){
        $bookData = $this
            ->where([
                'bkgid'=>$bkg_id,
            ])
            ->find();
        if($bookData){
            return $bookData;
        }
        
        $models = [
            'bkg' => new BkgModel(),
            'trader' => new TraderModel(),
            'shipper' => new ShipperModel(),
            'loading' => new PortOfLoadingModel(),
            'delivery' => new PortOfDeloveryModel(),
            'container' => new ContainerModel(),
            'type' => new ContainerTypeModel(),
            'detail' => new ContainerDetailModel(),
        ];
        $data = [];
        foreach($models as $k => $model){
            $data[$k] = $model->getData($bkg_id);
        }
        if($data['trader']['booker']){
            $data['booker'] = (new BookerModel())->getBooker($data['trader']['booker']);
        }
        // dump($data['bkg']);die;
        $bookData = [
            'shipper' => $data['trader']['booker'],
            'doc_cut' => $data['loading']['doc_cut'],
            'vessel_name' => $data['shipper']['vessel_name'],
            'cy_cut' => $data['loading']['cy_cut'],
            'voyage' => $data['shipper']['voyage'],
            'etd' => $data['loading']['etd'],
            'carrier' => $data['shipper']['carrier'],
            'eta' => $data['loading']['eta'],
            'carrier_comp' => $data['shipper']['carrier'],
            'cy_open' => $data['loading']['cy_open'],
            'in_no' => $data['bkg']['dg'],
            'forwarder' => $data['trader']['forwarder'],
            // 'sum_queantity' => $data['loading']['cy_cut'],
            // 'transprotation' => $data['loading']['cy_cut'],
            // 'expenses' => $data['loading']['cy_cut'],
            // 'chassis' => $data['loading']['cy_cut'],
            // 'van_day' => $data['loading']['cy_cut'],
            // 'van_place' => $data['loading']['cy_cut'],
            'basel_charge' => $data['bkg']['bkg_no'],
            'bl_no' => $data['bkg']['bkg_no'],
        ];
        $bookData['sum_queantity'] = array_sum(array_map(function($item){
            return $item['quantity'];
        },$data['type']));
        $bookData['transprotation'] =  implode(',',array_column($data['detail'],'transprotation'));
        $bookData['expenses'] =  implode(',',array_column($data['detail'],'expenses'));
        $bookData['chassis'] =  implode(',',array_column($data['detail'],'chassis'));
        $bookData['van_day'] =  implode(',',array_map(function($item){return substr($item,0,10);},array_column($data['detail'],'vanning_date')));
        $bookData['van_place'] = implode(',',array_column($data['detail'],'booker_place'));
        return $bookData;
    }
    public function saveData($data){

        $data['item_type'] = implode('|',$data['item_type']);
        $data['c_book'] = implode('|',$data['c_book']);
        $count = $this->where(['bkg_id'=>$data['bkg_id']])->count();
        if($count){
            $this->where(['bkg_id'=>$data['bkg_id']])->save($data);
        }else{
            $this->add($data);
        }
    }
}