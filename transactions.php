<?php
  session_start();
  // Check if the user is logged in, if not then redirect him to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
  require_once "config.php";


?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>E-Wallet Management System</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/pricing/">


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
<?php include "header.php";

?>

<div class="container">
  <h2>Sent</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Date & Time</th>
              <th>Amount</th>
              <th>Sender ID</th>
              <th>Receiver ID</th>
            </tr>
          </thead>
          <tbody>
          <?php
             $sql = "SELECT * FROM transaction WHERE sender_id = {$_SESSION['id']}";
             if($result = $mysqli->query($sql)){
                 if($result->num_rows > 0){
                   while($row = $result->fetch_array()){
                   echo "<tr>";
                   echo "<td>".$row['id']."</td>";
                   echo "<td>" .$row['datetime']."</td>";
                   echo "<td>" .$row['amount']."</td>";
                   echo "<td>".$row['sender_id']."</td>";
                   echo "<td>".$row['receiver_id']."</td>";
                  echo "</tr>";
                   }
                 }
              }

          ?>


          </tbody>
        </table>
      </div>
      <h2>Received</h2>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Date & Time</th>
              <th>Amount</th>
              <th>Sender ID</th>
              <th>Receiver ID</th>
            </tr>
          </thead>
          <tbody>
          <?php
             $sql = "SELECT * FROM transaction WHERE receiver_id = {$_SESSION['id']}";
             if($result = $mysqli->query($sql)){
                 if($result->num_rows > 0){
                   while($row = $result->fetch_array()){
                   echo "<tr>";
                   echo "<td>".$row['id']."</td>";
                   echo "<td>" .$row['datetime']."</td>";
                   echo "<td>" .$row['amount']."</td>";
                   echo "<td>".$row['sender_id']."</td>";
                   echo "<td>".$row['receiver_id']."</td>";
                  echo "</tr>";
                   }
                 }
              }

          ?>


          </tbody>
        </table>
      </div>
</div>
</body>
</html>
