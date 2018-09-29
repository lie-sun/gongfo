<?php
$sql="
CREATE TABLE IF NOT EXISTS `ims_sf_mini_back` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT 'uplog的id',
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `wish` text NOT NULL,
  `addtime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


INSERT INTO `ims_sf_mini_back` (`id`, `uniacid`, `pid`, `username`, `name`, `wish`, `addtime`) VALUES
(5, 1, 19, 'a.', 'asdsad', 'asdsad', '1464746678');


CREATE TABLE IF NOT EXISTS `ims_sf_mini_exeset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `xtime` int(11) NOT NULL COMMENT '执行间隔时间',
  `imgurl` varchar(100) NOT NULL COMMENT '每天执行开始时间',
  `networkname` varchar(100) NOT NULL COMMENT '每天执行开始时间',
  `fimgurl` varchar(100) NOT NULL COMMENT '每天执行开始时间',
  `ftitle` varchar(100) NOT NULL COMMENT '每天执行开始时间',
  `fcontent` varchar(100) NOT NULL COMMENT '每天执行开始时间',
  `fximgurl` varchar(100) NOT NULL COMMENT '每天执行开始时间',
  `bgimgurl` varchar(100) NOT NULL COMMENT '每天执行开始时间',
  `musicurl` varchar(100) NOT NULL COMMENT '每天执行开始时间',
  `stime` varchar(100) NOT NULL COMMENT '每天执行开始时间',
  `status` int(11) NOT NULL COMMENT '状态 0或1表示开启 2关闭',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;


INSERT INTO `ims_sf_mini_exeset` (`id`, `uniacid`, `xtime`, `stime`, `status`) VALUES
(1, 0, 1, '12:00', 1),
(2, 1, 1, '12:00', 0);

CREATE TABLE IF NOT EXISTS `ims_sf_mini_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `oid` varchar(255) NOT NULL COMMENT '生成的订单号',
  `nickname` varchar(100) NOT NULL COMMENT '用户昵称',
  `openid` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL COMMENT '用户id',
  `tel` varchar(100) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '0:未支付1:已支付',
  `prepay_id` varchar(255) NOT NULL COMMENT '交易标识',
  `total_fee` decimal(18,2) NOT NULL COMMENT '支付金额',
  `addtime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='下单成功时未支付的订单参数。' AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ims_sf_mini_paiwei` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `imgurl` varchar(200) NOT NULL COMMENT '已获得排位图片',
  `nimgurl` varchar(250) NOT NULL COMMENT '未获得排位图片',
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;


INSERT INTO `ims_sf_mini_paiwei` (`id`, `uniacid`, `name`, `imgurl`, `nimgurl`, `sort`) VALUES
(1, 1, '峨眉山', 'images/1/2016/06/Auo03316xXo9KAz63oD3F9zzo6Zx9U.png', 'images/1/2016/06/z8JwzWTBU8dsJ3xgt3K1wIWZZZG5SS.png', 3),
(2, 1, '五台山', '', 'http://localhost/ueditor/php/upload/image/20160601/1464745427363618.png', 0),
(3, 1, '普陀山', 'http://localhost/ueditor/php/upload/image/20160601/1464745446928797.png', 'http://localhost/ueditor/php/upload/image/20160601/1464745457829566.png', 0),
(4, 1, '九华山', 'http://localhost/ueditor/php/upload/image/20160601/1464745490540952.png', 'http://localhost/ueditor/php/upload/image/20160601/1464745481123471.png', 0),
(5, 1, '终南山', 'http://localhost/ueditor/php/upload/image/20160601/1464745513111796.png', 'http://localhost/ueditor/php/upload/image/20160601/1464745521863131.png', 0);


CREATE TABLE IF NOT EXISTS `ims_sf_mini_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `class` int(11) NOT NULL COMMENT '1鲜花 2 香 3水果',
  `imgurl` varchar(200) NOT NULL COMMENT '图片',
  `wimgurl` varchar(200) NOT NULL COMMENT '上佛完成显示图片首页',
  `price` decimal(18,2) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;


INSERT INTO `ims_sf_mini_price` (`id`, `uniacid`, `name`, `class`, `imgurl`, `wimgurl`, `price`, `sort`) VALUES
(4, 1, '蝴蝶兰', 1, 'images/1/2016/06/GY7Ypypzp2z72xGpPYCpFBbGpbcopM.png', 'images/1/2016/06/wzmC8Po5Z4BtMTd02GhcU0M4T8H4Zt.png', '1.12', 8),
(5, 1, '荷花', 1, 'images/1/2016/06/DOtv4Xy47X77O6p33X7X87L7nq4Y4y.png', 'images/1/2016/06/T4qCzXOCp9O4jNVP724wNo29A944cv.png', '1.88', 7),
(6, 1, '鸡蛋花', 1, 'images/1/2016/06/fcmP3zThHBbY37KLLM77pmU2w33Uk4.png', 'images/1/2016/06/M993P4lWa4PNLtNLll94nJlO39YYWl.png', '8.88', 6),
(8, 1, '平安香', 2, 'images/1/2016/06/C1j1D1kWjb1zO47G70C14j0vd9DJkb.png', 'images/1/2016/06/Rzs6SSjdJLdS6zvRD48tLAEkVQKaAA.png', '2.00', 8),
(9, 1, '苹果', 3, 'images/1/2016/06/Mm3kcYKr2tUkLxC7yrXmqIXUxKXq6c.png', 'images/1/2016/06/CZ5BF6HwwBsuM5HpwB3Ww05830Efzw.png', '0.00', 0);


