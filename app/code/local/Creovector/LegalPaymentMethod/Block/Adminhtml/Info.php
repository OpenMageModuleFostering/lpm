<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author kryuch
 */
class Creovector_LegalPaymentMethod_Block_Adminhtml_Info
    extends Mage_Adminhtml_Block_Sales_Order_View_Tab_Info
{
   
    public function getPaymentHtml()
    {
        return "<b>".$this->getChildHtml('order_payment')."</b>".$this->__getComment();
    }


    function __getComment() {
        $order = $this->getOrder();
        if ("crvlegalpayment" != $order->getPayment()->getMethodInstance()->getCode()) return ;
        
        $info = Mage::getModel("crvlegalpayment/order")->getByOrderId($order->getId())->getFirstItem();
        $content = "<br> ".Mage::helper("crvlegalpayment")->__("Individual Taxpayer Number");
        $content .= " / ".Mage::helper("crvlegalpayment")->__("Industrial Enterprises Classifier");
        $content .= " : <i>".$info->getData("tax")." / ".$info->getData("classifier").'</i>';
        $content .= "<br> ".Mage::helper("crvlegalpayment")->__("Current (checking) account");
        $content .= " : <i>".$info->getData("bankaccount")."</i>";
        $content .= "<br><i>".$info->getData("bankname")."</i>, ";
        $content .= Mage::helper("crvlegalpayment")->__("Bank Identification Code")." <i>".$info->getData("banknumber")."</i>";
        $content .= "<br> ".Mage::helper("crvlegalpayment")->__("Correspondent account");
        $content .= " : <i>".$info->getData("bankсorresponding")."</i>";
        return $content;
    }
}
