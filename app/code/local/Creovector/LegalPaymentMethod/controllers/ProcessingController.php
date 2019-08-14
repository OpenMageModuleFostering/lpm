<?php

class Creovector_LegalPaymentMethod_ProcessingController extends Mage_Core_Controller_Front_Action {

    public function payAction() {
        $receip = $this->getLayout()->createBlock('crvlegalpayment/receip');
        $filename = Mage::getBaseDir("var") . DS . "legal" . DS . $receip->getOrderIncrementId() . ".pdf";
        Mage::helper("crvlegalpayment")->createPdf($receip->toHtml(), $filename);
        $this->_redirect("checkout/onepage/success"); 
    }

    function downloadAction() {
        $order = Mage::getModel("sales/order")->load(Mage::getSingleton('checkout/session')->getLastOrderId());
        $filename = Mage::getBaseDir("var") . DS . "legal" . DS . $order->getIncrementId() . ".pdf";
        if (file_exists($filename)) {
            if (ob_get_level()) {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            // читаем файл и отправляем его пользователю
            readfile($filename);
            exit;
        }
    }

    protected function _redirect($path, $arguments = array()) {
        $block = $this->getLayout()->createBlock('core/template')->setTemplate('crvpayment/redirect.phtml');
        Mage::getSingleton('core/session')->setRedirectUrl(Mage::getUrl($path, $arguments)); // In the Controller
        $this->getResponse()->setBody($block->toHtml());
    }

}

?>
