<?php
    session_start();

    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
    }
    require_once "config.php";

    $sender = $_SESSION["username"];
    $amount = 0;

    $sql1 = "SELECT balance FROM users WHERE id = {$_SESSION['id']}";

    if($stmt1 = $mysqli->query($sql1)){
        if($stmt1->num_rows>0){
            if($row = $stmt1->fetch_array()){
              $balance = $row["balance"];
            }
          $stmt1->close();
        }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
       $sql2 = "UPDATE users SET balance = ? WHERE id = ? ";
       $sql3 = "INSERT INTO topup(amount, user_id) VALUES(?, ?)";


        if(empty(trim($_POST["amount"]))){
            $amount_err = "Please enter the amount";
        }
        else{
            $amount = trim($_POST["amount"]);
        }
        if($stmt2 = $mysqli->prepare($sql2)){
            $stmt2->bind_param("dd", $praram_balance, $param_sender);
            $praram_balance = $balance + $amount ;
            $param_sender = $_SESSION["id"];
            if($stmt2->execute()){
              if($stmt3 = $mysqli->prepare($sql3)){
                $stmt3->bind_param("dd", $amount, $param_sender);
                if($stmt3->execute()){
                  echo "<center> <h2> Successful. Thank you for topup </h2></center>";
                }
                
              }
            
            }
            else{
                echo "Oops! Problem updating balance";
            }
        }
        }

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>E-Wallet Management System</title>

    <link href="assets/css/custom.css" rel="stylesheet"  crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet"  crossorigin="anonymous">

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
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <div class="m-5 mb-3 text-center">
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

           <div class="form-group">
                <input type="number" placeholder="Amount" name="amount" class="form-control  <?php echo (!empty($amount_err)) ? 'is-invalid' : ''; ?>">
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit" value="Send">Top Up</button>
        </form>
    </div>
    <h3>TopUp History</h3>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Date & Time</th>
              <th>Amount (RM)</th>
            </tr>
          </thead>
          <tbody>
          <?php
             $sql = "SELECT * FROM topup WHERE user_id = {$_SESSION['id']}";
             if($result = $mysqli->query($sql)){
                 if($result->num_rows > 0){
                   while($row = $result->fetch_array()){
                   echo "<tr>";
                   echo "<td>" .$row['datetime']."</td>";
                   echo "<td>" .$row['amount']."</td>";
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
