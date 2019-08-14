<?php

class Mage_Reembolso_Model_Mysql4_Reembolso extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the reembolso_id refers to the key field in your database table.
        $this->_init('reembolso/reembolso', 'reembolso_id');
    }
}