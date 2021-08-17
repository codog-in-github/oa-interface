<?php
function addIntoArray(&$arr, $key, $on, $target, $id){
    $idKeyArray = [];
    foreach($target as $row){
        $idKeyArray[$row[$id]][$row['id']] = $row;
    }
    foreach ($arr as &$one){
        $one[$key] = $idKeyArray[$one[$on]];
    }
}

function nextOrderNo($last){
    $preg = '/[349]|(?:001)/';
    while(preg_match($preg,++$last)){}
    return $last;
}
/**
 * 全半角转换
 */
function rmSepStr($mixstr){
    if(gettype($mixstr) === 'array'){
        return array_map('rmSepStr',$mixstr);
    }
    if(isEmpty($mixstr)){
        return '&nbsp;';
    }else{
        $replace = [
            '　' => ' ',
            'ー' => '-',
            '１'=> '1',
            '２'=> '2',
            '３'=> '3',
            '４'=> '4',
            '５'=> '5',
            '６'=> '6',
            '７'=> '7',
            '８'=> '8',
            '９'=> '9',
            '０'=> '0',
            "\n" => '<br/>',
        ];
        return str_replace(array_keys($replace),array_values($replace),$mixstr);
    }
}

function clearEmptyDate($mixstr){
    if(gettype($mixstr) === 'array'){
        return array_map('clearEmptyDate',$mixstr);
    }
    if(isEmptyDate($mixstr)){
        return '';
    }else{
        return $mixstr;
    }
}
/**
 * impoldeWithoutEmpty
 */
function impoldeWithoutEmpty($glue, $array){
    foreach($array as $cell){
        if(!isEmpty($cell)){
            if($str){
                $str .= "$glue$cell";
            }else{
                $str = $cell;
            }
        }
    }
    return $str;
}/**
 * 
 */
function isEmpty($val){
    return !$val || isEmptyDate($val);
}

function isEmptyDate($val){
    return $val == '0000-00-00 00:00:00' || $val == '0000-00-00';
}

function exportToGetPort($portInSql){
    $countryAndPort = explode('(',$portInSql)[0];
    $pice = explode(' ',$countryAndPort);
    unset($pice[0]);
    return implode(' ',$pice);
}