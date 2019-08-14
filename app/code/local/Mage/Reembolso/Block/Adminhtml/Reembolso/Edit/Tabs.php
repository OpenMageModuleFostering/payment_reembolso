<?php

class Mage_Reembolso_Block_Adminhtml_Reembolso_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('reembolso_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('reembolso')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('reembolso')->__('Item Information'),
          'title'     => Mage::helper('reembolso')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('reembolso/adminhtml_reembolso_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}