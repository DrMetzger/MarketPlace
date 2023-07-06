<?php
if(session_id() == '') {
	session_start();
	}
?>
<HTML>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title>Market Place</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        toastr.options = {
            positionClass: 'toast-top-full-width',
            progressBar: true,
            timeOut: 6000,
            extendedTimeOut: 1000
        };
    </script>
  </head>

<link rel="stylesheet" href="css/style.css">
<body style="background-color: #eee;">
<script src="js/bootstrap.bundle.min.js"></script>
<section class=" gradient-form" style="background-color: #eee;">
  <div class="container py-5 ">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="img/cropped-logo-horizontal-principal-220x73.png"
                    style="width: 185px;" alt="logo">
                </div>

                <form method="post" action="action/api.php">
                <br>
                  <p>Please login to access the system.</p>

                  <div class="form-outline mb-4">
                  <input type="hidden" name="login">
                    <input name="username" type="text" id="form2Example11" class="form-control" placeholder="" />
                    <label class="form-label" for="form2Example11">User</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input name="password" type="password" id="form2Example22" class="form-control" />
                    <label class="form-label" for="form2Example22">Password</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Access</button>
                  </div>


</form>

<?php
        if(isset($_SESSION["message"])):
          $message = $_SESSION["message"];
          $message = $message['message'];
          echo "<script>toastr.success('$message');</script>";
          unset($_SESSION["message"]);
        endif; 
  ?>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Market Place Inovation of Services".</h4>
                <p class="small mb-0">A market system is a complex economic framework that facilitates the exchange of goods, </p>
                <p class="small mb-0">services, and resources between buyers and sellers. It is characterized by private ownership, </p>
                <p class="small mb-0">voluntary transactions, competition, and the interaction of supply and demand. </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</HTML>