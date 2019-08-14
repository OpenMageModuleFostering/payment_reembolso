<?php
class Mage_Reembolso_Block_Info extends Mage_Payment_Block_Info {

	protected function _construct() {
		parent::_construct();
		$this->setTemplate('reembolso/info.phtml');
	}
}