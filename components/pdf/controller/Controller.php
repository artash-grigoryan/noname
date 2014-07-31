<?php

class PdfController  extends Controller  {

    function  __construct( $_option, $_action )
    {
        parent::__construct($_option, $_action);
        $this->_View->setTemplate(PDF_ABS_PATH.'template/');
    }

    function invoice($params = array('paymentId' => 0))
    {
        if(empty($params['paymentId'])) {
            throw new SException('Unknown Invoice', 799);
        }
        
        $this->_View->_payment       = $this->_Model->getPayment($params['paymentId']);
        $this->_View->_donePayments  = $this->_Model->getDonePayments($this->_View->_payment);
        $this->_View->_futurPayments = $this->_Model->getFuturPayments($this->_View->_payment);
            
        if(!self::getVars('view', false)) {
            
            $this->_View->disableView();
            $content = file_get_contents(PATH.'pdf/invoice/?view=1&'.Controller::setHtmlParams(array('paymentId'=>$params['paymentId'])));
            try
            {
                $PDF =  new html2pdf('P', 'A4', 'fr');
                $PDF->pdf->SetDisplayMode('fullpage');
                $PDF->writeHTML($content, false);
                $PDF->Output(ABS_PATH.'template/default/pdf/invoice_'.  Utils::hashStr($params['paymentId']).'.pdf', "F"); 
            }
            catch(HTML2PDF_exception $e) {
                throw new SException($e->getMessage(), $e->getCode());
            }
        }
    }
}
?>