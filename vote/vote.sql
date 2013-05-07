/*
MySQL Backup
Source Host:           localhost
Source Server Version: 4.0.17-nt
Source Database:       vote
Date:                  2005-08-09 10:54:54
*/

use vote ;
#----------------------------
# Table structure for guestbook
#----------------------------
create table guestbook (
   id int(11) not null auto_increment,
   addtime datetime not null default '0000-00-00 00:00:00',
   name varchar(50) not null,
   ip varchar(50) not null,
   mail varchar(50) not null,
   tel varchar(50) not null,
   url varchar(50) not null,
   content longtext not null,
   title varchar(50) not null,
   reply longtext not null,
   del tinyint(1) not null default '0',
   owner tinyint(4) not null default '0',
   primary key (id))
   type=MyISAM;

#----------------------------
# Records for table guestbook
#----------------------------


insert  into guestbook values 
(2, '2004-02-13 00:16:31', '鐵路網Webmaster', '127.0.0.1', 'yueguang@126.com', '999', 'http://www.railnet.cn', 0xC7EBD7A2D2E2A3BA0D0A31A1A2B7C7B3A3BBB6D3ADC4FABECDB1BECDF8D5BEB5C4B7FECEF1CCE1B3F6BAC3B5C4BDA8D2E9A1A30D0A32A1A2C7EBCEF0D4DAB4CBB7A2B1EDB9A5BBF7D5FEB8AEA1A2D5FEB2DFBACDCBFBC8CBB5C4B9FDBCA4D1D4C2DBA3AC4F4BA3BF200D0A203A3A3A3A20C7EB20C4FA20C1F420D1D4203A3A3A3A200D0A, '不錯', 0xD0BBD0BBC4FAB6D4CDF8D5BEB5C4B9D8D0C4A1A320D0BBD0BBC4FAB6D4CDF8D5BEB5C4B9D8D0C4A1A320, 0, 0);
#----------------------------
# Table structure for vote
#----------------------------
create table vote (
   id int(11) not null auto_increment,
   title varchar(255) not null,
   `desc` varchar(255) not null,
   class tinyint(1) not null default '0',
   talk tinyint(4) not null default '0',
   valuedate date not null default '0000-00-00',
   isuser tinyint(1) not null default '0',
   perip int(11) not null default '0',
   primary key (id))
   type=MyISAM;

#----------------------------
# Records for table vote
#----------------------------


insert  into vote values 
(1, '你是不是PHP愛好者協會會員？', 'lsjd;ghdsnlsjd', 0, 1, '2007-05-31', 56, 56), 
(2, '你喜歡本站的調查系統嗎？', '', 0, 0, '2006-05-31', 0, 0), 
(3, '你喜歡本站的調查系統嗎？', '', 0, 0, '2006-05-31', 0, 0), 
(4, '05年春運全國鐵路運送旅客將增長3.5%', '', 1, 0, '2006-06-30', 0, 0), 
(5, '05年春運全國鐵路運送旅客將增長3.5%', '', 1, 0, '2006-06-30', 0, 0), 
(6, '誰有好看的圖片？', '', 0, 0, '2005-12-31', 0, 0);
#----------------------------
# Table structure for voteguest
#----------------------------
create table voteguest (
   id int(11) not null auto_increment,
   Vid int(11) not null default '0',
   class int(1) not null default '0',
   `text` varchar(30) not null,
   `date` date not null default '0000-00-00',
   `count` int(11) not null default '0',
   new varchar(200) not null,
   primary key (id))
   type=MyISAM;

#----------------------------
# Records for table voteguest
#----------------------------


insert  into voteguest values 
(1, 1, 0, '', '2005-07-25', 0, ''), 
(2, 1, 0, '', '2005-07-28', 0, ''), 
(3, 1, 0, '10.118.78.100', '2005-07-28', 10, ''), 
(4, 1, 0, '10.118.78.10', '2005-07-27', 1, ''), 
(6, 1, 1, 'yueguang@railnet.cn', '0000-00-00', 2, '0'), 
(7, 1, 1, 'yueguang@railnet.cn', '2005-07-28', 3, ''), 
(8, 1, 1, 'yueguang@railnet.cn', '2005-07-28', 3, ''), 
(9, 1, 1, 'yueguang@railnet.cn', '2005-07-28', 3, ''), 
(10, 1, 0, '10.105.109.6', '2005-07-30', 10, ''), 
(11, 1, 1, 'coollk@sina.com', '2005-07-30', 1, '0'), 
(12, 1, 1, 'coollk@tom.com', '2005-07-30', 1, '0'), 
(13, 1, 1, '', '2005-07-30', 0, '(1)'), 
(14, 1, 1, '', '2005-07-30', 0, '(1,2)'), 
(15, 1, 1, '', '2005-07-30', 0, '(2)'), 
(16, 1, 1, 'coollk@tom.com', '2005-07-30', 0, '(2)'), 
(17, 1, 0, '10.118.78.100', '2005-07-30', 4, ''), 
(18, 1, 0, '10.118.78.100', '2005-07-31', 9, ''), 
(19, 1, 1, 'aladdin@railnet.cn', '2005-07-31', 2, '0');
#----------------------------
# Table structure for voteitem
#----------------------------
create table voteitem (
   id mediumint(10) not null auto_increment,
   Vid int(5) not null default '0',
   `desc` varchar(150) not null,
   img varchar(150) not null,
   `count` int(10) not null default '0',
   primary key (id))
   type=MyISAM;

#----------------------------
# Records for table voteitem
#----------------------------


insert  into voteitem values 
(1, 1, '是', 'http://survey.it.sohu.com/images/red.gif', 59), 
(2, 1, '否', 'http://survey.it.sohu.com/images/blue.gif', 28), 
(9, 1, '看看再說', 'http://localhost/aa.jpg', 5), 
(8, 5, '好極了', '', 1), 
(10, 6, '我有', '', 0);

