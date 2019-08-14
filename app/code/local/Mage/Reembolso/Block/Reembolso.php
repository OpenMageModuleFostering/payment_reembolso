<?php
class Mage_Reembolso_Block_Reembolso extends Mage_Core_Block_Template
{

	public function _construct(){
		Mage::log(__FILE__);
	}

	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getReembolso()     
     { 
        if (!$this->hasData('reembolso')) {
            $this->setData('reembolso', Mage::registry('reembolso'));
        }
        return $this->getData('reembolso');
        
    }
}