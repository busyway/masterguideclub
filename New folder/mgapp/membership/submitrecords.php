<?php
  require_once "../db.php";

  if (isset($_POST["searchApplicants"]))
  {
    $query = "SELECT * FROM newapplicants INNER JOIN churches on newapplicants.church_code = churches.church_code WHERE registration_code = '".$_POST["searchApplicants"]."' ";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      if (mysqli_num_rows($result) > 0)
      {
       echo json_encode($row);
      }
  }



  if (isset($_POST["updateApplication"]))
  {
    $query = "UPDATE `newapplicants` SET `fullname`='".$_POST["fullname"]."',`contact`='".$_POST["contact"]."' WHERE `registration_code`= '".$_POST["updateApplication"]."' ";

    if (mysqli_query($conn, $query))
    {
      echo "Records Updated Successfully.";
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


   if(isset($_POST["loadimage"]))
    {
      
       // $query = "SELECT student_image FROM student_images WHERE studentid = '".$_POST["studentid"]."'";
       // $query = "SELECT * FROM pharmacist WHERE pharmaid = '".$_POST["loadimage"]."'";
      $query = "SELECT * FROM newapplicants INNER JOIN churches on newapplicants.church_code = churches.church_code WHERE registration_code = '".$_POST["loadimage"]."' ";

       $result = mysqli_query($conn, $query);

       $output ='';

       if (mysqli_num_rows($result) > 0) //if record is found.
       {

          while($row = mysqli_fetch_array($result))
          {
             if($row['picture'] == "") // If the records doesn't have any picture then we shall display this image
              {
                
               echo '<img src="../images/gallery/master-guides.JPG" style="border-radius: 50% 50% 50% 50%; width: 150px; height: 150px" alt="profile pic" >';
              }
              
              else //But if the record comes with a picture then display the user picture.
              {
               $output .= '

                  <img id="theImage" style="height: 180px; width: 200px; border-radius: 100%" class="avatar img-square img-thumbnail fullscreen" src="'.$row["picture"].'" onClick="makeFullScreen()"></img>                         
              ';
                echo $output;
              }

           
             
          }
           

        }
        else //if no records is found then display this picture box.
        {
          echo '<img src="../images/gallery/imgbox3.jpg" class="avatar img-circle img-thumbnail" alt="avatar">';
        }

    }

?>