<?php
      error_reporting(0);
      
      $url = "http://".$_SERVER['SERVER_NAME'].":8087/lionroyalapi";  // put your API path here
      $pw = ";(ejB_E39sd^q#x";                  // put your API password here

      $passwordCallback = ";(ejB_E39sd^q#x";  // put your callback password here

      define('DOMAIN_SITE','http://'.$_SERVER['SERVER_NAME']);
      define('API_SITE',DOMAIN_SITE.'/statics/api.php');

      define('SCRIPT_AUTO_SITE','http://localhost/site/statics/api.php');
      // define('FromEmail','info@codewithmark.com');

      define('KEY_HASH','Lion Royal');
      define('LIMIT_WORD','100');

      date_default_timezone_set("Asia/Tehran");

      /*define('PERFECT_ACCOUNTID','1762128');
      define('PERFECT_PASSPHRASE','Mkung160230');
      define('PERFECT_PAYEE_ACCOUNT','U17828646');*/

      define('PERFECT_ACCOUNTID','4785243');
      define('PERFECT_PASSPHRASE','tira1365');
      define('PERFECT_PAYEE_ACCOUNT','U18118429');

      define('PIN_KALASHOPPY','28AADA2519E5AC63322E');
      define('PIN_MIHANKHARID24','69CB2AECFD570A548047');
      define('PIN_NOVINSHOP','769E29553BD2F533E1A5');
      define('PIN_IRANSHOPPING','67CE4EB2650720147C45');
      define('APIKEY_RENTHOSTING','54347605ca5cdc679a1d0f9031f9e5b2');
      
      //define('APIKEY_EASYPAY90','e7e83d37575db482a04f1c869246fd6e');
      define('APIKEY_EASYPAY90','f440673f85fab9ef5798d1bd6433f004');
      define('APIKEY_NOVINSHOOP','3bfa6efbcccba7298f6cb13e08e31414');
      

      define('APIKEY_CARD_USER','564882019548342199');
      define('APIKEY_CARD_PASS','561197609776593267');
      define('IP_CARDTOCARD','http://85.10.195.47:12001');

      define('D2_APIKEY_CARD_USER','ApR0L85TKy6tnboxzw9S');
      define('D2_APIKEY_CARD_PASS','D(1xg%@MYXamDh*aS@Gk');
      define('D2_IP_CARDTOCARD','http://185.150.116.66');

?>