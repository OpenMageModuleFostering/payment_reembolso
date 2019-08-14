<?php
class Mage_Reembolso_Block_Adminhtml_Reembolso extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_reembolso';
    $this->_blockGroup = 'reembolso';
    $this->_headerText = Mage::helper('reembolso')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('reembolso')->__('Add Item');
    parent::__construct();
  }
}