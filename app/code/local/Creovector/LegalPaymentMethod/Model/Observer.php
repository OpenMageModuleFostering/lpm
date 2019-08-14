<?php

class Creovector_LegalPaymentMethod_Model_Observer {

    public function salesOrderSaveAfter($observer) {

        if (Mage::getModel("crvlegalpayment/order")->isOrderExists($observer->getEvent()->getOrder()->getId()))
            return false;
        $order = Mage::getModel("sales/order")->load($observer->getEvent()->getOrder()->getId());

        $info = Mage::app()->getRequest()->getParam("payment");

        $params = array("order_id" => $observer->getEvent()->getOrder()->getId(), "company" => $order->getBillingAddress()->getData("company"));
        foreach (array("tax", "classifier", "bankname", "banknumber", "bankaccount", "bankсorresponding") as $param)
            $params[$param] = $info["legal_" . $param];

        $legal = Mage::getModel("crvlegalpayment/order");
        $legal->create($params);
    }

}
