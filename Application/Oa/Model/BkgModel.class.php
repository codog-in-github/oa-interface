<?php
namespace Oa\Model;

class BkgModel extends BkgCommonModel {
    private $lastDg = '';
    protected $_fields = [
        'id',
        'bkg_date',
        'bkg_no',
        'bl_no',
        'bkg_type',
        'incoterms',
        'bkg_staff',
        'in_sales',
        'step',
        'request_step',
        'CONCAT(`month`,`month_no`,`tag`)' => 'dg'
    ];

    public function saveData($bkg, $bkgid){
        $this->where([
            'id'=>$bkgid,
        ]);
        $bkg['id'] = $bkgid;
        if($this->count() == 0){
            $month = date('Ym');
            $last = $this->where([
                'month' => $month,
            ])
            ->order('month_no desc')
            ->find()['month_no'];
            $current = 100;
            if($last){
                $current = nextOrderNo($last);
            }
            $bkg['month'] = $month;
            $bkg['month_no'] = $current;
            $bkg['tag'] = $_SESSION['userInfo']['tag'];
            $this->lastDg = $month . $current . $_SESSION['userInfo']['tag'];
            $this->add($bkg);
        }else{
            $this->save($bkg);
        }
    }

    public function getLastDg () {
        return $this->lastDg;
    }

    public function getList($query, $size=100, $current=0){
        $info['total'] = $this
            ->_beforeQuery($query)
            ->count();
        $info['list'] = $this
            ->_beforeQuery($query)
            ->field([
                'b.id',
                'CASE `doc_cut` WHEN "" THEN `cy_cut` ELSE `doc_cut` END AS show_cy_cut',
                'bkg_date',
                'booker',
                'UPPER(l.`port`) as lp',
                'UPPER(d.`port`) as dp',
                'bkg_no',
                'group_concat(quantity) as quantity',
                'group_concat(container_type) as container_type',
                'state',
                'concat(month, month_no, tag) as company_no'
            ])
            ->join('container_type AS ct ON b.id = bkg_id')
            ->where([
                'ct.delete_at' => [
                    ['exp', 'IS NULL'],
                    ['eq', ''],
                    'or'
                ]
            ])
            ->group('b.id')
            ->limit($current * $size, $size)
            ->order('show_cy_cut')
            ->select();
        foreach($info['list'] as &$record){
            $record['ld'] = exportToGetPort($record['lp']) . '-' . exportToGetPort($record['dp']);
        }
//         echo $this->getLastSql();die;
        return $info;
    }

    public function getList2($status, $query, $sort, $size=100, $current=0){
        $query = $status ? function ($builder) {
            $builder->where('(rb.date IS NOT NULL AND rb.date >= LEFT(b.bkg_date, 10))');
            return $builder;
        } : function ($builder) {
            $builder->where('(rb.date IS NULL OR rb.date < LEFT(b.bkg_date, 10))');
            return $builder;
        };
        $total = $query($this)
            ->_beforeQuery($query)
            ->field([
                'b.id'
            ])
            ->join('requestbook AS rb ON b.id = rb.bkg_id', 'left')
            ->group('b.id')
            ->select();
        $info['total'] = count($total);
        $builder = $query($this)
            ->_beforeQuery($query)
            ->field([
                'b.id',
                'CASE `doc_cut` WHEN "" THEN `cy_cut` ELSE `doc_cut` END AS show_cy_cut',
                'bkg_date',
                'booker',
                'UPPER(l.`port`) as lp',
                'UPPER(d.`port`) as dp',
                'bkg_no',
                'group_concat(quantity) as quantity',
                'group_concat(container_type) as container_type',
                'state',
                'concat(month, month_no, tag) as company_no'
            ])
            ->join('container_type AS ct ON b.id = ct.bkg_id')
            ->join('requestbook AS rb ON b.id = rb.bkg_id', 'left')
            ->where([
                'ct.delete_at' => [
                    ['exp', 'IS NULL'],
                    ['eq', ''],
                    'or'
                ],
                'rb.delete_at' => [
                    ['exp', 'IS NULL'],
                    ['eq', ''],
                    'or'
                ]
            ])
            ->group('b.id')
            ->limit($current * $size, $size);
        if($sort) {
            $builder->order($sort['prop'] . ' ' . ($sort['order'] === 'ascending' ? 'asc' : 'desc'));
        }
        $info['list'] = $builder->select();
        foreach($info['list'] as &$record){
            $record['ld'] = exportToGetPort($record['lp']) . '-' . exportToGetPort($record['dp']);
        }
        return $info;
    }
    
