<?php
namespace Oa\Model;

use Oa\Model\PublicModel;

class TableDataModel extends PublicModel{
    public function getTableData($table_id, $fields){
        $this->where([
            'table_id'=>$table_id,
            '`deleted` is null',
        ])
        ->field($fields)
        ->getResult();
    return $this;
    }
}