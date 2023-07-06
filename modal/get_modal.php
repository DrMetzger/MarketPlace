<?php
  include("../action/secure.php");
  include("../action/connectdb.php");
?>

<script>
$(document).ready(function() {
    $('.js-select2').select2();
    element.style.width = null;   
});
</script>

<script>
    var camposInput = document.querySelectorAll(".form-control");    
    camposInput.forEach(function(input) {
      input.addEventListener("keydown", function(event) {
        if (event.keyCode === 13) {
          event.preventDefault();
        }
      });
    });
</script>

<?php

$modalmode  = $_GET['mode'];
$page       = $_GET['page'];

if ($page === 'products'){
$sql1 = "SELECT MAX(id) AS id FROM products";
$result1 = sqlsrv_query($conn, $sql1);
$row1 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
$codigo1 = ($row1["id"] + 1);
sqlsrv_free_stmt($result1);

$msql = "SELECT * FROM products WHERE id = '".$_GET['id']."'";
$mresult = sqlsrv_query($conn, $msql);

if (sqlsrv_has_rows($mresult)) {
// Output data of each row
while ($row = sqlsrv_fetch_array($mresult, SQLSRV_FETCH_ASSOC)) {
    $xid            = $row["id"];
    $xdescription	= $row["description"];
    $xtypeprod	        = $row["type"];
    $xtaxes         = $row["taxes"];
  }
} 
sqlsrv_free_stmt($mresult);

    echo "
    <div class='modal-dialog modal-xl'>
    <div class='modal-content'>
    <div class='modal-body'>
    <form method='POST' action='action/api.php'>
    <input hidden type='text' name='id'  value='$xid'>
    <div class='tab-content' id='xmyTabContent'>
    <div class='tab-pane fade show active' id='xtab-".$modalmode."1' role='tabpanel' aria-labelledby='xtab1".$modalmode."'>
    <div class='form-row'>
            <div class='form-group col-md-2'>
              <label for='inputAddress'>ID</label>
              <input name='page' hidden type='text' value='$page'>
              <input name='type' hidden type='text' value='$modalmode'>
              <input name='table' hidden type='text' value='$page'>";
              If($modalmode === "insert"){
              echo "<input name='id' name='column[id]' readonly type='text' class='form-control' value='$codigo1'>";
              }else{
               echo "<input name='id' readonly type='text' class='form-control' value='$xid'>";
              }
              echo " </div>
            <div class='form-group col-md-4'> 
                <label>Description</label>
                <input name='column[description]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xdescription'  type='text' required class='form-control'>
            </div>
            <div class='form-group col-md-4'>
            <label for='inputAddress'>Type</label>
            <select name='column[type]' ".(($modalmode === "view" || $modalmode === "delete") ? "disabled" : "")." class='js-select2'>";
            $sql5 = "SELECT * FROM typeproduct";
            $result5 = sqlsrv_query($conn, $sql5);
            if (sqlsrv_has_rows($result5)) {
            // Output data of each row
            while ($row5 = sqlsrv_fetch_array($result5, SQLSRV_FETCH_ASSOC)) {
            $xtypeid    = $row5["id"];
            $xtype      = $row5["type"];
            $xtypedescri= $row5["description"];
                if ($xtypeprod === trim($xtype)) { echo "<option selected>[".$xtype."][".$xtypedescri."]</option>";} ElseIf ($xtypeprod <> $xtype OR Empty($xtypeprod)) { echo "<option>[".$xtype."][".$xtypedescri."]</option>";};
              }
            } 
            sqlsrv_free_stmt($result5);
          echo "</select>

          </div>
    </div>

     <div class='modal-footer'>
     <button class='btn btn-secondary' data-dismiss='modal'>Close</button>";
     If ($modalmode === "edit" || $modalmode === "insert"){
     echo "<button class='btn btn-primary' type='submit'>Save</button>";
     } ElseIf ($modalmode === "delete"){
      echo "<input hidden type='text' name='delete'  value='1'>
      <input hidden type='text' name='id'  value='$xid'>
      <button class='btn btn-danger' type='submit'>Delete</button>";
     }
     echo "</div>
     </form>
     </div>
     </div>
     </div>";
}elseif ($page === 'typeproduct'){
  $sql1 = "SELECT MAX(id) AS id FROM typeproduct";
  $result1 = sqlsrv_query($conn, $sql1);
  $row1 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
  $codigo1 = ($row1["id"] + 1);
  sqlsrv_free_stmt($result1);
  
  $msql = "SELECT * FROM typeproduct WHERE id = '".$_GET['id']."'";
  $mresult = sqlsrv_query($conn, $msql);
  
  if (sqlsrv_has_rows($mresult)) {
  // Output data of each row
  while ($row = sqlsrv_fetch_array($mresult, SQLSRV_FETCH_ASSOC)) {
      $xid            = $row["id"];
      $xtype	        = $row["type"];
      $xdescription	= $row["description"];
    }
  } 
  sqlsrv_free_stmt($mresult);
  
      echo "
      <div class='modal-dialog modal-xl'>
      <div class='modal-content'>
      <div class='modal-body'>
      <form method='POST' action='action/api.php'>
      <input hidden type='text' name='id'  value='$xid'>
      <div class='tab-content' id='xmyTabContent'>
      <div class='tab-pane fade show active' id='xtab-".$modalmode."1' role='tabpanel' aria-labelledby='xtab1".$modalmode."'>
      <div class='form-row'>
              <div class='form-group col-md-2'>
                <label for='inputAddress'>ID</label>
                <input name='page' hidden type='text' value='$page'>
                <input name='type' hidden type='text' value='$modalmode'>
                <input name='table' hidden type='text' value='$page'>";
                If($modalmode === "insert"){
                echo "<input readonly name='column[id]' type='text' class='form-control' value='$codigo1'>
                      <input name='id' hidden type='text' value='$xid'>";
                }else{
                 echo "<input name='id' readonly type='text' class='form-control' value='$xid'>";
                }
                echo " </div>
              <div class='form-group col-md-4'> 
                  <label>Type</label>
                  <input name='column[type]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xtype'  type='text' required class='form-control'>
              </div>
              <div class='form-group col-md-6'> 
              <label>Description</label>
              <input name='column[description]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xdescription'  type='text' required class='form-control'>
          </div>
      </div>
  
       <div class='modal-footer'>
       <button class='btn btn-secondary' data-dismiss='modal'>Close</button>";
       If ($modalmode === "edit" || $modalmode === "insert"){
       echo "<button class='btn btn-primary' type='submit'>Save</button>";
       } ElseIf ($modalmode === "delete"){
        echo "<input hidden type='text' name='delete'  value='1'>
        <input hidden type='text' name='id'  value='$xid'>
        <button class='btn btn-danger' type='submit'>Delete</button>";
       }
       echo "</div>
       </form>
       </div>
       </div>
       </div>";
  }elseif ($page === 'taxes'){
    $sql1 = "SELECT MAX(id) AS id FROM taxes";
    $result1 = sqlsrv_query($conn, $sql1);
    $row1 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
    $codigo1 = ($row1["id"] + 1);
    sqlsrv_free_stmt($result1);
    
    $msql = "SELECT * FROM taxes WHERE id = '".$_GET['id']."'";
    $mresult = sqlsrv_query($conn, $msql);
    
    if (sqlsrv_has_rows($mresult)) {
    // Output data of each row
    while ($row = sqlsrv_fetch_array($mresult, SQLSRV_FETCH_ASSOC)) {
        $xid            = $row["id"];
        $xdescription   = $row["description"];
        $xvalue	        = $row["value"];
        $xtypeofproduct = $row["typeofproduct"];
      }
    } 
    sqlsrv_free_stmt($mresult);
    
        echo "
        <div class='modal-dialog modal-xl'>
        <div class='modal-content'>
        <div class='modal-body'>
        <form method='POST' action='action/api.php'>
        <input hidden type='text' name='id'  value='$xid'>
        <div class='tab-content' id='xmyTabContent'>
        <div class='tab-pane fade show active' id='xtab-".$modalmode."1' role='tabpanel' aria-labelledby='xtab1".$modalmode."'>
        <div class='form-row'>
                <div class='form-group col-md-2'>
                  <label for='inputAddress'>ID</label>
                  <input name='page' hidden type='text' value='$page'>
                  <input name='type' hidden type='text' value='$modalmode'>
                  <input name='table' hidden type='text' value='$page'>";
                  If($modalmode === "insert"){
                  echo "<input readonly name='column[id]' type='text' class='form-control' value='$codigo1'>
                        <input name='id' hidden type='text' value='$xid'>";
                  }else{
                   echo "<input name='id' readonly type='text' class='form-control' value='$xid'>";
                  }
                  echo " </div>
                <div class='form-group col-md-3'> 
                    <label>Description</label>
                    <input name='column[description]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xdescription'  type='text' required class='form-control'>
                </div>
                <div class='form-group col-md-3'> 
                  <label>Value (%)</label>
                  <input name='column[value]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xvalue'  type='number' step='0.01' required class='form-control'>
                </div>
                <div class='form-group col-md-4'>
                  <label for='inputAddress'>Type of Product</label>
                  <select name='column[typeofproduct]' ".(($modalmode === "view" || $modalmode === "delete") ? "disabled" : "")." class='js-select2'>";
                  $sql5 = "SELECT * FROM typeproduct";
                  $result5 = sqlsrv_query($conn, $sql5);
                  if (sqlsrv_has_rows($result5)) {
                  // Output data of each row
                  while ($row5 = sqlsrv_fetch_array($result5, SQLSRV_FETCH_ASSOC)) {
                  $xtypeid    = $row5["id"];
                  $xtype      = $row5["type"];
                  $xtypedescri= $row5["description"];
                      if ($xtypeofproduct === trim($xtype)) { echo "<option selected>[".$xtype."][".$xtypedescri."]</option>";} ElseIf ($xtypeofproduct <> $xtype OR Empty($xtypeofproduct)) { echo "<option>[".$xtype."][".$xtypedescri."]</option>";};
                    }
                  } 
                  sqlsrv_free_stmt($result5);
                  echo "</select>
                </div>
        </div>
    
         <div class='modal-footer'>
         <button class='btn btn-secondary' data-dismiss='modal'>Close</button>";
         If ($modalmode === "edit" || $modalmode === "insert"){
         echo "<button class='btn btn-primary' type='submit'>Save</button>";
         } ElseIf ($modalmode === "delete"){
          echo "<input hidden type='text' name='delete'  value='1'>
          <input hidden type='text' name='id'  value='$xid'>
          <button class='btn btn-danger' type='submit'>Delete</button>";
         }
         echo "</div>
         </form>
         </div>
         </div>
         </div>";
    }elseif ($page === 'sales'){
      
      $sql1 = "SELECT MAX(id) AS id FROM sales";
      $result1 = sqlsrv_query($conn, $sql1);
      $row1 = sqlsrv_fetch_array($result1, SQLSRV_FETCH_ASSOC);
      $codigo1 = ($row1["id"] + 1);
      sqlsrv_free_stmt($result1);
      
      $msql = "SELECT * FROM sales 
      WHERE id = '".$_GET['id']."'";
      $mresult = sqlsrv_query($conn, $msql);
      
      if (sqlsrv_has_rows($mresult)) {
      // Output data of each row
      while ($row = sqlsrv_fetch_array($mresult, SQLSRV_FETCH_ASSOC)) {
          $xid            = $row["id"];
          $xproduct   = $row["product"];
          $xamount        = number_format($row["amount"], 2, '.', '');
          $xpriceunit = number_format($row["priceunit"], 2, '.', '');
          $xtotalprice = number_format($row["totalprice"], 2, '.', '');
          $xtaxes = number_format($row["taxes"], 2, '.', '');
          $xtotalpricetaxes = number_format($row["totalpricetaxes"], 2, '.', '');
        }
      } 
      sqlsrv_free_stmt($mresult);
      
          echo "
          <div class='modal-dialog modal-xl'>
          <div class='modal-content'>
          <div class='modal-body'>
          <form method='POST' action='action/api.php'>
          <input hidden type='text' name='id'  value='$xid'>
          <div class='tab-content' id='xmyTabContent'>
          <div class='tab-pane fade show active' id='xtab-".$modalmode."1' role='tabpanel' aria-labelledby='xtab1".$modalmode."'>
          <div class='form-row'>
                  <div class='form-group col-md-1'>
                    <label for='inputAddress'>ID</label>
                    <input name='page' hidden type='text' value='$page'>
                    <input name='type' hidden type='text' value='$modalmode'>
                    <input name='table' hidden type='text' value='$page'>";
                    If($modalmode === "insert"){
                    echo "<input readonly name='column[id]' type='text' class='form-control' value='$codigo1'>
                          <input name='id' hidden type='text' value='$xid'>";
                    }else{
                     echo "<input name='id' readonly type='text' class='form-control' value='$xid'>";
                    }
                    echo " </div>
                    <div class='form-group col-md-2'>
                    <label for='inputAddress'>Product</label>
                    <select onblur='calculateSales()' name='column[product]' ".(($modalmode === "view" || $modalmode === "delete") ? "disabled" : "")." class='js-select2'>";
                    $sql5 = "SELECT * FROM products";
                    $result5 = sqlsrv_query($conn, $sql5);
                    if (sqlsrv_has_rows($result5)) {
                    // Output data of each row
                    while ($row5 = sqlsrv_fetch_array($result5, SQLSRV_FETCH_ASSOC)) {
                    $xprodid    = $row5["id"];
                    $xproddescri= $row5["description"];
                    $xprodtype= $row5["type"];
                        if ($xproduct === trim($xproddescri)) { echo "<option selected>[".$xproddescri."]</option>";} ElseIf ($xproduct <> $xproddescri OR Empty($xproduct)) { echo "<option>[".$xproddescri."]</option>";};
                      }
                    } 
                    sqlsrv_free_stmt($result5);
                    echo "</select>
                  </div>
                  <div class='form-group col-md-1'> 
                    <label>Amount</label>
                    <input onblur='calculateSales()' name='column[amount]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xamount'  type='number' step='0.01' required class='form-control'>
                  </div>
                  <div class='form-group col-md-2'> 
                    <label>Price Unit</label>
                    <input onblur='calculateSales()' name='column[priceunit]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xpriceunit'  type='number' step='0.01' required class='form-control'>
                  </div>                  
                  <div class='form-group col-md-2'> 
                    <label>Total Price</label>
                    <input id='totalPrice' readonly name='column[totalprice]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xtotalprice'  type='number' step='0.01' required class='form-control'>
                  </div>
                  <div class='form-group col-md-2'> 
                    <label>Taxe</label>
                    <input id='taxe' readonly name='column[taxes]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xtaxes'  type='number' step='0.01' required class='form-control'>
                  </div>
                  <div class='form-group col-md-2'> 
                    <label>Total Price Taxed</label>
                    <input id='totalPriceTaxed' readonly name='column[totalpricetaxes]' ".(($modalmode === "view" || $modalmode === "delete") ? "readonly" : "")." oninput='handleInput(event)' value='$xtotalpricetaxes'  type='number' step='0.01' required class='form-control'>
                  </div>

          </div>
      
           <div class='modal-footer'>
           <button class='btn btn-secondary' data-dismiss='modal'>Close</button>";
           If ($modalmode === "edit" || $modalmode === "insert"){
           echo "<button class='btn btn-primary' type='submit'>Save</button>";
           } ElseIf ($modalmode === "delete"){
            echo "<input hidden type='text' name='delete'  value='1'>
            <input hidden type='text' name='id'  value='$xid'>
            <button class='btn btn-danger' type='submit'>Delete</button>";
           }
           echo "</div>
           </form>
           </div>
           </div>
           </div>";
      }
