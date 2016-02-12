<?php
/**
 * Created by PhpStorm.
 * User: lyt9304
 * Date: 16/2/12
 * Time: 上午10:30
 */

require_once "../include.php";

header('Content-type: text/json');

$type=$_POST["type"];
$name=$_POST["tag-name"];
$content_tag=$_POST["content-tag"];
$type_tag=$_POST["type-tag"];
$star=$_POST["star"];
$read=$_POST["read"];

if($type=="all"){
    $res=getAllBookmarks();
}else{
    $arr=array("tag-name"=>$name,"content-tag"=>$content_tag,"type-tag"=>$type_tag,"star"=>$star,"read"=>$read);
    $res=getCondBookmarks($arr);
}


echo json_encode($res);