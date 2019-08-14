<?php
class Mage_Reembolso_Model_Reembolso extends Mage_Payment_Model_Method_Abstract {

	protected $_code = 'reembolso';

	protected $_formBlockType = 'reembolso/form';
	protected $_infoBlockType = 'reembolso/info';

	protected function __contruct(){
			$this->setReembolsoTitle($this->getConfigData('title'));
			$this->setValorTope($this->getConfigData('montotope'));
			$this->setValorInferior($this->getConfigData('valorinferior'));
			$this->setValorSuperior($this->getConfigData('valorsuperior'));
			$this->setValInfFix($this->getConfigData('valinffix'));
			$this->setValSupFix($this->getConfigData('valsupfix'));
			$this->setCustomTextForm($this->getConfigData('customtextform'));
			$this->setCustomTextInfo($this->getConfigData('customtextinfo'));
	}
}