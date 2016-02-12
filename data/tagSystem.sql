CREATE DATABASE IF NOT EXISTS `tagSystem`;
USE `tagSystem`;

--内容表
-- `id` TINYINT unsigned auto_increment key,
DROP TABLE IF EXISTS `content_tag`;
CREATE TABLE `content_tag`(
`name` text
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

--分类表
-- `id` TINYINT unsigned auto_increment key,
DROP TABLE IF EXISTS `type_tag`;
CREATE TABLE `type_tag`(
`name` text
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

--标签表
DROP TABLE IF EXISTS `mytags`;
CREATE TABLE `mytags`(
`id` INT unsigned auto_increment key,
`name` varchar(50) not null,
`href` text not null,
`content_tag` varchar(100) default "",
`type_tag` varchar(100) default "",
`cTime` datetime NOT NULL default NOW(),
`isStared` tinyint default 0,
`isRead` tinyint default 0,
`grade` tinyint default 0,
`comment` text
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into type_tag(name) values ("文章;=;文档;=;网站;=;问题解决;=;博客;=;Github项目");
insert into content_tag(name) values ("css;=;html;=;react;=;webpack");

