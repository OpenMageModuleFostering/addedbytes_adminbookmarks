<?php

$installer = $this;

$installer->startSetup();

$bookmark_table = $this->getTable('addedbytesadminbookmarks/bookmark');

$installer->run("
DROP TABLE IF EXISTS `" . $bookmark_table . "`;
CREATE TABLE `" . $bookmark_table . "` (
  `bookmark_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bookmark_name` varchar(50) NOT NULL,
  `bookmark_url` varchar(500) NOT NULL,
  `bookmark_route` varchar(200) NOT NULL,
  `bookmark_item_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Creation Time',
  PRIMARY KEY (`bookmark_id`),
  KEY `user_id` (`user_id`),
  KEY `is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin Bookmarks Table';
");

$installer->endSetup();
