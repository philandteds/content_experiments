DROP TABLE IF EXISTS `node_variations`;
CREATE TABLE `node_variations` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `node_id` int(11) unsigned NOT NULL,
  `variation_node_id` int(11) unsigned NOT NULL,
  `version` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;