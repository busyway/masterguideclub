<?php
  require_once "../db.php";

  if (isset($_POST["searchApplicants"]))
  {
    $query = "SELECT * FROM registration_fee WHERE registration_code = '".$_POST["searchApplicants"]."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    if (mysqli_num_rows($result) > 0)
    {
       $msg = 300;
       echo json_encode($msg);
    }
    else 
    {
      $query = "SELECT * FROM newapplicants INNER JOIN churches on newapplicants.church_code = churches.church_code WHERE registration_code = '".$_POST["searchApplicants"]."' ";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      if (mysqli_num_rows($result) > 0)
      {
       echo json_encode($row);
      }
      else 
      {
        $msg = 100;
        echo json_encode($msg);
      }
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

  if (isset($_POST["district_approve"]))
  {
    $query = "UPDATE registration_fee SET district_confirm = 'approved' WHERE registration_code = '".$_POST["district_approve"]."' ";
    if (mysqli_query($conn, $query))
    {
      echo "Member Approved Successfully.";
    }

  }

  if(isset($_POST["approvedApplicants"]))
  {
    $query = "SELECT * from registration_fee INNER JOIN newapplicants ON newapplicants.registration_code = registration_fee.registration_code WHERE district_confirm = 'approved' AND district_code = '".$_POST["district_code"]."' ";
    $result = mysqli_query($conn, $query);
    $output = '
           <table class="table table-bordered table-hover" id="tbl_Company">
           <thead> 
            <tr>
             
             <th width="10%">DATE</th>
             <th width="10%">CODE</th>
             <th width="10%">PICTURE</th>
             <th width="30%">FULLNAME</th>
             <th width="20%">CHURCH</th>
             <th width="20%">CONTROLS</th>
            </tr>
            </thead>
          ';
          while($row = mysqli_fetch_array($result))
          {
           $output .= '

            <tr>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["paid_date"].'</td>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["registration_code"].'</td>
             <td>
                    <img id="theImage" style="height: 80px; width: 80px; border-radius: 100%" class="avatar img-square img-thumbnail fullscreen" src="../membership/'.$row["picture"].'" onClick="makeFullScreen()"></img>
              </td>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["fullname"].'</td>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["church"].'</td>
             
             <td>
                <button class="btn-success btnApprove"id="'.$row["registration_code"].'" >EDIT</button>
                
               </td>
            
            </tr>
           ';
          }
          $output .= '</table>';
          echo $output;
  }

  if(isset($_POST["pendingApplicants"]))
  {
    $query = "SELECT * from registration_fee INNER JOIN newapplicants ON newapplicants.registration_code = registration_fee.registration_code WHERE district_confirm = 'pending' AND district_code = '".$_POST["district_code"]."' ";
    $result = mysqli_query($conn, $query);
    $output = '
           <table class="table table-bordered table-hover" id="tbl_Company">
           <thead> 
            <tr>
             
             <th width="10%">DATE</th>
             <th width="10%">CODE</th>
             <th width="10%">PICTURE</th>
             <th width="30%">FULLNAME</th>
             <th width="20%">CHURCH</th>
             <th width="20%">CONTROLS</th>
            </tr>
            </thead>
          ';
          while($row = mysqli_fetch_array($result))
          {
           $output .= '

            <tr>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["paid_date"].'</td>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["registration_code"].'</td>
             <td>
                    <img id="theImage" style="height: 80px; width: 80px; border-radius: 100%" class="avatar img-square img-thumbnail fullscreen" src="../membership/'.$row["picture"].'" onClick="makeFullScreen()"></img>
              </td>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["fullname"].'</td>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["church"].'</td>
             
             <td>
                <button class="btn-success btnApprove"id="'.$row["registration_code"].'" >APPROVE</button>
                <button class="btn-danger btnDecline"id="'.$row["registration_code"].'">DECLINE</button>
                
               </td>
            
            </tr>
           ';
          }
          $output .= '</table>';
          echo $output;
  }

?>