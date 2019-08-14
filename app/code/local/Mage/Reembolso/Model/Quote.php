<?php
class Mage_Reembolso_Model_Quote extends Mage_Sales_Model_Quote {

	public function getAmount() {
		$totals	=	parent::getTotals();
		$subtotal	= $this->getSubTotalAmount();				//tomo el valor de la compra....
		//$totals['subtotal']->getData('value');		
		$valores = Mage::getModel('reembolso/reembolso');
		$val = $valores->getValorTope();							//tomo el valor tope contra el cual comparar...
		if($subtotal < $val){ 										
			if($valores->getValInfFix() == '1'){				//si el valor inferior es fijo.....
				$amount	= $valores->getValorInferior();
			}else{													//si el velor inferior es porcentaje....
				$amount = ($subtotal * $valores->getValorInferior())/ 100;
			}
		} else {
			if($valores->getValSupFix() == '1'){
				$amount	= $valores->getValorSuperior();
			}else{
				$amount = ($subtotal * $valores->getValorSuperior())/100;
			}
		}
		return $amount;
	}


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
		$res = parent::collectTotals();
		$sum_amount = 0;

		if (!is_null($this->_payments) && $this->getPayment()->hasMethodInstance() && $this->getPayment()->getMethodInstance()->getCode() == 'reembolso') {
			foreach ($res->getAllShippingAddresses() as $address) {
				
				$this->setSubTotalAmount($address->getGrandTotal() - $address->getShippingAmount());
				$sum_amount	=	$this->getAmount();

				$address->setShippingAmount($address->getShippingAmount() + $address->getShippingTaxAmount() + $sum_amount);
				$address->setBaseShippingAmount($address->getBaseShippingAmount() + $address->getBaseShippingTaxAmount() + $sum_amount);

				$address->setBaseGrandTotal($address->getBaseGrandTotal() + $sum_amount);
				$address->setGrandTotal($address->getGrandTotal() + $sum_amount);

			}
		}
		return $res;
	}
}