<?php
class Mage_Reembolso_Model_Adminhtml_Status extends Varien_Object {
	const STATUS_ENABLED	= 1;
	const STATUS_DISABLED	= 2;

	static public function getOptionArray() {
		return array(
			self::STATUS_ENABLED    => Mage::helper('reembolso')->__('Enabled'),
			self::STATUS_DISABLED   => Mage::helper('reembolso')->__('Disabled')
		);
	}
}