CREATE TABLE IF NOT EXISTS `ims_sf_mini_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `ruleone` text NOT NULL,
  `ruletwo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `ims_sf_mini_rule` (`id`, `uniacid`, `ruleone`, `ruletwo`) VALUES
(1, 1, '&lt;h3&gt;榜单规则&lt;/h3&gt;&lt;p&gt;师兄吉祥，随喜您参与“供佛精进榜”活动。&lt;/p&gt;&lt;p&gt;规则：连续供佛7天即可登上精进榜并得到祈福或超度牌位（二选一）。&lt;/p&gt;&lt;p&gt;祈愿牌位将由【善知识联盟】观一旅朝圣团领队师兄统一带到圣地寺院由大师进行祈福或超度，活动真实不虚。&lt;/p&gt;&lt;p&gt;请每天坚持供佛获得祈愿牌位，若供佛修行期间间断一日，系统将会清零您的供佛记录。&lt;/p&gt;', '&lt;p class=&quot;title&quot;&gt;近期预告&lt;/p&gt;&lt;p class=&quot;desc&quot;&gt;\r\n				我们将于06月04日朝圣五台山，您在05月25日-06月04日之间连续供佛达到7天，即可获得牌位一尊。&lt;/p&gt;');


CREATE TABLE IF NOT EXISTS `ims_sf_mini_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `totatime` int(11) NOT NULL COMMENT '本月总次数',
  `andtime` int(11) NOT NULL COMMENT '连续上佛天数',
  `status` int(11) NOT NULL DEFAULT '0',
  `uptime` int(11) NOT NULL COMMENT '上佛时间',
  `addtime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


INSERT INTO `ims_sf_mini_sign` (`id`, `uniacid`, `openid`, `nickname`, `totatime`, `andtime`, `status`, `uptime`, `addtime`) VALUES
(2, 1, 'oY7u7s7HAb302BmdfZ0LJ8X2pZbA', '', 7, 7, 0, 49, ''),
(7, 1, 'oY7u7s7HAb302BmdfZ0LJ8X2pZbA', 'a.', 4, 7, 0, 52, '1464934727');

CREATE TABLE IF NOT EXISTS `ims_sf_mini_uplog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `goods` varchar(100) NOT NULL COMMENT '买了什么',
  `goodsid` varchar(100) NOT NULL COMMENT '物品id',
  `pay` decimal(18,2) NOT NULL COMMENT '花费记录',
  `status` int(5) NOT NULL,
  `upnum` int(11) NOT NULL,
  `uptime` varchar(100) NOT NULL COMMENT '上佛时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='上佛记录' AUTO_INCREMENT=25 ;



INSERT INTO `ims_sf_mini_uplog` (`id`, `uniacid`, `openid`, `nickname`, `goods`, `goodsid`, `pay`, `status`, `upnum`, `uptime`) VALUES
(19, 1, 'oY7u7s7HAb302BmdfZ0LJ8X2pZbA', 'a.', '蝴蝶兰,平安香,苹果', '4,8,11', '122.00', 0, 52, '1464924384'),
(21, 1, 'oY7u7s7HAb302BmdfZ0LJ8X2pZbA', 'a.', '蝴蝶兰,平安香,苹果', '4,8,11', '10.00', 0, 25, '1464924775'),
(22, 1, '', 'a.', '蝴蝶兰,平安香,苹果', '4,8,11', '0.00', 0, 0, '1464924384'),
(24, 1, 'oY7u7s7HAb302BmdfZ0LJ8X2pZbA', 'a.', '蝴蝶兰,平安香,苹果', '4,8,11', '0.00', 0, 25, '1464934727');

CREATE TABLE IF NOT EXISTS `ims_sf_mini_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '微信用户的唯一标识',
  `nickname` varchar(255) DEFAULT NULL COMMENT '微信用户的昵称',
  `headurl` varchar(500) DEFAULT NULL COMMENT '微信用户的头像地址',
  `tel` varchar(255) DEFAULT NULL COMMENT '手机号',
  `sex` varchar(20) NOT NULL COMMENT '性别',
  `address` varchar(200) NOT NULL COMMENT '地址',
  `endtime` datetime DEFAULT NULL COMMENT '有效期',
  `isscribe` int(11) NOT NULL DEFAULT '0' COMMENT '0未关注1已关注2取消关注',
  `paiwei` varchar(100) NOT NULL COMMENT '获得的排位',
  `money` double DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '状态（0：冻结，1：正常）',
  `addtime` datetime DEFAULT NULL COMMENT '会员添加时间',
  `lasttime` varchar(100) NOT NULL COMMENT '会员最后登入日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=94 ;


