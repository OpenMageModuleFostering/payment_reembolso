<?php

class Mage_Reembolso_Block_Adminhtml_Reembolso_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		
		$fieldset = $form->addFieldset('reembolso_form', array('legend'=>Mage::helper('reembolso')->__('Item information')));

		$fieldset->addField('title', 'text', array(
		  'label'     => Mage::helper('reembolso')->__('Title'),
		  'class'     => 'required-entry',
		  'required'  => true,
		  'name'      => 'title',
		));
		
		$fieldset->addField('above', 'text', array(
		  'label'     => Mage::helper('reembolso')->__('Above'),
		  'class'     => 'required-entry',
		  'required'  => true,
		  'name'      => 'above',
		));

		$fieldset->addField('shipping_method', 'select', array(
		  'label'     => Mage::helper('reembolso')->__('Shipping Methods'),
		  'name'      => 'shipping_method',
		  'values'    => Mage::getResourceModel('reembolso/reembolso_collection')->getShippingMethods(),
		  'selected'  => 'flatrate',
		));

		Mage::log(Mage::helper('reembolso')->__('Shipping Methods'));

		$fieldset->addField('type', 'select', array(
		  'label'     => Mage::helper('reembolso')->__('Type'),
		  'name'      => 'type',
		  'values'    => array(
			  array(
				  'value'     => 1,
				  'label'     => Mage::helper('reembolso')->__('Fixed'),
			  ),

			  array(
				  'value'     => 2,
				  'label'     => Mage::helper('reembolso')->__('Percent'),
			  ),
		  ),
		));

		$fieldset->addField('value', 'text', array(
		  'label'     => Mage::helper('reembolso')->__('Value'),
		  'class'     => 'required-entry',
		  'required'  => true,
		  'name'      => 'value',
		));
		//Mage::log(Mage::registry('reembolso_data')->getData());
		if ( Mage::getSingleton('adminhtml/session')->getReembolsoData() )
		{
		  $form->setValues(Mage::getSingleton('adminhtml/session')->getReembolsoData());
		  Mage::getSingleton('adminhtml/session')->setReembolsoData(null);
		} elseif ( Mage::registry('reembolso_data') ) {
		  $form->setValues(Mage::registry('reembolso_data')->getData());
		}
		return parent::_prepareForm();
	}
}