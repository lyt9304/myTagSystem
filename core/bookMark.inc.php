<?php
/**
 * Created by PhpStorm.
 * User: lyt9304
 * Date: 16/2/11
 * Time: 下午4:43
 */

function addModifyBookmark($isAdd,$tag,$id){
    $content_tag=$tag["content_tag"];
    $type_tag=$tag["type_tag"];

    if($isAdd){
        $sqlRes=insert("mytags",$tag);
    }else{
        $sqlRes=update("mytags",$tag,"id=".$id);
    }

    $res=array();

    if($sqlRes===false){
        $res["status"]=0;
    }else{
        $res["status"]=1;
    }

    return $res;
}


function getAllBookmarks(){
    $res=array();
    $sqlRes=fetchAll("select * from mytags order by id DESC");

    $res["status"]=1;
    $res["result"]=$sqlRes;

    return $res;
}

function getCondBookmarks($arr){
    $res=array();
    $flag=false;

    $sql="select * from mytags ";
    $where="";
    $condArr=array();

    //补充条件
    if($arr["tag-name"]!=""){
        $where="name like '%".$arr["tag-name"]."%' ";
        array_push($condArr,$where);
    }

    if($arr["content-tag"]!="nan"){
        $where="content_tag like '%".$arr["content-tag"]."%' ";
        array_push($condArr,$where);
    }

    if($arr["type-tag"]!="nan"){
        $where="type_tag like '%".$arr["type-tag"]."%' ";
        array_push($condArr,$where);
    }

    if($arr["star"]!="nan"){
        $t=$arr["star"]=="yes"?1:0;
        $where="isStared='".$t."' ";
        array_push($condArr,$where);
    }

    if($arr["read"]!="nan"){
        $t=$arr["read"]=="yes"?1:0;
        $where="isRead='".$t."' ";
        array_push($condArr,$where);
    }

    $where="where ".join(" and ",$condArr)." order by id DESC";
    $sql.=$where;
    $sqlRes=fetchAll($sql);
    $res["status"]=1;
    $res["result"]=$sqlRes;

    return $res;
}

function getBookmarkById($id){
    $res=fetchOne("select * from mytags where id=".$id);
    $content=explode(";=;",$res[content_tag]);
    $type=explode(";=;",$res[type_tag]);
    $res["content_tag"]=$content;
    $res["type_tag"]=$type;

    return $res;
}

function deleteBookmarkById($id){
    $res=array();

    $sqlRes=delete("mytags","id=".$id);

    if($sqlRes==0){
        $res["status"]=0;
    }else{
        $res["status"]=1;
    }

    return $res;
}

function modifyIsStared($id,$arr){
    $sqlRes=update("mytags",$arr,"id=".$id);
    $res=array();
    if($sqlRes){
        $res["status"]=1;
    }else{
        $res["status"]=0;
    }

    return $res;
}

function modifyIsRead($id,$arr){
    $sqlRes=update("mytags",$arr,"id=".$id);
    $res=array();
    if($sqlRes){
        $res["status"]=1;
    }else{
        $res["status"]=0;
    }

    return $res;
}