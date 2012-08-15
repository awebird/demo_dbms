CREATE TABLE `demo_dbms` (
   `id` INT(10) NOT NULL AUTO_INCREMENT,
   `name` VARCHAR(15)  COMMENT '单位名称',
   `url` VARCHAR(30) COMMENT '地址',
   `insert_time` DATETIME NOT NULL COMMENT '插入时间',
   `reserve1` VARCHAR(30) COMMENT '预留字段1',
   `reserve2` VARCHAR(30) COMMENT '预留字段2',
   `reserve3` VARCHAR(30) COMMENT '预留字段3',
   `reserve4` VARCHAR(30) COMMENT '预留字段4',
   PRIMARY KEY (`id`)
) ENGINE=MYISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8