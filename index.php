<?php

include "src/servers.php";
include "src/lib.php";

$domain = $_GET['domain'];
$message = "";
$result = "";

if( !empty($domain) ) {
  $domain = trim($domain);
  if(substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
  if(substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
  if(ValidateDomain($domain)) {
    $result = LookupDomain($domain);
  }	else {
    $result = "Invalid Input!";
  }

  if($result === "Invalid Input!") {
    $message = "<span class='error'>Invalid Input Domain!<span>";
    $result = "";
  }
  elseif($result === "Server Error!") {
    $message = "<span class='error'>Error: No appropriate Whois server found for <i>$domain</i> domain!<span>";
    $result = "";
  }
  elseif($result === "Available") {
    $message = "<span class='available'>The domain <i><u>$domain</u></i> is available!</span>";
    $result = "";
  }
  else {
    $message = "Whois information for <i><u>$domain</u></i>: ";
  }
}

?>


<html>
  <head>
    <title>WHOIS Lookup</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>

  <body>
    <div class="container">

        <h2>Welcome to check domain names availability</h2>
        <form action="<?=$_SERVER['PHP_SELF'];?>">
          <div class="chack-domain">
            <input type="text" class="form-control input-sm" placeholder="Type a domain" name="domain" id="domain" value="<?php echo $domain; ?>">
            <input type="submit" class="btn btn-primary btn-sm" value="Checking availability">
          </div>
        </form>

        <h3><?php echo $message ?></h3>
        <div id="result"><?php echo $result ?></div>

    </div>




  </body>
</html>
