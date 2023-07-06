<?php
if(session_id() == '') {
	session_start();
	}
  include("action/secure.php");

?>
<HTML>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portal MarketPlace</title>
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

   <!--Reposítorio do JQUERY para funcionar colocar sempre em primeiro antes de qualquer funcao que o USA--> 
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <!--===================================================================================================-->


  <link href="select2-4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script type="text/javascript" src="select2-4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>


  </head>

<link rel="stylesheet" href="css/style.css">

<?php
include("navbar/navbar.php");
include("style/body.php");
?>

<div class="container">

<br>
    <center><h1>Welcome <?php echo $_SESSION['name'] ?></h1></center>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

<script src="js/main.js"></script>


<?php
include("navbar/footer.php");
?>
</div>