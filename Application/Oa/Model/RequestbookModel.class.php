<?php
namespace Oa\Model;

use Think\Model;

class RequestbookModel extends Model {
    public function getRequestbookByBkgId($bkgid){
        return $this->where(['bkg_id' => $bkgid])->find();
    }

    public function getRequestbookById($id){
        return $this->where(['id' => $id])->find();
    }

    public function getList($bkgId){
        return $this
        ->alias('r')
        ->field(['r.id', 'r.income_real_time', 'r.create_time', 'r.date', 'b.name as bank', 'd.name as address', 'total'])
        ->where([
            'bkg_id' => $bkgId,
            'r.delete_at' => ['exp','IS NULL'],
        ])
        ->join('bank AS b ON b.id = bank')
        ->join('department AS d ON d.id = address')
        ->select();
    }

    public function saveRealTime ($id, $time = null) {
        if($time) {
            $this->save([
                'id' => $id,
                'income_real_time' => $time
            ]);
        } else {
            $this->save([
                'id' => $id,
                'income_real_time' => null
            ]);
        }
    }

    public function getRequestbookByCompanyNo($copy_value, $copy_field = 1){
        $prev = $this
            ->alias('r')
            ->join('bkg AS b ON b.id = r.bkg_id');
        if($copy_field == 1){
            $prev->where(['bkg_no' => $copy_value]);
        }else{
            $prev->where(['concat(`month`, `month_no`, `tag`)' => $copy_value]);
        }
        return $prev->find();
    }

    public function updateBook($id, $bkg_id, $data){
        $isEdited = boolval($this->find($id));
        // dump($data);die;
        if($isEdited){
            $this->save($data);
        }else{
            $data['create_time'] = date('Y-m-d H:i:s');
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

    public function export ($query) {
        $f = [
            'rd.request_id', 'date', 'booker_name',
            'item_name','tax', 'rd.total', 'address',
            'bkg_no', 'bl_no', 'rb.no as request_no'
        ];
        for($i = 0; $i < 10; $i ++) {
            $f[] = 'label_' . $i;
            $f[] = 'value_' . $i;
        }
        $data = $this
            ->alias('rb')
            ->field($f)
            ->join('requestbook_detail AS rd ON rd.request_id = rb.id', 'INNER')
            ->join('requestbook_extra AS re ON re.request_id = rb.id', 'INNER')
            ->join('bkg AS b ON b.id = rb.bkg_id', 'INNER')
            ->where($query)
            ->select();
        $group = [];
        foreach($data as $row) {
            $group[$row['request_id']][] = $row;
        }
        return $group;
    }
}