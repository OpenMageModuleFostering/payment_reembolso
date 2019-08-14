<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('reembolso')};
CREATE TABLE {$this->getTable('reembolso')} (
  `reembolso_id` int(11) unsigned NOT NULL auto_increment,
  `title` 				varchar(255) 	NOT NULL default '',
  `shipping_method` 	varchar(255) 	NOT NULL default '',
  `type` 				smallint(6) 	NOT NULL default '0',
  `value` 				smallint(6) 	NOT NULL default '0',
  `above` 				smallint(6) 	NOT NULL default '0',
  PRIMARY KEY (`reembolso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");
	
$installer->endSetup(); 