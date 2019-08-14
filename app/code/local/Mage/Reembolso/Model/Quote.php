<?php
class Mage_Reembolso_Model_Quote extends Mage_Sales_Model_Quote {

	public function getTotals() {	
		$res = parent::getTotals();
		if (isset($res['shipping']) && is_object($res['shipping'])) {
			if (!is_null($this->_payments) && $this->getPayment()->hasMethodInstance() && $this->getPayment()->getMethodInstance()->getCode() == 'reembolso') {
				$model = Mage::getModel('reembolso/reembolso');
				$res['shipping']->setData('title',$res['shipping']->getData('title') . ' + ' . $model->getReembolsoTitle());
			}
		}
		
		return $res;
	}

	public function collectTotals() {
		// tomo todos los datos del metodo de envio
		$model = Mage::getModel('reembolso/reembolso')->getShippMethod();
		$res = parent::collectTotals();
		$sum_amount = 0;

		if (!is_null($this->_payments) && $this->getPayment()->hasMethodInstance() && $this->getPayment()->getMethodInstance()->getCode() == 'reembolso') {
			foreach ($res->getAllShippingAddresses() as $address) {
				
				$this->setSubTotalAmount($address->getGrandTotal() - $address->getShippingAmount());
				$sum_amount = $model['total_shipping'];
				
				$address->setShippingAmount($address->getShippingAmount() + $address->getShippingTaxAmount() + $sum_amount);
				$address->setBaseShippingAmount($address->getBaseShippingAmount() + $address->getBaseShippingTaxAmount() + $sum_amount);

				$address->setBaseGrandTotal($address->getBaseGrandTotal() + $sum_amount);
				$address->setGrandTotal($address->getGrandTotal() + $sum_amount);

			}
		}
		return $res;
	}
}