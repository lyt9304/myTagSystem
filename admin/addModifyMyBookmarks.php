<?php
/**
 * Created by PhpStorm.
 * User: lyt9304
 * Date: 16/2/12
 * Time: 上午10:30
 */

require_once "../include.php";

header('Content-type: text/json');

$id=$_POST["tagid"];
$name=$_POST["tag-name"];
$href=$_POST["tag-href"];
$content_tag=$_POST["content-tag"];
$type_tag=$_POST["type-tag"];
$star=$_POST["star"]=="yes"?1:0;
$read=$_POST["read"]=="yes"?1:0;
$grade=$_POST["grade"];
$comment=$_POST["comment"]==""?"暂无":$_POST["comment"];

if($content_tag && is_array($content_tag)){
    $content_tag=join(";=;",$content_tag);
}else{
    $content_tag="";
}

if($type_tag && is_array($type_tag)){
    $type_tag=join(";=;",$type_tag);
}else{
    $type_tag="";
}

$tag=array("name"=>$name,"href"=>$href,"isStared"=>$star,"isRead"=>$read,"grade"=>$grade,"comment"=>$comment,"content_tag"=>$content_tag,"type_tag"=>$type_tag);

if($id){
    $isAdd=false;
}else{
    $isAdd=true;
}

$res=addModifyBookmark($isAdd,$tag,$id);

echo json_encode($res);