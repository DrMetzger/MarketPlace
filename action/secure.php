
<?php
if(session_id() == '') {
	session_start();
	}

require __DIR__ . '/../vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if($_SESSION['loginmaster']['token'] <> null){
  $token = $_SESSION['loginmaster']['token'];

  // Set your secret key (keep it secure)
  $secretKey = "yD7rthX95Wz4q6ZS";

  try {
    // Check token validity
    //$decoded = JWT::decode($token, $secretKey);
    $decoded = JWT::decode($token, new Key($secretKey, 'HS256'));
    // The token is valid

    // You can access the decoded token data if needed
    //$userId = $decoded->user_id;
    $_SESSION['name'] = $decoded->username;

  } catch (Exception $e) {
    // The token is invalid
    unset($_SESSION['loginmaster']);
    header('location:../index.php');
    exit();
  }
}else{
   // The token is invalid
   unset($_SESSION['loginmaster']);
   header('location:../index.php');
   $_SESSION['message'] = array('success' => false, 'message' => 'you cannot do this, please login correctly');
   exit();
}

?>