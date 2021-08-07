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

function rmSepStr($mixstr){
    if(gettype($mixstr) === 'array'){
        return array_map('rmSepStr',$mixstr);
    }
    return str_replace('　',' ',$mixstr);
}