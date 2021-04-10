<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>E-Wallet Management System</title>


    <link href="assets/css/custom.css" rel="stylesheet"  crossorigin="anonymous">

    <!-- Favicons -->


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
  </head>
  <body>
    <?php include "header.php"?>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
  <h1 class="display-4">Welcome to E-wallet management system</h1>
</div>

<div class="container">
  <div class="card-deck mb-3 px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Wallet Balance</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title" style="font-size:80px">RM <?php
        $sql4 = "SELECT balance FROM users WHERE id = {$_SESSION['id']} ";
              if($stmt3 = $mysqli->query($sql4)){
                if($stmt3->num_rows>0){
                  if($row = $stmt3->fetch_array()){
                    $receiver_balance = $row["balance"];
                    echo $receiver_balance;
                  }
                $stmt3->close();
                }
              }?> </h1>


      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Total Transaction</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">RM <?php
             $sql = "SELECT * FROM transaction WHERE sender_id = {$_SESSION['id']} || receiver_id = {$_SESSION['id']}";
             $total_transaction = 0;
             if($result = $mysqli->query($sql)){
                 if($result->num_rows > 0){
                   while($row = $result->fetch_array()){
                     $total_transaction += $row['amount'];
                   }

                  }
                }echo $total_transaction; ?></h1>
        <a type="button" href="transactions.php" class="btn btn-lg btn-block btn-primary">View All</a>
      </div>
    </div>
    <div class="card mb-4 shadow-sm">
      <div class="card-header">
        <h4 class="my-0 font-weight-normal">Received Amount</h4>
      </div>
      <div class="card-body">
        <h1 class="card-title pricing-card-title">RM<?php
             $sql = "SELECT * FROM transaction WHERE  receiver_id = {$_SESSION['id']}";
             $total_received = 0;
             if($result = $mysqli->query($sql)){
                 if($result->num_rows > 0){
                   while($row = $result->fetch_array()){
                     $total_received += $row['amount'];
                   }

                  }
                }echo $total_received; ?></h1>
        <a type="button" href="transactions.php" class="btn btn-lg btn-block btn-primary">View All</a>
      </div>
    </div>

  <div class="table-responsive">
    <h2 style="margin-top:20px;">Transaction</h2>
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>ID</th>
                <th>Payment (RM)</th>
                <th>Date & Time</th>
                  <th>Remaining balance</th>

              </tr>
            </thead>
            <tbody>
            <?php
               $sql = "SELECT * FROM transaction WHERE sender_id = {$_SESSION['id']}";
               if($result = $mysqli->query($sql)){
                   if($result->num_rows > 0){
                     while($row = $result->fetch_array()){
                     echo "<tr>";
                     echo "<td>".$row["id"]."</td>";
                    echo "<td>" .$row["amount"]."</td>";
                     echo "<td>" .$row["datetime"]."</td>";
                    echo "<td>" .$row["rem_balance"]."</td>";

                    echo "</tr>";
                     }
                   }
                }

            ?>


            </tbody>
          </table>
        </div>
  </div>

  <footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="row">
      <div class="col-12 col-md">
        <small class="d-block mb-3 text-muted">&copy;2021 E-Wallet Management System</small>
      </div>

    </div>
  </footer>
</div>
</body>
</html>
