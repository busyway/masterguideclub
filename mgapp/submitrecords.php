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

  if (isset($_POST["selectChurch"]))
  {
      $query = "SELECT * FROM churches WHERE church_code = '".$_POST["selectChurch"]."'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      if (mysqli_num_rows($result) > 0)
      {
        echo json_encode($row);
      }
  }


  if (isset($_POST["countApplicant"]))
  {
      $query = "SELECT COUNT(*) AS TOTAL FROM newapplicants WHERE church_code = '".$_POST["countApplicant"]."' ";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      $records = $row['TOTAL'];
      echo json_encode($records);
      
  }

  if (isset($_POST["newApplicant"]))
  {
    $query = "SELECT * FROM newapplicants WHERE contact = '".$_POST["contact"]."' ";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      if (mysqli_num_rows($result) > 0)
      {
        $msg = 200;
        echo json_encode($msg);
      }
      else 
      {
        $query = "INSERT INTO `newapplicants`(`registration_code`, `fullname`, `contact`, `church_code`, district_code, federation, registerdate) VALUES ('".$_POST["newApplicant"]."', '".$_POST["fullname"]."', '".$_POST["contact"]."', '".$_POST["church_code"]."','".$_POST["districtCode"]."','".$_POST["federation"]."', CURRENT_DATE())";
        if (mysqli_query($conn, $query))
        {
          echo "Records Submitted Successfully.";
        }
      }

    
  }
?>