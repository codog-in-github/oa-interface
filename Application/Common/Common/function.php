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
    if(isEmpty($mixstr) && $mixstr !=='0'){
        return '&nbsp;';
    }else{
        $replace = [
            '　' => '&nbsp;',
            ' ' => '&nbsp;',
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
/**
 * 获取图片的Base64编码(支持url)
 * @author https://keer.me
 *
 * @param $img_file 传入本地图片地址
 *
 * @return string
 */
function imgToBase64($img_file) {
    if (empty($img_file)) {
        return '';
    }
    $img_info = getimagesize($img_file); // 取得图片的大小，类型等
    if (! $img_info) {
        return '';
    }
    $img_base64 = '';
    if (strpos($img_file, 'http') === false)
    {
        if (! file_exists($img_file)) {
            return '';
        }

        $fp = fopen($img_file, "r"); // 图片是否可读权限
        if ($fp) {
            $filesize = filesize($img_file);
            $content = fread($fp, $filesize);
            $file_content = chunk_split(base64_encode($content)); // base64编码
        }
        fclose($fp);
    }
    else
    {
        $file_content = base64_encode(file_get_contents($img_file));
    }

    switch ($img_info[2]) {           //判读图片类型
        case 1: $img_type = "gif";
            break;
        case 2: $img_type = "jpg";
            break;
        case 3: $img_type = "png";
            break;
    }
    $img_base64 = 'data:image/' . $img_type . ';base64,' . $file_content;//合成图片的base64编码

    return $img_base64; //返回图片的base64
}
/**
 * 创建随机id
 */
function getRandomID(){
    return time() . rand(1000, 9999);
}
// 通过 特定键 将数组分组
function array_group($key, $array){
    $group = [];
    foreach($array as $cell){
        $group[$cell[$key]][] = $cell;
    }
    return $group;
}