-- ----------------------------
--  Table structure for `#__articles_articles`
-- ----------------------------
CREATE TABLE IF NOT EXISTS `#__articles_articles` (
  `articles_article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `cck_fieldset_id` int(11) NOT NULL DEFAULT '31',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `publish_up` date NOT NULL DEFAULT '0000-00-00',
  `publish_down` date NOT NULL DEFAULT '0000-00-00',
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'article',
  `ordering` bigint(20) unsigned NOT NULL,
  `frontpage` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `modified_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `locked_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `locked_by` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`articles_article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;