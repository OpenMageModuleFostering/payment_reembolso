<?php
class Mage_Reembolso_Block_Form extends Mage_Payment_Block_Form {

	protected function _construct() {
		Mage::log('Form de reembolso');
		parent::_construct();
		$this->setTemplate('reembolso/form.phtml');
	}
}