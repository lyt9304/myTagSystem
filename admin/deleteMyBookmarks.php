<?php
/**
 * Created by PhpStorm.
 * User: lyt9304
 * Date: 16/2/12
 * Time: 下午10:06
 */

require_once "../include.php";
header('Content-type: text/json');

$id=$_POST["id"];

$res=deleteBookmarkById($id);

echo json_encode($res);