?>
<script>
function getTaxFromPHP(productid) {
  var tax = null;
  $.ajax({
    url: '../action/api.php',
    type: 'POST',
    data: { productid: productid, calculate: 'calculatetax' },
    async: false,
    success: function(response) {
      //console.log(response);
      tax = parseFloat(response.tax);
      //console.log(response.tax);
    },
    error: function() {
      console.log('Ajax Return Error');
    }
  });
  return tax;
}
</script>

<script>
function calculateSales() {
  var productid = document.getElementsByName('column[product]')[0].value;
  var amount = parseFloat(document.getElementsByName('column[amount]')[0].value);
  var priceUnit = parseFloat(document.getElementsByName('column[priceunit]')[0].value);
  
  productid = productid.slice(1, -1);

  console.log(productid);
  console.log(amount);
  console.log(priceUnit);

  if (!isNaN(amount) && !isNaN(priceUnit)) {
    var totalPrice = amount * priceUnit;
    var tax = getTaxFromPHP(productid);
    var totalTaxedPrice = totalPrice * (1 + tax / 100);

    //console.log(tax);

    document.getElementById('totalPrice').value = totalPrice.toFixed(2);
    document.getElementById('taxe').value = tax.toFixed(2);
    document.getElementById('totalPriceTaxed').value = totalTaxedPrice.toFixed(2);
  }
}
</script>