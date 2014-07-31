<?php

class PdfModel extends Model {

    function getPayment($paymentId)
    {
        $query = "
                    SELECT
                                *
                        FROM
                                payments
                        JOIN
                                users
                            ON  
                                payments.user_id = users.id
                        WHERE
                                payments.id = :paymentId
                 ";
        
        return $this->_db->doQueryOne($query, array('paymentId' => $paymentId));
    }

    function getDonePayments($payment)
    {
        $query = "
                    SELECT
                                *
                        FROM
                                payments
                        WHERE
                                payments.name = :paymentName
                        AND
                                payments.paid = 1
                 ";
        
        return $this->_db->doQueryAll($query, array('paymentName' => $payment['name']));
    }

    function getFuturPayments($payment)
    {
        $query = "
                    SELECT
                                *
                        FROM
                                payments
                        WHERE
                                payments.name = :paymentName
                        AND
                                payments.paid = 0
                 ";
        
        return $this->_db->doQueryAll($query, array('paymentName' => $payment['name']));
    }
}
?>