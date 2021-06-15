<?php
namespace Oa\Model;

use Oa\Model\PublicModel;

class TableModel extends PublicModel{

    protected $tableName = 'table_config as c';


    public function getTableConfig($table_id){
        $this->where([
                'table_id'=>$table_id,
            ])
            ->field([
                'c.id',
                'name',
                'type',
                'col',
            ])
            ->getResult();
        return $this;
    }
}
