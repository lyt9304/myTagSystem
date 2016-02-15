<?php
require_once "include.php";
$content_tags=getAllTags("content_tag");
$type_tags=getAllTags("type_tag");
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
                <li class="active"><a href="newBookmark.php">标签新增</a></li>
                <li><a href="contentTag.php">内容标签管理</a></li>
                <li><a href="typeTag.php">分类标签管理</a></li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

            <h1 class="page-header">标签新增</h1>

            <div class="row">
                <form class="form-horizontal" id="new-tag-form">
                    <div class="form-group">
                        <label for="tag-name" class="col-sm-2 control-label">标签名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tag-name" name="tag-name" placeholder="标签名称">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tag-href" class="col-sm-2 control-label">链接地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tag-href" name="tag-href" placeholder="链接地址">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content-tag" class="col-sm-2 control-label">内容标签</label>
                        <div class="col-sm-10">
                            <select name="content-tag[]" id="content-tag" multiple="multiple" class="form-control">
                                <?php
                                if($content_tags && is_array($content_tags)):
                                    foreach($content_tags as $v):
                                        ?>
                                        <option value="<?php echo $v ?>"><?php echo $v ?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type-tag" class="col-sm-2 control-label">类型标签</label>
                        <div class="col-sm-10">
                            <select name="type-tag[]" id="type-tag" multiple="multiple" class="form-control">
                                <?php
                                if($type_tags && is_array($type_tags)):
                                    foreach($type_tags as $v):
                                        ?>
                                        <option value="<?php echo $v ?>"><?php echo $v ?></option>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否加星</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="star" id="star-yes" value="yes"> 是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="star" id="star-no" value="no" checked> 否
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">是否已阅读</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="read" id="read-yes" value="yes"> 是
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="read" id="read-no" value="no" checked> 否
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="grade" class="col-sm-2 control-label">阅读评分</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="range" name="grade" id="grade" min="0" max="10" step="1"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comment" class="col-sm-2 control-label">备注</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="comment" id="comment" cols="30" rows="5"></textarea>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success save-tag">提交新增</button>
                        </div>
                    </div>
                </form>
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
        $(".save-tag").click(function(e){
            e.preventDefault();

//            去掉comment的空白字符
            var $comment=$("#comment");
            var comment=$("#comment").val().trim();
            $comment.val(comment);

            var content=$("#new-tag-form").serialize();

            $.post(
                "admin/addModifyMyBookmarks.php",
                content,
                function(data){
                    if(data.status==1){
                        alert("保存成功!");
                        window.location.reload();
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
