<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Creovector_LegalPaymentMethod_Block_Receip extends Mage_Core_Block_Template {

    var $company;

    protected function _construct() {
        parent::_construct();
        
        $this->order = Mage::getModel("sales/order")->load(Mage::getSingleton('checkout/session')->getLastOrderId());
        $this->setTemplate('crvpayment/legal/receip.phtml');
        
        $this->company = Mage::getModel("crvlegalpayment/order")->getByOrderId($this->order->getId())->getFirstItem();
    }

    public function getCustomerCompany($field) {
        return $this->company->getData($field);
    }

    public function getAddress() {
        $address = $this->order->getShippingAddress()->getData();
        return $address["postcode"] . ", " . $address["city"] . ", " . $address["street"];
    }

    public function getCustomerName() {
        $customer = ($this->order->getCustomerId() > 0) ? Mage::getModel('customer/customer')->load($this->order->getCustomerId()) : $this->order->getBillingAddress();
        return $customer->getName();
    }

    public function getOrderIncrementId() {
        return $this->order->getIncrementId();
    }
    
    public function getId() {
        return $this->order->getId();
    }

    public function getOrderTotal($format = true) {
        return ($format) ? Mage::helper('core')->currency($this->order->getGrandTotal()) : $this->order->getGrandTotal();
    }

    public function getStoreName() {
        return Mage::getStoreConfig("general/store_information/name", Mage::app()->getStore());
    }

    public function getStorePhone() {
        return Mage::getStoreConfig("general/store_information/phone", Mage::app()->getStore());
    }

    public function getStoreEmail() {
        return Mage::getStoreConfig("trans_email/ident_general/email", Mage::app()->getStore());
    }

    public function getBankAccount($param) {
        return Mage::getStoreConfig("general/bankaccount/$param", Mage::app()->getStore());
    }

}
