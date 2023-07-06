<?php
require __DIR__ . '/../vendor/autoload.php';

include("connectdb.php");

if(session_id() == '') {
	session_start();
	}

use Firebase\JWT\JWT;

// Set your secret key (keep it secure)
$secretKey = "yD7rthX95Wz4q6ZS";

// Register User Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Validate input data
    // Add your validation code here

    // // Connect to SQL Server
    // $conn = sqlsrv_connect($serverName, $connectionOptions);
    // if ($conn === false) {
    //     die(print_r(sqlsrv_errors(), true));
    // }

    // Check if username or email already exist
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $params = array($username, $email);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_has_rows($stmt)) {
        // Username or email already taken
        $response = array('success' => false, 'message' => 'Username or email already taken');
    } else {
        // Insert new user record
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $params = array($username, $password, $email);
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $response = array('success' => true, 'message' => 'Registration successful');
    }

    // Close connection
    sqlsrv_close($conn);

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// Login User Endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate input data
    // Add your validation code here

    // // Connect to SQL Server
    // $conn = sqlsrv_connect($serverName, $connectionOptions);
    // if ($conn === false) {
    //     die(print_r(sqlsrv_errors(), true));
    // }

    // Check if username exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $params = array($username);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_has_rows($stmt)) {
        // User exists, check password
        $user = sqlsrv_fetch_array($stmt);
        if ($password === $user['pass']) {
            // Password is correct, generate JWT token
            $payload = array(
                "user_id" => $user['id'],
                "username" => $user['username'],
                "email" => $user['email']
            );

            // Set the token expiration time (optional)
            $expirationTime = time() + 3600; // Token expires in 1 hour

            // Create the JWT token
            $token = JWT::encode($payload, $secretKey, 'HS256');

            $response = array(
                'success' => true,
                'message' => 'Login successful',
                'token' => $token
            );
        } else {
            // Invalid password
            $response = array('success' => false, 'message' => 'Invalid password');
        }
    } else {
        // User does not exist
        $response = array('success' => false, 'message' => 'User does not exist');
    }

    // Close connection
    sqlsrv_close($conn);

    // Return JSON response
    //header('Content-Type: application/json');
    //echo json_encode($response);
    if ($response['success'] === true){
        $_SESSION['loginmaster'] = $response;
        header('location:../portal.php');
    } else{
        $_SESSION['message'] = $response;
        header('location:../index.php');
    }
}

//locate an execute method INSERT/ALTER/DELETE 

$columns    = $_POST['column'];
$page       = $_POST['page'];
$table      = $_POST['page'];
$tab        = $columns;
$type       = $_POST['type'];

//Tax calculation based on the rates registered for each type of product
$calculate  = $_POST['calculate'];
$productid  = $_POST['productid'];

if ($calculate === 'calculatetax'){
    
    $sql = "SELECT * FROM products prod inner join taxes tax on tax.typeofproduct = prod.type WHERE prod.description = '$productid'";
    $stmt = sqlsrv_query($conn, $sql);
  
    if ($stmt === false) {
      die(print_r(sqlsrv_errors(), true));
    }
  
    $tax = 0;
    if (sqlsrv_has_rows($stmt)) {
      $row = sqlsrv_fetch_array($stmt);
      $tax = $row['value'];
      $tax = number_format($tax, 2, '.', '');
    }
  
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
  
    //return $tax;
    $response = array('tax' => $tax);
    header("Content-Type: application/json");
    echo json_encode($response);
}






if ($type === 'insert') {

    foreach ($tab as $key => $value) {
    $fields[]  = $key;
    $content[] = $tab[$key];
    }  
        foreach ($content as $kevin => $tenant) {
                $headquarters   = $content[$kevin];
                If (preg_match('/\[(.*?)\]/', $headquarters, $crop)){
                    $end .= EMPTY($end) ? " '".$crop[1]."' " : ", '".$crop[1]."' " ;
                }Else{
                    $end .= EMPTY($end) ? " '".$headquarters."' " : ", '".$headquarters."' ";
                }
                }

    $fields = implode(",", $fields);

    $sql = "INSERT INTO $table ($fields) VALUES($end)";
    
    if ($row_cntb = sqlsrv_query($conn, $sql)) {
        $row_cntb = sqlsrv_rows_affected($row_cntb);
        if ($row_cntb > 0) {
            $response = array('success' => True, 'message' => 'Record created successfully!!!');
            $_SESSION['message'] = $response;
            header("location: ../$page.php");
        } else { 
            $response = array('success' => False, 'message' => 'Record already exists, will not be recorded again');
            $_SESSION['message'] = $response;
            header("location: ../$page.php");
        }
    } else {
        $response = array('success' => False, 'message' => "Error Creating Record: " . utf8_encode(htmlspecialchars(sqlsrv_errors(SQLSRV_ERR_ALL)[0][2])));
        $_SESSION['message'] = $response;
        header("location: ../$page.php");
    }

    sqlsrv_close($conn);
}

If ($type === 'edit'){

    $id = $_POST['id'];

    foreach ($tab as $key => $value) {
    $content  .= $key;
    If (preg_match('/\[(.*?)\]/', $tab[$key], $crop)){
        $content .= EMPTY($content) ? " '".$crop[1]."' " : "='".$crop[1]."', " ;
    }Else{
        $content .= EMPTY($content) ? " '".$tab[$key]."' " : "= '".$tab[$key]."', ";
    }
  }  

$content = substr($content, 0, -2);

$sql = "UPDATE $table SET $content WHERE id = $id";


if ($row_cntb = sqlsrv_query($conn, $sql)) {
    $row_cntb = sqlsrv_rows_affected($row_cntb);
    if ($row_cntb > 0) {
        $response = array('success' => True, 'message' => 'Record alterated successfully!!!');
        $_SESSION['message'] = $response;
        header("location: ../$page.php");
    } else {
        $response = array('success' => False, 'message' => 'No fields were changed, so nothing done!');
        $_SESSION['message'] = $response;
        header("location: ../$page.php");
    }
} else {
    $response = array('success' => False, 'message' => "Error when changing record: " . utf8_encode(htmlspecialchars(sqlsrv_errors(SQLSRV_ERR_ALL)[0][2])));
    $_SESSION['message'] = $response;
    header("location: ../$page.php");
}
sqlsrv_close($conn);
}

If ($type === 'delete'){

    $id = $_POST['id'];

    $sql = "DELETE FROM $table WHERE id = $id";

if ($row_cntb = sqlsrv_query($conn, $sql)) {
    $row_cntb = sqlsrv_rows_affected($row_cntb);
    if ($row_cntb > 0) {
        $response = array('success' => True, 'message' => 'Record deleted successfully!!!');
        $_SESSION['message'] = $response;
        header("location: ../$page.php");
    } else {
        $response = array('success' => False, 'message' => 'No delete record, so nothing done!');
        $_SESSION['message'] = $response;
        header("location: ../$page.php");
    }
} else {
    $response = array('success' => False, 'message' => "Error when deleting record: " . utf8_encode(htmlspecialchars(sqlsrv_errors(SQLSRV_ERR_ALL)[0][2])));
    $_SESSION['message'] = $response;
    header("location: ../$page.php");
}
sqlsrv_close($conn);
}
?>