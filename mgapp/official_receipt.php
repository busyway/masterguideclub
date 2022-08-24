<?php
 
 function fetch_head()  
 {    
      //Declear variables
      //the $_POST[""] is the textbox name not the id.

      // $meetingcode = $_POST["txtConferenceTithe"];


      /*$incomeid = $_POST["txtIncomeID"];
      $division = $_POST["txtDivision"];*/

      
      $html = '';

       /*$connect = mysqli_connect("localhost", "root", "", "easysales", 3308); 

      
       $sql = "SELECT * FROM  companyregistration  "; 

      $result = mysqli_query($connect, $sql);

      while($row = mysqli_fetch_array($result))  
      {*/        
      $html .= '
        
      <style>
        .table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 110%;

          }

          .th {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 10pt;
            font-weight: bold;
          }

          .td {
            border: 1px solid #dddddd;
            text-align: left;
            font-size: 10pt;

            line-height: 24px;
          }

          .remark{
            line-height:10px;
          }
          .backColor
          {
            background-color: black
          }

          

      </style>



        <table>

            <tr>
               <img src="images/gallery/master-guides.JPG" border="0" height="90" width="90"/>
              <th colspan="9" align="center"></th>

            </tr>

            


            <tr> 
             
              <th colspan="7" align="center"><h2 color="blue">ASHANTI CENTRAL GHANA CONFERENCE</h2> </th>
            </tr>

            <tr>
              <th colspan="7" align="center"><h2><strong color="red">MASTER GUIDE CLUB</strong></h2></th>
            </tr>
            
            <tr>
              <th colspan="7" align="center"> <strong color="blue">mail : </strong>info@masterguideclub.com /<br> ascgmasterguideclub@gmail.com</th>
             
            </tr>

            <tr>
              <th colspan="7" align="center"> <strong color="blue">Contact : </strong>+233 244 649519 </th>
             <hr>
            </tr>
            
        </table>

              ';  
      // }  
      return $html;  
 }



 function load_suppliers()  
 {    
      //Declear variables

      // $student_id = $_POST["txtstudentid"];
     




      $html = '';  
      $connect = mysqli_connect("localhost", "root", "", "easysales", 3308);  
      $count = 1;

      $html .= '

          <style>
            .table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 110%;

              }

              .th {
                border: 1px solid #dddddd;
                text-align: left;
                font-size: 10pt;
                font-weight: bold;
              }

              .td {
                border: 1px solid #dddddd;
                text-align: left;
                font-size: 10pt;

                line-height: 24px;
              }

              .remark{
                line-height:10px;
              }
              .backColor
              {
                background-color: black
              }

          </style>

        <table  cellpadding="2" cellspacing="2" border="">


          <tr>

            <th colspan="9" align="center" color="red"><b>OFFICIAL REGISTRATION REPORT</b></th>

           </tr>

           <tr>

            <td colspan="9" align="left">
              Hi , <strong>'.$_POST["fullname"].'</strong> <br>

              We have successfully received your application from <strong>'.$_POST["church"].' SDA CHURCH, '.$_POST["district"].' DISTRICT, '.$_POST["federation"].' FEDERATION,</strong> with registration number <strong color="red">'.$_POST["registration_no"].'</strong>.<br>
              Thank you for your interest and the time you’ve invested in applying to <strong color="darkred">ASCG MASTER GUIDE CLUB</strong>.
              You are a step away from becoming a full member of our club. Kindly follow the steps below to complete your registration process.
            </td>

           </tr>

           <tr>

            <td colspan="9" align="left">
              
              <div color="red"><strong>STEP II:</strong>
              </div><strong color="blue">PAYMENT OF REGISTRATION FEES</strong> <br>

              Send your registration of Thirty Ghana Cedis (30.00) to our MTN Momo number.<br>
              <strong color="red">NB:</strong> Please use your registration number as a reference number when sending the money. <br><br>

             <strong color="red">Momo Details</strong>
             <ul>
              <li>Momo Number : 0248 489 972 </li>
              <li>Momo name : Prince Owusu Takyi</li>
              <li>Reference Number : '.$_POST["registration_no"].'</li>
             </ul>
              You shall receive an SMS with login details when we confirm your payment.
            </td>

           </tr>


           <tr>

            <td colspan="9" align="left">
              
              <div color="red"><strong>STEP III:</strong>
              </div><strong color="blue">USER LOGIN</strong>
             <ul>
              <li>Log onto our official  <a href="http://localhost/masterguideclub/mgapp/login.php">MG APP</a> with your registration number and password given.</li>
              <li>Navigate to the personal info and upload your profile passport size picture (Maximum picture size 2MB)</li>
             </ul>
              Your current membership status is pending.
            </td>

           </tr>

           <tr>

            <td colspan="9" align="left">
              
              <div color="red"><strong>STEP IV:</strong>
              </div><strong color="blue">USER CONFIRMATION</strong>
              <ul>
                <li>Wait for the confirmation of your application at the district, federation and conference level.</li>
                <li>You can login anytime to track your membership application status.</li>
                <li>Your activity will turn to green when any of these levels confirms your application.</li>
              </ul>
               

              You shall receive an SMS with an official <strong color="red">MGC PIN</strong> Number when your registration is done.<br>

              <strong color="red">PLEASE ONLY MASTER GUIDES ARE TO APPLY.</strong>

              <br>GOD BLESS YOU<br><br>
              <strong>regards:<br>
              Bismark Frimpong<br>
              Communication Director</strong>
            </td>

           </tr>




           

           

          

        </table>
      ';
      

      /*$html .= '

        <table  cellpadding="2" cellspacing="2" >
         

           <tr>

            <td width="200" align="left" color="red"><b>TOTAL AMOUNT</b></td>
            <td width="200"  color="red"><b>GH</b></td>

           </tr>

           

          

          </table>
      ';*/
      return $html;  
 }

 


 if(isset($_POST["create_pdf"]))  
 {  
      require_once('tcpdf/tcpdf.php');

      $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $pdf->SetCreator(PDF_CREATOR);  
      $pdf->SetTitle("MG APP");

      // set default header data
// $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

     
      $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $pdf->SetDefaultMonospacedFont('helvetica');  
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $pdf->SetMargins(PDF_MARGIN_LEFT, '2', PDF_MARGIN_RIGHT);  
      $pdf->setPrintHeader(false);  
      $pdf->setPrintFooter(false);  
      $pdf->SetAutoPageBreak(TRUE, 10);  
      $pdf->SetFont('helvetica', '', 12);  
      $pdf->AddPage();  
      $content = ''; //pass html tag here <table>
      $content .= '';

      

      $content .= fetch_head();  
      $pdf->writeHTML(fetch_head());

      /*$content .= load_incomes();  
      $pdf->writeHTML(load_incomes());*/

      /*$content .= fetch_deduction();  
      $pdf->writeHTML(fetch_deduction());

      $content .= fetch_departmentIncome();  
      $pdf->writeHTML(fetch_departmentIncome());

      */

      /*$content .= fetch_data();   
      $pdf->writeHTML(fetch_data());*/

      $content .= load_suppliers();  
      $pdf->writeHTML(load_suppliers());

      /*$content .= fetch_othercharges();  
      $pdf->writeHTML(fetch_othercharges());

      $content .= fetch_additionalMaterials();  
      $pdf->writeHTML(fetch_additionalMaterials());*/


      $pdf->Output('ASCG Master Guide Club Official Receipt.pdf', 'I');  
 }  
 ?>


<!DOCTYPE html>  
 <html>  
      <head>  
           <title>MG APP</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  
                
                     <br />  
                     <form method="post">

                          <input type="hidden" name="fullname" id="fullname" placeholder="Income ID">

                          <input type="hidden" name="federation" id="federation" placeholder="Division">

                          <input type="hidden" name="district" id="district" placeholder="Division">

                          <input type="hidden" name="church" id="church" placeholder="Division">

                          <input type="hidden" name="registration_no" id="registration_no" placeholder="Division">

                          <input type="submit" name="create_pdf"  value="Create PDF" id="btnGenerate" style="display: none;" />  

                     </form>  
                </div>  
           </div> 

            <script type="text/javascript">

              document.getElementById("fullname").value = localStorage.getItem("fullname");


              document.getElementById("federation").value = localStorage.getItem("federation");
              document.getElementById("district").value = localStorage.getItem("district");
             document.getElementById("church").value = localStorage.getItem("church");
              document.getElementById("registration_no").value = localStorage.getItem("registration_no");
           document.getElementById("btnGenerate").click();
            //trigger the button click to fetch data immediately the page opens.

          </script>

      </body>  
 </html>  