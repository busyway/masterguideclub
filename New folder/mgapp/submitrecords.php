<?php
  require_once "db.php";

  /*LOGIN DETAILS*/
  if (isset($_POST["userLogin"]))
  {
    // echo "string";
    $login = $_POST["userLogin"];

    if ($login == "NEXT")
    {
      $query = "SELECT * FROM userlogins WHERE login_id = '".$_POST["staffId"]."' ";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      if (mysqli_num_rows($result) > 0)
      {
        $msg = 200;
        echo json_encode($msg);
      }
      else 
      {
        $msg = 100;
        echo json_encode($msg);
      }
    }
    else if($login == "SIGN IN")
    {
      $decryptPass = md5($_POST["loginPassword"]);

      $query = "SELECT * FROM userlogins WHERE login_id = '".$_POST["staffId"]."' AND password = '".$decryptPass."' ";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      if (mysqli_num_rows($result) > 0)
      {
        // $msg = 400;
        echo json_encode($row);
         session_start();
        $_SESSION["loggedin"] = true;

      }
      else 
      {
        $msg = 300;
        echo json_encode($msg);
      }
    }
   /* else if ($login = "CREATE PASSWORD")
    {
      $encryptPass = md5($_POST["loginPassword"]);
      $query ="UPDATE pharmacist SET password = '".$encryptPass."' WHERE pharmaid = '".$_POST["staffId"]."' ";
      if (mysqli_query($conn, $query))
      {
        echo json_encode("New Password Created Successfully");
      }
    }*/
    

  }
?>