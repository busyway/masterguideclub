<?php
  require_once "db.php";

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
    $query = "INSERT INTO `newapplicants`(`registration_code`, `fullname`, `contact`, `church_code`, registerdate) VALUES ('".$_POST["newApplicant"]."', '".$_POST["fullname"]."', '".$_POST["contact"]."', '".$_POST["church_code"]."', CURRENT_DATE())";
    if (mysqli_query($conn, $query))
    {
      echo "Records Submitted Successfully.";
    }
  }

?>