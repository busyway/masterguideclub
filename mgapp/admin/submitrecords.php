<?php
  require_once "../db.php";


  if(isset($_POST["appliedApplicants"]))
  {
    $query = "SELECT * from churches INNER JOIN newapplicants on newapplicants.church_code = churches.church_code ORDER BY church ASC  ";
    $result = mysqli_query($conn, $query);
    $output = '
           <table class="table table-bordered table-hover" id="tbl_confirmRegistration">
           <thead> 
            <tr>
             
             <th width="10%">DATE</th>
             <th width="10%">CODE</th>
             <th width="30%">FULLNAME</th>
             <th width="10%">PICTURE</th>
             <th width="10%">CONTACT</th>
             <th width="10%">CHURCH</th>
            </tr>
            </thead>
          ';
          while($row = mysqli_fetch_array($result))
          {
           $output .= '

            <tr>
             <td >'.$row["registerdate"].'</td>
             <td >'.$row["registration_code"].'</td>
             <td >'.$row["fullname"].'</td>
             <td>
                    <img id="theImage" style="height: 80px; width: 80px; border-radius: 100%" class="avatar img-square img-thumbnail fullscreen" src="../membership/'.$row["picture"].'" onClick="makeFullScreen()"></img>
              </td>
             <td >'.$row["contact"].'</td>
             <td >'.$row["church"].'</td>
             
            
            </tr>
           ';
          }
          $output .= '</table>';
          echo $output;
  }

  if (isset($_POST["confirmRegistration"]))
  {
    $password = md5($_POST["password"]);

    $query = "INSERT INTO userlogins (login_id, password, 'status') VALUES ('".$_POST["confirmRegistration"]."', '".$password."', 'member') ";
    if (mysqli_query($conn, $query))
    {
     echo "Records Saved Successfully"; 
    }

    $query = "UPDATE registration_fee SET msg_confirm = 'confirm' WHERE registration_code = '".$_POST["confirmRegistration"]."' ";
    if (mysqli_query($conn, $query))
    {
      echo "Records Updated Successfully";
    }
  }


  if(isset($_POST["approvedApplicants"]))
  {
    $query = "SELECT * from registration_fee  WHERE msg_confirm = '' ";
    $result = mysqli_query($conn, $query);
    $output = '
           <table class="table table-bordered table-hover" id="tbl_confirmRegistration">
           <thead> 
            <tr>
             
             <th width="10%">DATE</th>
             <th width="10%">CODE</th>
             <th width="30%">FULLNAME</th>
             <th width="20%">CONTROLS</th>
            </tr>
            </thead>
          ';
          while($row = mysqli_fetch_array($result))
          {
           $output .= '

            <tr>
             <td>'.$row["paid_date"].'</td>
             <td>'.$row["registration_code"].'</td>
             <td>'.$row["fullname"].'</td>
             <td>
                
                <a href="#myModal" data-toggle="modal" class="btn btn-success btnConfirm" id="'.$row["registration_code"].'" >CONFIRM</a>
                
               </td>
            
            </tr>
           ';
          }
          $output .= '</table>';
          echo $output;
  }

?>