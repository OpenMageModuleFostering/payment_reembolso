<?php

class Mage_Reembolso_Block_Adminhtml_Reembolso_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'reembolso';
        $this->_controller = 'adminhtml_reembolso';
        
        $this->_updateButton('save', 'label', Mage::helper('reembolso')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('reembolso')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('reembolso_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'reembolso_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'reembolso_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('reembolso_data') && Mage::registry('reembolso_data')->getId() ) {
            return Mage::helper('reembolso')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('reembolso_data')->getTitle()));
        } else {
            return Mage::helper('reembolso')->__('Add Item');
        }
    }
}