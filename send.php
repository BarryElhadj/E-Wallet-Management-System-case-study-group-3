<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}

require_once "config.php";

$sender = $_SESSION["username"];
$receiver = $receiver_err = $amount_err = "";

$sql4 = "SELECT balance FROM users WHERE id = {$_SESSION['id']} ";
if($stmt3 = $mysqli->query($sql4)){
  if($stmt3->num_rows>0){
    if($row = $stmt3->fetch_array()){
      $balance = $row["balance"];
    }
  $stmt3->close();
  }
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

  if(empty(trim(($_POST["receiver"])))){
    $receiver_err = "Please enter reveiver's username.";
  }
  else{
    $receiver = trim($_POST["receiver"]);
  }

  if(empty(trim(($_POST["amount"])))){
    $amount_err = "Please enter the amount.";
  }
  elseif((float)(trim($_POST["amount"]))> (float)$_SESSION["balance"]){
    $amount_err = "Amount is greater than your balance";
  }
  else{
    $amount = trim($_POST["amount"]);
  }

  if(empty($receiver_err) && empty($amount_err)){
    $sql1 = "INSERT into transaction(sender_id, receiver_id, amount, rem_balance) VALUES (?, ?, ?, ?)";
    $sql2 = "UPDATE users SET balance = ? WHERE id = ?";
    $sql3 = "SELECT balance FROM users WHERE id = ?";
    if($stmt = $mysqli->prepare($sql1)){
      $stmt->bind_param("ssdd", $param_sender, $param_receiver,  $param_amount, $param_rem_balance );

      $param_sender = $_SESSION["id"];
      $param_receiver = $receiver;
      $param_amount = $amount;
      $param_rem_balance = $balance - $amount;

      if($stmt->execute()){
       header("location: welcome.php");
        if($stmt2 = $mysqli->prepare($sql2)){
          $stmt2->bind_param("dd", $param_balance, $param_sender);
          $discount = 0;
          if(date("h")>=8 && date("a")=='am'){
            $param_balance = $balance - $amount;
          }
            elseif(date("h")>=12 && date("a")=="pm" ){
              $param_balance = $balance - $amount;
            }else{
            $param_balance = $balance - $amount;
            }
          if($stmt2->execute()){
            $sql4 = "SELECT balance FROM users WHERE id = {$param_receiver} ";
              if($stmt3 = $mysqli->query($sql4)){
                if($stmt3->num_rows>0){
                  if($row = $stmt3->fetch_array()){
                    $receiver_balance = $row["balance"];
                  }
                $stmt3->close();
                if($stmt4 = $mysqli->prepare($sql2)){
                  $stmt4->bind_param("dd", $param_bal, $param_receiver);
                  $param_bal = $receiver_balance + $amount;
                  if($stmt4->execute()){
                     header("location: success.php");
                  }
                  else{
                    echo "Oops! Problem updating  receiver balance";
                  }
                }
              }
            }
               }
               else{
                 echo "Oops! Problem fetching  receiver balance";
               }
             }
          }
          else{
            echo "Oops! Problem updating sender balance";
          }
        }
      }
      else{
        echo "Oops! Problem in inserting new transaction";
      }


}
?>
<html lang="en">
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
             <input type="text"  placeholder="Receiver ID" name="receiver" class="form-control  <?php echo (!empty($receiver_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
           </div>
           <div class="form-group">
                <input type="number" placeholder="Amount" name="amount" class="form-control  <?php echo (!empty($amount_err)) ? 'is-invalid' : ''; ?>">
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit" value="Send">Send</button>
        </form>
    </div>
</div>


</body>
</html>
