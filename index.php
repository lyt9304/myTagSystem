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
              <li class="active"><a href="index.php">标签查询 <span class="sr-only">(current)</span></a></li>
              <li><a href="newBookmark.php">标签新增</a></li>
              <li><a href="contentTag.php">内容标签管理</a></li>
              <li><a href="typeTag.php">分类标签管理</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">标签查询</h1>

          <div class="row">
              <form class="form-horizontal" action="addModifyMyBookmarks.php" method="post" id="search-form">
                  <div class="form-group">
                      <label for="tag-name" class="col-sm-2 control-label">标签名称</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-control" id="tag-name" name="tag-name" placeholder="标签名称">
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="content-tag" class="col-sm-2 control-label">内容标签</label>
                      <div class="col-sm-10">
                          <select name="content-tag" id="content-tag" class="form-control">
                              <option value="nan">不限</option>
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
                          <select name="type-tag" id="type-tag" class="form-control">
                              <option value="nan">不限</option>
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
                              <input type="radio" name="star" id="star-no" value="no"> 否
                          </label>
                          <label class="radio-inline">
                              <input type="radio" name="star" id="star-nan" value="nan" checked> 不限
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
                              <input type="radio" name="read" id="read-no" value="no"> 否
                          </label>
                          <label class="radio-inline">
                              <input type="radio" name="read" id="read-nan" value="nan" checked> 不限
                          </label>
                      </div>
                  </div>

                  <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default search-btn" data-target="condition">条件搜索</button>
                          <button type="submit" class="btn btn-info search-btn" data-target="all">显示全部标签</button>
                      </div>
                  </div>
              </form>
          </div>

          <h3 class="sub-header">查询结果</h3>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>名称</th>
                  <th>内容标签</th>
                  <th>分类标签</th>
                  <th>星号</th>
                  <th>已阅读</th>
                  <th>评分</th>
                  <th>备注</th>
                  <th>操作</th>
                </tr>
              </thead>
              <tbody id="search-wrapper">

              </tbody>
            </table>
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
    <script src="js/jquery.tmpl.js"></script>

    <script id="tag-item" type="text/x-jquery-tmpl">
        <tr data-tagid="${id}">
          <th><a href="${href}" target="_blank">${name}</a></th>
          <th>${content_tag}</th>
          <th>${type_tag}</th>
          <th>{{if Number(isStared)}}<span class="glyphicon glyphicon-star icon-true" aria-hidden="true"></span>{{else}}<span class="glyphicon glyphicon-star icon-false" aria-hidden="true"></span>{{/if}}</th>
          <th>{{if Number(isRead)}}<span class="glyphicon glyphicon-ok icon-true" aria-hidden="true"></span>{{else}}<span class="glyphicon glyphicon-ok icon-false" aria-hidden="true"></span>{{/if}}</th>
          <th>${grade}/10分</th>
          <th>${comment}</th>
          <th>
            <button class="modify-btn btn btn-info"><a href="modifyBookmark.php?id=${id}" target="_blank">修改</a></button>
            <button class="delete-btn btn btn-danger">删除</button>
          </th>
        </tr>
    </script>

    <script>
        $( document ).ready(function() {

            $(".search-btn").click(function(e){
                e.preventDefault();

                var target=$(this).data("target");
                var content={type:target};

                if(target=="condition"){
                    content="type=condition&"+$("#search-form").serialize();
                }

                $.post(
                    "admin/searchMyBookmarks.php",
                    content,
                    function(data){
                        if(data.status==1){
                            $("#search-wrapper").empty();
                            if(data.result){
                                for(var i=0;i<data.result.length;i++){
                                    data.result[i]["content_tag"]=data.result[i]["content_tag"].split(";=;").join(", ");
                                    data.result[i]["type_tag"]=data.result[i]["type_tag"].split(";=;").join(", ");
                                }
                                $("#tag-item").tmpl(data.result).appendTo($("#search-wrapper"));
                            }
                        }else{
                            alert("保存失败!");
                        }
                    }
                ).error(function(){
                    alert("发送失败!");
                })

            });


            $("#search-wrapper").delegate(".glyphicon-star","click",function(e){
                var $icon=$(e.target);
                var id=$icon.parents("tr").data("tagid");
                var bhasIcontrue=$icon.hasClass("icon-true");
                var type=bhasIcontrue?"unstar":"star";
                var rmClass=bhasIcontrue?"icon-true":"icon-false";
                var adClass=bhasIcontrue?"icon-false":"icon-true";

                $.post(
                    "admin/starBookmark.php",
                    {id:id,type:type},
                    function(data){
                        if(data.status==1){
                            $icon.removeClass(rmClass).addClass(adClass);
                        }else{
                            alert("操作失败!");
                        }
                    }
                ).error(function(){
                    alert("发送失败!");
                })

            });

            $("#search-wrapper").delegate(".glyphicon-ok","click",function(e){
                var $icon=$(e.target);
                var id=$icon.parents("tr").data("tagid");
                var bhasIcontrue=$icon.hasClass("icon-true");
                var type=bhasIcontrue?"unread":"read";
                var rmClass=bhasIcontrue?"icon-true":"icon-false";
                var adClass=bhasIcontrue?"icon-false":"icon-true";

                $.post(
                    "admin/readBookmark.php",
                    {id:id,type:type},
                    function(data){
                        if(data.status==1){
                            $icon.removeClass(rmClass).addClass(adClass);
                        }else{
                            alert("操作失败!");
                        }
                    }
                ).error(function(){
                    alert("发送失败!");
                })
            });

            $("#search-wrapper").delegate(".delete-btn","click",function(e){

                var id= $(e.target).parents("tr").data("tagid");
                $.post(
                    "admin/deleteMyBookmarks.php",
                    {id:id},
                    function(data){
                        if(data.status==1){
                            alert("删除成功");
                            $("[data-tagid="+id+"]").remove();

                        }else{
                            alert("删除失败!");
                        }
                    }
                ).error(function(){
                    alert("发送失败!");
                });
            });

        });
    </script>
  </body>
</html>
