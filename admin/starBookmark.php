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
$type=$_POST["type"];//star/unstar;
$arr=array();

if($type=="star"){
    $arr["isStared"]=1;
}else{
    $arr["isStared"]=0;
}

$res=modifyIsStared($id,$arr);

echo json_encode($res);
