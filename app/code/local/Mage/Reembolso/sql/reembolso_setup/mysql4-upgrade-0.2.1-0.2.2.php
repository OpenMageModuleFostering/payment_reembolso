<?php

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE {$this->getTable('reembolso')} ADD descript	varchar(500)

");
	
$installer->endSetup();