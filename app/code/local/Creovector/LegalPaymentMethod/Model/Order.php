<?php

class Creovector_LegalPaymentMethod_Model_Order extends Mage_Core_Model_Abstract {

    protected function _construct() {
        $this->_init("crvlegalpayment/order");
    }

    public function isOrderExists($id) {
        $collection = $this->getByOrderId($id);
        return ($collection->getSize() > 0);
        
    }
    
    public function getByOrderId($id) {
        return $this->getCollection()->addFieldToFilter("order_id", array("eq" => $id));
    }

    public function create($params) {
        if ($this->getByOrderId($params["order"])->getSize() == 0) {
            $this->setData($params);
            $this->save();
        }
    }

}
