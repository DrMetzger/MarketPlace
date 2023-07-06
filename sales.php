<?php
if(session_id() == '') {
	session_start();
	}
  include("action/secure.php");
  include("action/connectdb.php");

?>
<HTML>  

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MarketPlace - Sales</title>
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
  <script src="https://unpkg.com/exceljs/dist/exceljs.min.js"></script>

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


  <style>
    .select2 {
width:100%!important;
}
    </style>

<script>
        function openModal(modalId, recordId, mode, page) {
    var modal = $('#' + modalId);

    $.ajax({
        url: 'modal/get_modal.php',
        type: 'GET',
        data: { id: recordId, mode: mode, page: page },
        success: function(response) {
            modal.html(response);
            modal.modal('show');
        },
        error: function() {
            alert('Erro ao carregar o conteúdo do modal.');
        }
    });
}
    </script>

<link rel="stylesheet" href="css/style.css">

<?php
include("navbar/navbar.php");
//include("style/body.php");
?>
<script>
$(document).ready(function(){
  // Function to apply filter to the table
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

  // Function to export filtered rows to Excel
  $("#exportButton").on("click", function() {
    exportFilteredRowsToExcel();
  });
});

function exportFilteredRowsToExcel() {
  // Get the dynamic table as a DOM object
  let table = document.getElementById('dynamic-table');

  // Get visible rows after filtering
  let filteredRows = Array.from(table.getElementsByTagName('tr')).filter(function(row) {
    return row.style.display !== 'none';
  });

  // Create a new Excel workbook
  let workbook = new ExcelJS.Workbook();
  let worksheet = workbook.addWorksheet('Taxes Table');

  // Get header columns of the table
  let headerColumns = table.getElementsByTagName('th');

  // Add column headers to the Excel worksheet
  let headerData = [];
  for (let i = 0; i < headerColumns.length; i++) {
    // Check if the current column should be excluded
    if (!headerColumns[i].classList.contains('exclude-column')) {
      headerData.push(headerColumns[i].textContent);
    }
  }
  worksheet.addRow(headerData);

  // Iterate through the filtered rows of the dynamic table and add the data to the Excel worksheet
  for (let i = 0; i < filteredRows.length; i++) {
    let row = filteredRows[i];
    let rowData = [];

    // Iterate through the cells of the current row and add the values to the rowData array
    let cells = row.getElementsByTagName('td');
    for (let j = 0; j < cells.length; j++) {
      // Check if the current column should be excluded
      if (!cells[j].classList.contains('exclude-column')) {
        rowData.push(cells[j].textContent);
      }
    }

    // Add the row to the Excel worksheet
    worksheet.addRow(rowData);
  }

  // Generate the Excel file
  workbook.xlsx.writeBuffer().then(function(buffer) {
    // Create a Blob object with the Excel file data
    let blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

    // Create a download link for the Excel file
    let link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    var currentDate = new Date();
    var day = String(currentDate.getDate()).padStart(2, '0');
    var month = String(currentDate.getMonth() + 1).padStart(2, '0');
    var year = currentDate.getFullYear();
    var hour = String(currentDate.getHours()).padStart(2, '0');
    var minute = String(currentDate.getMinutes()).padStart(2, '0');
    var currentDateTime = day + '-' + month + '-' + year + '_' + hour + '-' + minute;

    // Get the value of the "name" session variable on the client side (JavaScript)
    var name = "<?php echo $_SESSION['name']; ?>";

    link.download = 'taxes_table_' + name + '_' + currentDateTime + '.xlsx';

    // Simulate a click on the link to initiate the download
    link.click();
  });
}
</script>

<div class="container">

<!-- Page Heading -->
<div>
<h1>Records</h1>
</div>
<hr class="solid">
<button class="btn btn-success" data-toggle="modal" onclick="openModal('modal_insert','', 'insert','sales')">
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-receipt-cutoff" viewBox="0 0 16 16">
  <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zM11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
  <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293 2.354.646zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118l.137-.274z"/>
