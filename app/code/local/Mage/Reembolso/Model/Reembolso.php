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
		return $this->getConfigData('montotope');
	}
	public function getValorInferior(){
		return $this->getConfigData('valorinferior');
	}
	public function getValorSuperior(){
		return $this->getConfigData('valorsuperior');
	}
	public function getValorComisionImp(){
		return $this->getConfigData('comisionimp');
	}
	public function getValInfFix(){
		return $this->getConfigData('valinffix');
	}
	public function getValSupFix(){
		return $this->getConfigData('valsupfix');
	}
}