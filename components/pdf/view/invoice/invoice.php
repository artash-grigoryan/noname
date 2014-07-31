
<table style="margin: 50px 120px;">
    <tr>
        <td style="width: 400px">
            <h1 style="font-size: 16px;"><?=((!empty($this->_payment['monthly_payment'])) && ($this->_payment['monthly_payment_number'] != $this->_payment['monthly_payment']))?'Reçu pour acompte sur facture<br/>':'Facture'?> n° <?=$this->_payment['invoice']?></h1>
        </td>
        <td>
            <p style="font-size: 12px;">Date : <?=date('d-m-Y')?></p>
        </td>
    </tr>
</table>

<table style="margin: 0 0 0 50px;">
    <tr>
        <td style="width: 200px;padding-top: 30px;">
            <h3 style="color: #898989;font-size: 10px;line-height: 11px;margin: 0;padding: 0;">À</h3>
            <h3 style="margin: 0;padding: 0;color: #646464;font-size: 14px;line-height: 16px;"><?=$this->_payment['first_name']?> <?=$this->_payment['last_name']?></h3>
            <p style="margin: 14px 0 0;padding: 0;color: #646464;font-size: 12px;line-height: 14px;padding-right:50px;"><?=$this->_payment['street']?>,</p>
            <p style="margin: 0;padding: 0;color: #646464;font-size: 12px;line-height: 14px;padding-right:50px;"><?=$this->_payment['zip']?>, <?=$this->_payment['city']?></p>
            <p style="margin: 0;padding: 0;color: #646464;font-size: 12px;line-height: 14px;padding-right:50px;"><?=$this->_payment['country']?></p>
        </td>
        <td>
            <table style="margin: 30px 20px;border-collapse: collapse;">
                <thead>
                    <tr style="background: none repeat scroll 0 0 #F1F1F1;">
                        <th style="width: 160px;text-align: left;border-bottom: 1px solid #DDDDDD;padding: 10px;">Description</th>
                        <th style="width: 20px;text-align: left;border-bottom: 1px solid #DDDDDD;padding: 10px;text-align: center;">Qté</th>
                        <th style="width: 70px;text-align: left;border-bottom: 1px solid #DDDDDD;padding: 10px;text-align: center;">Prix à l'unité</th>
                        <th style="width: 50px;text-align: left;border-bottom: 1px solid #DDDDDD;padding: 10px;text-align: center;">Coût</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-top: 1px solid #DDDDDD;">
                        <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;"><?=$this->_payment['name']?></td>
                        <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;text-align: center;">1</td>
                        <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;text-align: center;"><?=$this->_payment['total_amount']?> €</td>
                        <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;text-align: center;"><?=$this->_payment['total_amount']?> €</td>
                    </tr>
                    <? if(!empty($this->_payment['discount'])) : ?>
                        <tr style="border-top: 1px solid #DDDDDD;">
                            <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;">Réduction</td>
                            <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;"></td>
                            <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;"></td>
                            <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;text-align: center;"><?=$this->_payment['discount']?> €</td>
                        </tr>
                    <? endif; ?>
                    <? /*
                    <tr style="border-top: 1px solid #DDDDDD;">
                        <td colspan="3" style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px 30px;text-align: right;">Sous-total</td>
                        <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;text-align: center;"><?=($this->_payment['total_amount']-$this->_payment['discount'])?> €</td>
                    </tr>
                    */?>
                    <tr style="background: none repeat scroll 0 0 #F1F1F1;border-top: 1px solid #DDDDDD;">
                        <td colspan="3" style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px 30px;text-align: right;font-weight: bold;">Total TTC</td>
                        <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;text-align: center;font-weight: bold;"><?=($this->_payment['total_amount']-$this->_payment['discount'])?> €</td>
                    </tr>
                    <tr style="border-top: 1px solid #DDDDDD;">
                        <td colspan="4" style="font-size: 10px;padding: 10px;text-align: right;">TVA non applicable, conformément à l’article 293B du C.G.I</td>
                        <td style="font-size: 12px;border-bottom: 1px solid #DDDDDD;padding: 10px;"></td>
                    </tr>
                    <? if(!empty($this->_payment['monthly_payment'])): ?>
                        <tr style="">
                            <td colspan="4" style="font-size: 12px;padding: 30px 0 0;font-weight: bold;">Cette facture est réglée en <?=$this->_payment['monthly_payment']?> mensualité(s) :</td>
                        </tr>
                    <? else : ?>
                        <tr style="">
                            <td colspan="4" style="font-size: 12px;padding: 10px 0;font-weight: bold;">Cette facture est réglée :</td>
                        </tr>
                    <? endif; ?>
                    <? foreach ($this->_donePayments as $payment) : ?>
                        <tr style="">
                            <td colspan="4" style="font-size: 12px;padding: 10px;">- <?=$payment['amount']?> € &nbsp;le <?=date('d-m-Y', strtotime($payment['payment_date']))?> ( <?=$payment['mode']?> <?=(strtolower($payment['mode']) == 'chèque')?'n° '.$payment['cheque']:''?>)</td>
                        </tr>
                    <? endforeach; ?>
                    <? if(!empty($this->_futurPayments)): ?>
                        <tr style="">
                            <td colspan="4" style="font-size: 12px;padding: 10px 0;font-weight: bold;">Réglements à venir :</td>
                        </tr>
                        <? foreach ($this->_futurPayments as $payment) : ?>
                            <tr style="">
                                <td colspan="4" style="font-size: 12px;padding: 10px;">- <?=$payment['amount']?> € &nbsp;le <?=date('d-m-Y', strtotime($payment['date']))?></td>
                            </tr>
                        <? endforeach; ?>
                    <? endif; ?>
                    
                </tbody>
            </table>
        </td>
    </tr>
</table>
