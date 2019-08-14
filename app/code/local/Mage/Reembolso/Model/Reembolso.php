<?php
class Mage_Reembolso_Model_Reembolso extends Mage_Payment_Model_Method_Abstract {

	protected $_code = 'reembolso';

	protected $_formBlockType = 'reembolso/form';
	protected $_infoBlockType = 'reembolso/info';

	public function getReembolsoTitle() {
		return $this->getConfigData('title');
	}

	public function getValorFijo() {
		return $this->getConfigData('valorfijo');
	}

	public function getValorPorcentaje() {
		return $this->getConfigData('valorporcentaje');
	}

	public function getValorTope() {
		return $this->getConfigData('valortope');
	}
}