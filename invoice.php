<?php
  include_once 'database.php';
?>
 
 <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_a161032, tbl_staff_a161032,
        tbl_customer_a161032, tbl_orders_details_a161032 WHERE
        tbl_orders_a161032.FLD_STAFF_ID = tbl_staff_a161032.FLD_STAFF_ID AND
        tbl_orders_a161032.FLD_CUSTOMER_ID = tbl_customer_a161032.FLD_CUSTOMER_ID AND
        tbl_orders_a161032.FLD_ORDER_ID = tbl_orders_details_a161032.FLD_ORDER_ID AND
        tbl_orders_a161032.FLD_ORDER_ID = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MothaBoards : INVOICE</title>
   <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <div class="row">
<div class="col-xs-6 text-center">
  <br>
    <img src="logo.png" width="60%" height="60%">
</div>
<div class="col-xs-6 text-right">
  <h1>INVOICE</h1>
  <h5>Order: <?php echo $readrow['FLD_ORDER_ID'] ?></h5>
  <h5>Date: <?php echo $readrow['FLD_ORDER_DATE'] ?></h5>
</div>
</div>
<hr>
<div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>From: MothaBoards Sdn. Bhd.</h4>
      </div>
      <div class="panel-body">
        <p>
        Universiti Kebangsaan Malaysia <br>
        43600 UKM Bangi, Selangor <br>
        Malaysia <br>
        </p>
      </div>
    </div>
  </div>
    <div class="col-xs-5 col-xs-offset-2 text-right">
        <div class="panel panel-default">
            <div class="panel-heading">
              <h4>To : <?php echo $readrow['FLD_CUSTOMER_NAME'] ?></h4>
            </div>
            <div class="panel-body">
        <p>
        Universiti Kebangsaan 2 Malaysia <br>
        43600 UKM Bangi, Selangor <br>
        Malaysia <br>
        </p>
            </div>
        </div>
    </div>
</div>
 
<table class="table table-bordered">
  <tr>
    <th>No</th>
    <th>Product</th>
    <th class="text-center">Quantity</th>
    <th class="text-center">Price(RM)/Unit</th>
    <th class="text-center">Total(RM)</th>
  </tr>
  <?php
  $grandtotal = 0;
  $counter = 1;
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a161032,
        tbl_products_a161032 where 
        tbl_orders_details_a161032.FLD_PRODUCT_ID= tbl_products_a161032.FLD_PRODUCT_ID AND
        FLD_ORDER_ID = :oid");
    $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
    $stmt->execute();
    $result = $stmt->fetchAll();
  }
  catch(PDOException $e){
        echo "Error: " . $e->getMessage();
  }
  foreach($result as $detailrow) {
  ?>
  <tr>
    <td><?php echo $counter; ?></td>
    <td><?php echo $detailrow['FLD_PRODUCT_NAME']; ?></td>
    <td class="text-right"><?php echo $detailrow['FLD_ORDER_DETAIL_QUANTITY']; ?></td>
    <td class="text-right"><?php echo $detailrow['FLD_PRICE']; ?></td>
    <td class="text-right"><?php echo $detailrow['FLD_PRICE']*$detailrow['FLD_ORDER_DETAIL_QUANTITY']; ?></td>
  </tr>
  <?php
    $grandtotal = $grandtotal + $detailrow['FLD_PRICE']*$detailrow['FLD_ORDER_DETAIL_QUANTITY'];
    $counter++;
  } // while
  ?>
  <tr>
    <td colspan="4" class="text-right">Grand Total</td>
    <td class="text-right"><?php echo $grandtotal ?></td>
  </tr>
</table>
 
<div class="row">
  <div class="col-xs-5">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Bank Details</h4>
      </div>
      <div class="panel-body">
        <p>Your Name :</p>
        <p>Bank Name :</p>
        <p>SWIFT : </p>
        <p>Account Number : </p>
        <p>IBAN : </p>
      </div>
    </div>
    </div>
  <div class="col-xs-7">
    <div class="span7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Contact Details</h4>
        </div>
        <div class="panel-body">
          <p> Staff: <?php echo $readrow['FLD_STAFF_NAME'] ?> </p>
          <p>Hope You Can Come and Visit Us Again!! </p>
          <p><br></p>
          <p><br></p>
          <p>Computer-generated invoice. No signature is required.</p>
        </div>
      </div>
    </div>
  </div>
</div>
 
</body>
</html>