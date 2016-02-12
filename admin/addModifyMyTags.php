<?php
/**
 * Created by PhpStorm.
 * User: lyt9304
 * Date: 16/2/10
 * Time: 下午12:37
 */

require_once "../include.php";

header('Content-type: text/json');

$tags=$_POST["tags"];
$type=$_POST["type"];
$modifyTags=array("name"=>$tags);
$sqlRes=update($type,$modifyTags);
$res=array();

if($sqlRes){
    $res["status"]=1;
}else{
    $res["status"]=0;
}

echo json_encode($res);