<?php
class Mage_Reembolso_Model_Reembolso extends Mage_Payment_Model_Method_Abstract {

	protected $_code = 'reembolso';
	
	protected $_formBlockType = 'reembolso/form';
	protected $_infoBlockType = 'reembolso/info';

	public function isAvailable($quote=null){
		$allow 	= true;
		$data	= $this->getShippMethod();
		
		if($data['error']) $allow 	= false;
		return $allow;
	}
	
	// Tomar todos los datos desde los parametros almacenados en la DB
	
	public function getShippMethod(){
		$quote	= Mage::getModel('checkout/session')->getQuote();
		$ids	= array();
		$data	= array();
		// trae el Metodo de envio
		foreach($quote->getAllShippingAddresses() as $addr){
			array_push($ids,$addr->getShippingMethod());
		}
		
		// se agrega esta linea porque si no esta instanciado el Chek Out no encuentra ningun ShippingMethod y da error
		if(empty($ids))	$ids[0]	= 1;
		
		// trae el total de la compra
		$subtotal	= $quote->getTotals();
		// traigo todos los datos del metodo de envio
		$data = Mage::getModel('reembolso/adminhtml_reembolso')->getResourceCollection()->getMethodPayment($ids[0],$subtotal['subtotal']->getData('value'));
		
		// esto no lo usa. Si el metodo no esta definido en la DB, no muestra el contrarembolso (isAvailable)
		if($data['error']){
				$data['id']				= 0;
				$data['title']			= Mage::helper('adminhtml')->__('Sin definir');
				$data['descript']		= Mage::helper('adminhtml')->__('Sin definir');
				$data['shipping']		= Mage::helper('adminhtml')->__('Sin definir');
				$data['type']			= 1;
				$data['value']			= 0;
				$data['total_shipping']	= 0;
		}
		// ----------------------------------------------
		
		return $data;
	}
	
	// esta casi que ni se usa
	public function getReembolsoTitle(){		
		// aca tomo el titulo
		$data	= $this->getShippMethod();
		
		return $data['title'];
	}
	
	public function getReembolsoDescript(){		
		// aca tomo el titulo
		$data	= $this->getShippMethod();
		
		return $data['descript'];
	}
	
	public function getTitle(){
		// aca tomo el titulo
		$data	= $this->getShippMethod();
		
		return $data['title'];
	}

}