INSERT INTO `ims_sf_mini_user` (`id`, `uniacid`, `openid`, `nickname`, `headurl`, `tel`, `sex`, `address`, `endtime`, `isscribe`, `paiwei`, `money`, `status`, `addtime`, `lasttime`) VALUES
(67, 1, 'oGA-dwvplK-ybZACO3FmsgYVRwzY', '陈俊坤_', 'http://wx.qlogo.cn/mmopen/hqDXUD6csUicKR7kpPBnsZ2IgcDica1neNESY7BKqHh86IwicxOibYVFialnz7pQ1iawfB50eE5yaH7SP2PLicJ4ibibcng/0', NULL, '0', '', NULL, 0, '', NULL, 1, '2016-02-09 15:05:18', ''),
(78, 1, 'oGA-dwqxe1XwfGvTNyJ7e4tna2Ys', '锦衣卫', 'http://wx.qlogo.cn/mmopen/AiaQ2bV0ZHFXJmfWrzQ637tDCdXuHMhGRAxL6Bqe8a7UocHtdgOvdqCoGBF9QSZHdhRF9uicMPDJXLyiaQwQTELEgNW38RzCX1B/0', NULL, '0', '', NULL, 0, '', NULL, 1, '2016-02-18 14:44:40', ''),
(93, 1, 'oY7u7s7HAb302BmdfZ0LJ8X2pZbA', 'a.', 'http://wx.qlogo.cn/mmopen/hqDXUD6csUicKR7kpPBnsZ2IgcDica1neNESY7BKqHh86IwicxOibYVFialnz7pQ1iawfB50eE5yaH7SP2PLicJ4ibibcng/0', NULL, '1', '', NULL, 0, '3,5,4,1,6,2', NULL, 1, '2016-06-03 15:05:18', '1465130028');

CREATE TABLE IF NOT EXISTS `ims_sf_mini_userlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) NOT NULL,
  `openid` varchar(255) DEFAULT NULL COMMENT '微信用户的唯一标识',
  `nickname` varchar(255) DEFAULT NULL COMMENT '微信用户的昵称',
  `headurl` varchar(500) DEFAULT NULL COMMENT '微信用户的头像地址',
  `tel` varchar(255) DEFAULT NULL COMMENT '手机号',
  `endtime` datetime DEFAULT NULL COMMENT '有效期',
  `paiwei` varchar(100) NOT NULL COMMENT '获得的排位',
  `money` double DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '状态（0：冻结，1：正常）',
  `addtime` datetime DEFAULT NULL COMMENT '会员添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=94 ;


INSERT INTO `ims_sf_mini_userlog` (`id`, `uniacid`, `openid`, `nickname`, `headurl`, `tel`, `endtime`, `paiwei`, `money`, `status`, `addtime`) VALUES
(67, 1, 'oGA-dwvplK-ybZACO3FmsgYVRwzY', '陈俊坤_', 'http://wx.qlogo.cn/mmopen/hqDXUD6csUicKR7kpPBnsZ2IgcDica1neNESY7BKqHh86IwicxOibYVFialnz7pQ1iawfB50eE5yaH7SP2PLicJ4ibibcng/0', NULL, NULL, '', NULL, 1, '2016-02-09 15:05:18'),
(78, 1, 'oGA-dwqxe1XwfGvTNyJ7e4tna2Ys', '锦衣卫', 'http://wx.qlogo.cn/mmopen/AiaQ2bV0ZHFXJmfWrzQ637tDCdXuHMhGRAxL6Bqe8a7UocHtdgOvdqCoGBF9QSZHdhRF9uicMPDJXLyiaQwQTELEgNW38RzCX1B/0', NULL, NULL, '', NULL, 1, '2016-02-18 14:44:40'),
(93, 1, 'oY7u7s7HAb302BmdfZ0LJ8X2pZbA', 'a.', 'http://wx.qlogo.cn/mmopen/hqDXUD6csUicKR7kpPBnsZ2IgcDica1neNESY7BKqHh86IwicxOibYVFialnz7pQ1iawfB50eE5yaH7SP2PLicJ4ibibcng/0', NULL, NULL, '3,5,4,1,6,2', NULL, 1, '2016-02-09 15:05:18');
";
pdo_query($sql);