<?php
class Mage_Reembolso_Block_Adminhtml_Reembolso extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_reembolso';
    $this->_blockGroup = 'reembolso';
    $this->_headerText = Mage::helper('reembolso')->__('Reembolso');
    $this->_addButtonLabel = Mage::helper('reembolso')->__('Nuevo reembolso');
    parent::__construct();
  }
}