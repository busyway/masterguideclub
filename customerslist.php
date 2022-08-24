<?php
 
 function fetch_head()  
 {    
      //Declear variables
      //the $_POST[""] is the textbox name not the id.

      // $meetingcode = $_POST["txtConferenceTithe"];


      /*$incomeid = $_POST["txtIncomeID"];
      $division = $_POST["txtDivision"];*/

      
      $html = '';

       $connect = mysqli_connect("localhost", "root", "", "easysales", 3308); 

      
       $sql = "SELECT * FROM  companyregistration  "; 

      $result = mysqli_query($connect, $sql);

      while($row = mysqli_fetch_array($result))  
      {        
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
               <img src="'.$row["logo"].'" border="0" height="90" width="90"/>
              <th colspan="9" align="center"></th>

            </tr>

            


            <tr> 
             
              <th colspan="7" align="center"><h2 color="blue">'.$row["company"].'</h2> </th>
            </tr>

            <tr>
              <th colspan="7" align="center"><h3><strong color="red">Location : '.$row["location"].'</strong></h3></th>
            </tr>
            
            <tr>
              <th colspan="7" align="center"> <strong color="blue">Box : </strong>'.$row["address"].'</th>
             
            </tr>

            <tr>
              <th colspan="7" align="center"> <strong color="blue">Contact : </strong>'.$row["contact"].'</th>
             <hr>
            </tr>
            
        </table>

              ';  
      }  
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

            <th colspan="9" align="center"><b>CUSTOMERS LIST</b></th>

           </tr>

           <tr>
           <td colspan="1" align="center">No</td>
           <td colspan="2" align="center"> CODE </td>
           <td colspan="3" align="center">CUSTOMERS</td>
           <td colspan="3"align="center">CONTACT</td>
           </tr>

           

          

        </table>
      ';
      $sql = "SELECT * from  customers ";

      $result = mysqli_query($connect, $sql);

      while($row = mysqli_fetch_array($result))  
      {       
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
       
    }
      </style>

     

          


            
         <table  cellpadding="2" cellspacing="2" border="1">
         
           <tr>

             <td  colspan="1" align="center">'.$count.'</td>
             <td  colspan="2" align="center">'.$row["customerid"].'</td>
             <td  colspan="3" align="left">'.$row["fullname"].' </td>
             <td  colspan="3" align="left">'.$row["contact"].'</td>
           </tr>




          </table>

              '; 
              $count++; 
      }

     /* $html .= '

        <table  cellpadding="2" cellspacing="2" >
         

           <tr>

            <td width="200" align="left" color="red"><b>TOTAL AMOUNT</b></td>
            <td width="200"  color="red"><b>GH '.$totalCharges.'</b></td>

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
      $pdf->SetTitle("Easysales - Customers List");

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
      $pdf->writeHTML(fetch_additionalMaterials());
*/


      $pdf->Output('Customers List.pdf', 'I');  
 }  
 ?>


<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Sanitas - Patient List</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:700px;">  
                
                     <br />  
                     <form method="post">

                          <input type="hidden" name="txtstudentid" id="txtstudentid" placeholder="Income ID">

                          <input type="hidden" name="txtPaymentMode" id="txtPaymentMode" placeholder="Division">

                          <input type="hidden" name="txtstudentclass" id="txtstudentclass" placeholder="Division">

                          <input type="hidden" name="txtTotalCompulsory" id="txtTotalCompulsory" placeholder="Division">

                          <input type="hidden" name="txtTotalOther" id="txtTotalOther" placeholder="Division">

                          <input type="submit" name="create_pdf"  value="Create PDF" id="btnGenerate" style="display: none;" />  

                     </form>  
                </div>  
           </div> 

            <script type="text/javascript">

              document.getElementById("txtstudentid").value = localStorage.getItem("stu_id");


              document.getElementById("txtPaymentMode").value = localStorage.getItem("paymode");
              document.getElementById("txtstudentclass").value = localStorage.getItem("studentlevel");
             document.getElementById("txtTotalCompulsory").value = localStorage.getItem("totalCompulsory");
              document.getElementById("txtTotalOther").value = localStorage.getItem("totalOther");
           document.getElementById("btnGenerate").click(); //trigger the button click to fetch data immediately the page opens.

          </script>

      </body>  
 </html>  