<?php
   include_once 'database.php';
   include_once 'auth.php';
   include_once 'nav_bar.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style2.css">
    <title>MothaBoards : HOME</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  


</head>

<body>
    <div>
        <p style="text-align:center;"><img src = logo.png width="50%" height="50%"></p>
    </div>
    <hr>
    </>
    
    <section class="wrapper">

        <div class="container-big">
            <div>
                <img src="" class="big-logo"/>
                <h1 class="heading">
                 Products List
            </h1>
                <hr>
                </>


                <div class="row">
      <?php
       $per_page = 9;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page = 1;
      $start_from = ($page-1) * $per_page;

      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("select * from tbl_products_a161032 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
       foreach($result as $readrow) {
      ?>
                    <div class="col-xs-12 col-sm-4">
                        <div class="carbox" style="border-style: solid; border-color: #363636; border-width: 5px">
                            <?php if ($readrow['FLD_PRODUCT_IMAGE'] == "" ) {
                             echo "No image";
                             }
                              else { ?>
                            <img src="products/<?php echo $readrow['FLD_PRODUCT_IMAGE'] ?>" class="img-responsive" style="width: 300px; height: 150px; object-fit: cover;">
                            <?php } ?>
                            <div class="carbox-content">
                                <h4 class="carbox-title">
                                    <strong><p><?php echo $readrow['FLD_PRODUCT_NAME']; ?></p></strong>
                                    <p>Product ID: <?php echo $readrow['FLD_PRODUCT_ID']; ?></p>
                                    <p>Price: RM<?php echo $readrow['FLD_PRICE']; ?></p>
                                    <p>Brand: <?php echo $readrow['FLD_BRAND']; ?></p>
                                    <p>Model: <?php echo $readrow['FLD_MODEL']; ?></p>
                                    <p>Year: <?php echo $readrow['FLD_YEAR_MANUFACTURED']; ?></p>
                                  </a>
                                </h4>
                            </div>
                            <div class="carbox-read-more" style="border-style: solid; border-color: #363636; border-width: 2px">
                                <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-link btn-block" role="button">
                                    More Details
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
      }
      $conn = null;
      ?>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </section>
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <nav>
                <ul class="pagination">
                    <?php
          try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM tbl_products_a161032");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $total_records = count($result);
          }
          catch(PDOException $e){
                echo "Error: " . $e->getMessage();
          }
          $total_pages = ceil($total_records / $per_page);
          ?>
                    <?php if ($page==1) { ?>
                    <li class="disabled"><span aria-hidden="true">«</span></li>
                    <?php } else { ?>
                    <li><a href="index.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                    <?php
          }
          for ($i=1; $i<=$total_pages; $i++)
            if ($i == $page)
              echo "<li class=\"active\"><a href=\"index.php?page=$i\">$i</a></li>";
            else
              echo "<li><a href=\"index.php?page=$i\">$i</a></li>";
          ?>
                    <?php if ($page==$total_pages) { ?>
                    <li class="disabled"><span aria-hidden="true">»</span></li>
                    <?php } else { ?>
                    <li><a href="index.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>



</html>