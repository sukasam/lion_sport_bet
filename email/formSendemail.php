<?php
  if (isset($_POST['submit'])) {
header('Access-Control-Allow-Origin: *');

  $subject = $_POST['subject'];
  $strSubject = $_POST['subject'];
  $email = $_POST['email'];
  $strMessage = $_POST['massage'];
  

  $chMail = curl_init();
// $strTo = 'thatsayut.junruangchai@unicity.com';
 $dataFeedPM = "message=".$strMessage."&subject=".$strSubject."&email=".$email;

              
  curl_setopt($chMail, CURLOPT_URL,"http://mkung.unicity-easynet.com/email/mailgun.php");
  curl_setopt($chMail, CURLOPT_POST, 1);
  curl_setopt($chMail, CURLOPT_POSTFIELDS,$dataFeedPM);
  curl_setopt($chMail, CURLOPT_SSL_VERIFYPEER,false);
  curl_setopt($chMail, CURLOPT_SSL_VERIFYHOST,false); 
  curl_setopt($chMail, CURLOPT_RETURNTRANSFER, true);
               
  echo $server_output = curl_exec ($chMail);
                  
  curl_close ($chMail);
  echo "Send already";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" >
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" ></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" ></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" ></script> -->
  <title>Resend Email</title>
</head>
<body>
  <div class="container"><br>
    <h1 class="text-center">Send Email</h1>
    <form name="form1" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" style="max-width: 500px;margin: auto;text-align: center;">
  <div class="form-group">
    <label style="float: left;">Order ID</label>
    <input type="text" class="form-control" name="subject" placeholder="subject">
    <input type="text" class="form-control" name="email" placeholder="email">
  </div>
  <div class="form-group">
  <textarea class="form-control" rows="3" name="massage"></textarea>
    </div>
  <button name="submit" type="submit" class="btn btn-primary text-center">Submit</button>
  <input type="hidden" name="<?php echo $token_id; ?>" value="<?php echo $token_value; ?>"/>
  </form>
  </div>


</body>

</html>

