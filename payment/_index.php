<h2>Test Payment</h2>
<form action="https://perfectmoney.is/acct/ev_activate.asp" method="POST">
<input type="hidden" name="AccountID" value="1762128">
<input type="hidden" name="PassPhrase" value="Mkung160230">
<input type="hidden" name="Payee_Account" value="U17828646">
e-Voucher : <input type="text" name="ev_number" value=""> <BR>
Activation code : <input type="text" name="ev_code" value=""><BR><BR>
<input type="submit" name="PAYMENT_METHOD" value="Pay Now!">
<input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
</form>
