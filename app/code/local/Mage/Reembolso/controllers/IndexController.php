<?php
class Mage_Reembolso_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/reembolso?id=15 
    	 *  or
    	 * http://site.com/reembolso/id/15 	
    	 */
    	/* 
		$reembolso_id = $this->getRequest()->getParam('id');

  		if($reembolso_id != null && $reembolso_id != '')	{
			$reembolso = Mage::getModel('reembolso/reembolso')->load($reembolso_id)->getData();
		} else {
			$reembolso = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($reembolso == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$reembolsoTable = $resource->getTableName('reembolso');
			
			$select = $read->select()
			   ->from($reembolsoTable,array('reembolso_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$reembolso = $read->fetchRow($select);
		}
		Mage::register('reembolso', $reembolso);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}