</svg> New Sale
</button>

<button type="button" class="btn btn-info" id="exportButton">
<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-table" viewBox="0 0 16 16">
  <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
</svg> Export to Excel
</button>
<hr class="solid">

<div class='modal fade bd-example-modal-xl' id='modal_insert' role='dialog' aria-labelledby='modal_insert_label' aria-hidden='true'></div>

<?php
        if(isset($_SESSION["message"])):
          $message = $_SESSION["message"];
          $message = $message['message'];
          echo "<script>toastr.success('$message');</script>";
          unset($_SESSION["message"]);
        endif; 
  ?>

<br>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
<h1>Sales Listing</h1>
</div>

<input class="form-control" id="myInput" type="text" placeholder="Find..">
 

  <table id="dynamic-table" class="table table-responsive">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Product</th>
      <th scope="col">Amount</th>
      <th scope="col">Price Unit</th>
      <th scope="col">Total Price</th>
      <th scope="col">Taxes</th>
      <th scope="col">Total With Taxes</th>
      <th scope="col" class="exclude-column">Action</th>
      <th scope="col" class="exclude-column"></th>
      <th scope="col" class="exclude-column"></th>
    </tr>
  </thead>
  <tbody id="myTable">

<br>
<?php

$sql = "SELECT * FROM sales";
$result = sqlsrv_query($conn, $sql);

if (sqlsrv_has_rows($result)) {
    // Output data of each row
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
    $xcod = $row["id"];
    $xproduct = $row["product"];
    $xamount = $row["amount"];
    $xpriceunit = $row["priceunit"];
    $xtotalprice = $row["totalprice"];
    $xtaxes = $row["taxes"];
    $xtotalpricetaxes = $row["totalpricetaxes"];
    echo "<tr'>";
    echo "<td>".$xcod."</td>";
    echo "<td>".$xproduct."</td>";
    echo "<td>".number_format($xamount, 2, '.', '')."</td>";
    echo "<td>".number_format($xpriceunit, 2, '.', '')."</td>";
    echo "<td>".number_format($xtotalprice, 2, '.', '')."</td>";
    echo "<td>".number_format($xtaxes, 2, '.', '')."</td>";
    echo "<td>".number_format($xtotalpricetaxes, 2, '.', '')."</td>";
    echo "<td class='exclude-column'>";
    echo "<button class='btn btn-warning btn-sm' data-toggle='modal' onclick='openModal(\"modal_edit\",".$xcod.", \"edit\", \"sales\")'>";
    echo "Edit";
    echo "</button>";
    echo "</td>";
    echo "<td class='exclude-column'>";
    echo "<button class='btn btn-primary btn-sm' data-toggle='modal' onclick='openModal(\"modal_view\", ".$xcod.", \"view\", \"sales\")'>";
    echo "View";
    echo "</button>";
    echo "</td>";
    echo "<td class='exclude-column'>";
    echo "<button class='btn btn-danger btn-sm' data-toggle='modal' onclick='openModal(\"modal_delete\", ".$xcod.", \"delete\", \"sales\")'>";
    echo "Delete";
    echo "</button>";
    echo "</td>";
    echo "</tr>";
  }
} 

sqlsrv_free_stmt($result);

    echo "
    <div class='modal fade bd-example-modal-xl' id='modal_edit' role='dialog' aria-labelledby='modal_edit_label' aria-hidden='true'></div>
    <div class='modal fade bd-example-modal-xl' id='modal_view' role='dialog' aria-labelledby='modal_view_label' aria-hidden='true'></div>
    <div class='modal fade bd-example-modal-xl' id='modal_delete' role='dialog' aria-labelledby='modal_delete_label' aria-hidden='true'></div>";

  ?>

</tbody>
</table> 

<br>
<br>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <script src="js/sb-admin-2.min.js"></script>

<script src="js/main.js"></script>
</div>

<?php
include("navbar/footer.php");
?>