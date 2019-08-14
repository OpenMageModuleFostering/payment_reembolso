<?php
class Mage_Reembolso_Model_Mysql4_Reembolso_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('reembolso/reembolso');
    }
	
	public function prepareSummary(){
		$this->setConnection($this->getResource()->getReadConnection());
		$this->getSelect()
			->from(array('main_table'=>$this->getTable('reembolso')),array(
				'reembolso_id',
				'title',
				'shipping_method',
				'type',
				'value',
				'above',
				))
			->group(array('reembolso_id'));
		return $this;
	}
	
	public function getShippingMethods(){
		$keys=array();
		foreach(Mage::getModel('adminhtml/system_config_source_shipping_allmethods')->toOptionArray() as $key=>$method){
			$keys[$key.'_'.$key] = $method['label'];
		}
		return $keys;
	}
	
	
	// ----------------------------------
	
	
	public function getMethodPayment($shipping=null,$total=null){
		/* el $shipping trae el metodo de envio y el $total trae el total de la compra
		para saber que metodo se debe asignar, segun el above de la DB */
		$datos			= array();
		$datos['error']	= false;
		$items			= array();
		
		if($shipping === null) return ;
		if($total 	 === null) return ;

		$this
			->addFieldToFilter('shipping_method',$shipping)
			->addFieldToFilter('above',array('lt'=>$total))
			->getSelect()
			->order('above DESC');

		$items	= $this->getItems();

		if(empty($items)){
			$datos['error']	= true;
			return $datos;
		}
		
		$datos['id']		= $items[0]->getData('reembolso_id');
		$datos['title']		= $items[0]->getData('title');
		$datos['shipping']	= $items[0]->getData('shipping_method');
		$datos['type']		= $items[0]->getData('type');
		$datos['value']		= $items[0]->getData('value');
		
		if($datos['type'] == 1){ // 1=>'Fixed' - 2=>'Percent'
			$total_envio	= $datos['value'];
			$total_final	= $total + $datos['value'];
		} else {
			$total_envio	= ($total * ($datos['value']/100));
			$total_final	= $total + ($total * $datos['value']/100);
		}
		$datos['total_shipping']	= $total_envio;
		$datos['total']				= $total_final;
		
		return $datos;
	}
	
}