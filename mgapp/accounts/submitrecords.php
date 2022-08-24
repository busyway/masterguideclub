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

  if (isset($_POST["paymentApproved"]))
  {
    $query = "INSERT INTO `registration_fee`(`registration_code`, `church`, `paid_date`, `amount`, `fullname`, `contact`, district_confirm, federation_confirm, conference_confirm) VALUES ('".$_POST["paymentApproved"]."', '".$_POST["church"]."', CURRENT_DATE(), '".$_POST["amount"]."', '".$_POST["fullname"]."', '".$_POST["contact"]."', 'pending', 'pending', 'pending')";
    if (mysqli_query($conn, $query))
    {
      echo "Payment Approved Successfully.";
    }

  }

  if(isset($_POST["approvedApplicants"]))
  {
    $query = "SELECT * from registration_fee";
    $result = mysqli_query($conn, $query);
    $output = '
           <table class="table table-bordered table-hover" id="tbl_Company">
           <thead> 
            <tr>
             <th width="10%">DATE</th>
             <th width="10%">CODE</th>
             <th width="40%">FULLNAME</th>
             <th width="20%">CHURCH</th>
             <th width="20%">AMOUNT</th>
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
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["fullname"].'</td>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["church"].'</td>
             <td class="clsAddCompany" id="'.$row["registration_code"].'">'.$row["amount"].'</td>
             <td>
                <span class="fa fa-trash cursor manageCompany" style="font-size: 25pt; color: red; cursor: pointer;" id="'.$row["registration_code"].'"></span>
               </td>
            
            </tr>
           ';
          }
          $output .= '</table>';
          echo $output;
  }

?>