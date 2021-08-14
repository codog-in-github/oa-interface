<?php
namespace Oa\Model;

use Think\Model;

class HandlingModel extends Model{
    public function getDataByBkgId($bkg_id){
        //默认值 获取
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
        // dump($data);die;
        $defaultData = [
            'shipper' => $data['trader']['booker'],
            'doc_cut' => $data['loading']['doc_cut'],
            'vessel_name' => $data['shipper']['vessel_name'],
            'cy_cut' => $data['loading']['cy_cut'],
            'voyage' => $data['shipper']['voyage'],
            'etd' =>  exportToGetPort($data['loading']['port']) . ' ' . $data['loading']['etd'],
            'carrier' => $data['shipper']['carrier'],
            'eta' => exportToGetPort($data['delivery']['port']) . ' ' . $data['delivery']['eta'],
            'booking' => $data['trader']['drayage'],
            'cy_open' => $data['loading']['cy_open'],
            'in_no' => $data['bkg']['dg'],
            'forwarder' => $data['trader']['forwarder'],
            'unity' => '本',
            'surrender_arrangement' => $data['container']['surrender_arrangement'],
            'pick_order_request' => $data['container']['pick_order_request'],
            'send_pick_order' => $data['container']['send_pick_order'],
            'bkg_no' => $data['bkg']['bkg_no'],
            'bl_no' => $data['bkg']['bkg_no'],
            'c_book' => 'INVOICE|許可書|B/L|サレンダ-B/L|海上保険',
        ];
        $defaultData['sum_queantity'] = array_sum(array_column($data['type'],'quantity'));
        // print_r($transprotation);die;
        $defaultData['expenses'] =  impoldeWithoutEmpty(',',array_column($data['detail'],'expenses'));
        $defaultData['chassis'] =  impoldeWithoutEmpty(',',array_column($data['detail'],'chassis'));
        $defaultData['van_place'] = impoldeWithoutEmpty(',',array_column($data['detail'],'booker_place'));
        $defaultData['van_day'] =  impoldeWithoutEmpty(
            ',',
            array_map(
                function($item){
                    return substr($item,0,10);
                },
                array_column($data['detail'],'vanning_date')
            )
        );
        $tmp = [];
        $transprotation = array_column($data['detail'],'transprotation');
        foreach($transprotation as $one){
            $tmp[$one] = $one;
        }
        $defaultData['transprotation'] =  impoldeWithoutEmpty(',',$tmp);
        //查表是否被填写
        $bookData = $this
            ->where([
                'bkg_id'=>$bkg_id,
            ])
            ->find();
        if($bookData){
            //填写完成空值赋默认值
            foreach ($bookData as $colName => &$cell){
                if(isEmpty($cell)){
                    $cell = $defaultData[$colName];
                }
            }
            return $bookData;
        }else{
            return $defaultData;
        }
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