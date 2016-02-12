<?php
require_once "include.php";


$tags=join(", ",array_values(getAllTags("type_tag")));
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>我的标签管理系统</title>

    <!-- Bootstrap core CSS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">我的标签管理系统</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="index.php">标签查询 <span class="sr-only">(current)</span></a></li>
                <li><a href="newBookmark.php">标签新增</a></li>
                <li><a href="contentTag.php">内容标签管理</a></li>
                <li class="active"><a href="typeTag.php">分类标签管理</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <h1 class="page-header">分类标签管理</h1>

            <div class="row">
                <div class="example-wrapper">
                    <div class="tags well">
                        <label class="control-label">内容标签</label>
                        <div id="type-tag" class="tagging-js"><?php echo $tags;?></div>
                        <button class="btn btn-success save-tag">保存修改</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="js/tagging.js"></script>

<script>
    $( document ).ready(function() {
        var t = $( ".tagging-js" ).tagging();
        t[0].addClass( "form-control" );

        $(".save-tag").click(function(e){
            e.preventDefault();
            var tags=t[0].tagging("getTags").join(";=;");

            $.post(
                "admin/addModifyMyTags.php",
                {tags:tags,type:"type_tag"},
                function(data){
                    if(data.status==1){
                        alert("保存成功!");
                    }else{
                        alert("保存失败!");
                    }
                }
            ).error(function(){
                alert("发送失败!");
            })

        });
    });
</script>
</body>
</html>