    public function getReqList($query, $having, $size=100, $current=0){
        $info['total'] = count(
            $this
                ->_beforeQuery($query)
                ->join('LEFT JOIN requestbook AS rb ON b.id = rb.bkg_id')
                ->group('b.id')
                ->field([ 'b.id' ])
                ->having($having)
                ->select()
        );
        $info['list'] = $this
            ->_beforeQuery($query)
            ->field([
                'b.id',
                'CASE `doc_cut` WHEN "" THEN `cy_cut` ELSE `doc_cut` END AS show_cy_cut',
                'bkg_date',
                'booker',
                'request_step as state',
                'UPPER(l.`port`) as lp',
                'UPPER(d.`port`) as dp',
                'bkg_no',
                'group_concat(quantity) as quantity',
                'group_concat(container_type) as container_type',
                'concat(month, month_no, tag) as company_no',
                'SUM(rb.total) as income_total',
                'SUM(be.total) as expend_total',
                't.short_name',
            ])
            ->join('container_type AS ct ON b.id = bkg_id')
            ->join('RIGHT JOIN requestbook AS rb ON b.id = rb.bkg_id')
            ->join('LEFT JOIN bkg_expend AS be ON b.id = be.bkg_id')
            ->having($having)
            ->where([
                'ct.delete_at' => [
                    ['exp', 'IS NULL'],
                    ['eq', ''],
                    'or'
                ]
            ])
            ->group('b.id')
            ->limit($current * $size, $size)
            ->order('show_cy_cut')
            ->select();
        foreach($info['list'] as &$record){
            $record['ld'] = exportToGetPort($record['lp']) . '-' . exportToGetPort($record['dp']);
        }
        // echo $this->getLastSql();die;
        return $info;
    }


    public function getCalendarData($startDate, $endDate, $bkg_type = ''){
        $query  = [
            'l.cy_cut' => [
                ['EGT', $startDate],
                ['ELT', $endDate]
            ],
            'b.delete_at' => [
                ['EXP', 'IS NULL'],
                '',
                'or'
            ]
        ];

        if($bkg_type !== ''){
            $query['bkg_type'] = $bkg_type;
        }
    
        return $this->_beforeQuery($query)
            ->field([
                'b.id',
                'booker',
                'short_name',
                'calendar_status',
                'l.port AS lp',
                'cy_cut',
                'doc_cut',
                'd.port AS dp',
                'sum(quantity) as quantity',
                'bkg_no',
                'state'
            ])
            ->join('container_type AS ct ON b.id = bkg_id')
            ->group('b.id')
            ->select();
    }

    public function getDetailCalendarData($startDate, $endDate){
        $query  = [
            'cd.free_pick_day' => [
                ['EGT', $startDate],
                ['ELT', $endDate]
            ],
            'b.delete_at' => [
                ['EXP', 'IS NULL'],
                '',
                'or'
            ],
            'cd.delete_at' => [
                ['EXP', 'IS NULL'],
                '',
                'or'
            ]
        ];
    
        return $this->_beforeQuery($query)
            ->field([
                'b.id',
                'cd.id as detail_id',
                'booker',
                't.short_name as short_name',
                'transprotation',
                'cd.short_name as transprotation_short_name',
                'calendar_status',
                'l.port AS lp',
                'free_pick_day',
                'd.port AS dp',
                'sum(quantity) as quantity',
                'bkg_no',
            ])
            ->join('container_type AS ct ON b.id = ct.bkg_id')
            ->join('container_detail AS cd ON b.id = cd.bkg_id')
            ->group('cd.id')
            ->select();
    }

    public function deleteOrder($bkgid,$deleteValue){
        $this->where([ 'id' => $bkgid, ])
            ->save([ 'delete_at' => $deleteValue, ]);
    }

    public function changeOrderStep($id, $step){
        return $this->save([
            'id' => $id,
            'step' => $step
        ]);
    }

    public function setCalendarStatus($id, $status){
        return $this->save([
            'id' => $id,
            'calendar_status' => $status
        ]);
    }

    public function changeOrderRequestStep($id, $step){
        return $this->save([
            'id'=>$id,
            'request_step'=>$step
        ]);
    }

    public function checkBkgNo($bkg_id, $bkg_no){
        return $this->where([
            'bkg_no'=>$bkg_no,
            'id'=>[
                'neq', $bkg_id
            ],
            'delete_at' => [
                ['EXP', 'IS NULL'],
                '',
                'or'
            ]
        ])->count();
    }

    public function changeReqInfo($info){
        return $this->save($info);
    }

    protected function _beforeQuery($query){
        return $this
            ->alias('b')
            ->join('port_of_loading AS l ON b.id = l.id')
            ->join('port_of_delovery AS d ON b.id = d.id')
            ->join('trader AS t ON b.id = t.id')
            ->join('container AS c ON b.id = c.id')
            ->where($query);
    }

    public function mvRequestStep($id, $step) {
        $this->save([
            'id' => $id,
            'request_step' => $step
        ]);
    }
}