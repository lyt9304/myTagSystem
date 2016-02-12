<?php
/**
 * Created by PhpStorm.
 * User: lyt9304
 * Date: 16/2/12
 * Time: 下午10:21
 */
require_once "../include.php";
header('Content-type: text/json');

$id=$_POST["id"];
$type=$_POST["type"];//read/unread;
$arr=array();

if($type=="read"){
    $arr["isRead"]=1;
}else{
    $arr["isRead"]=0;
}

$res=modifyIsRead($id,$arr);

echo json_encode($res);
