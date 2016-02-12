<?php
/**
 * Created by PhpStorm.
 * User: lyt9304
 * Date: 16/2/10
 * Time: 下午12:42
 */

session_start();
define("ROOT",dirname(__FILE__));
set_include_path(".".PATH_SEPARATOR.ROOT."/lib".PATH_SEPARATOR.ROOT."/core".PATH_SEPARATOR.ROOT."/configs".PATH_SEPARATOR."/core".PATH_SEPARATOR.get_include_path());
require_once "configs.php";
require_once 'mysql.func.php';
require_once 'tag.inc.php';
require_once 'bookMark.inc.php';
connect();