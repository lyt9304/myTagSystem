<?php

/**获取所有的tag,以字符串形式返回
 * @param $type 可选content_tag或者type_tag
 * @return string 逗号间隔的全部tag的字符串
 */
function getAllTags($type){
    $sql="select * from ".$type;
    $tags=fetchAll($sql);
    $arr=explode(';=;',$tags[0][name]);;
    return $arr;
}