<?php include "connection.php" ?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>ASCG Master Guide Club</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/colorpicker.css" />
<link rel="stylesheet" href="css/datepicker.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/maruti-style.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />
</head>
<body>



<div id="content">
  <div id="content-header">
    <h1>ASCG MASTER GUIDE CLUB</h1>
    <h1>MEMBERSHIP REGISTRATION</h1>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Personal-info</h5>
            <a href="https://ascgmasterguideclub.com/index.php" class=" btn btn-primary">Back Home</a>
          </div>
          <div class="widget-content nopadding">
            <form action="#" method="get" class="form-horizontal">
              <div class="control-group">
                <label class="control-label">Full name :</label>
                <div class="controls">
                  <input type="text" class="span11" id="txtFullname" class="form-control" oninput="this.value = this.value.toUpperCase()">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Contact</label>
                <div class="controls">
                  <input type="text" class="span11" id="txtContact" class="form-control">
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Church</label>
                <div class="controls">
                  <select class=" span11 js-example-basic-single w-100 form-control" id="cmbChurches" style="text-transform:uppercase">
                          <option value="">Select Church</option>
                            <?php 
                            // $sql_class = "SELECT * FROM medicine";
                            $sql_class = "SELECT * FROM `churches` order by church ASC";
                            $class_data = mysqli_query($conn,$sql_class);
                            while($row = mysqli_fetch_assoc($class_data))
                            {
                              $churchCode = $row['church_code']; 
                              $churchname = $row['church']; // this is been displayed in the combobox // Option
                              echo "<option value='".$churchCode."' >".$churchname."</option>";
                            }
                            ?>
                          </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">District</label>
                <div class="controls">
                  <input type="text" class="span11" id="txtDistrict" class="form-control" readonly="" style="background-color: white">
                  <div style="color: blue" id="divLoadDistrict">Loading District .....</div>
                            <input id="txtcode" type="hidden">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Federation</label>
                <div class="controls">
                  <input type="text" class="span11" id="txtFederation" class="form-control" readonly="" style="background-color: white">
                  <div style="color: red" id="divLoadFederation">Loading Federation ....</div>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">District Code</label>
                <div class="controls">
                  <input type="text" class="span11" id="txtDistrictCode" class="form-control">
                  <div style="color: red">Contact your district / local youth leader.</div>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Registration Code</label>
                <div class="controls">
                  <input type="text" class="span11" id="txtRegisterCode" class="form-control">
                  <div style="color: red">Please use your registration code as reference number when paying the registration fee.</div>
                  <div>Momo No. : 0245 25 23 55 <br>Momo Name: Prince Owusu Takyi</div>
                  <div id="divRefrence"></div>
                </div>
              </div>

              

              <div class="form-actions">
                <div id="divMessage" style="color: red; font-size: 12pt">Submitting .....</div>
                <button type="submit" class="btn btn-success" id="btnSubmit">Submit</button>
                
              </div>
            </form>
          </div>
        </div>
      </div>
      
    </div><hr>
   
  </div>
</div>
</div>
<div class="row-fluid">
  <div id="footer" class="span12"> 2012 &copy; ASCG Master Guide Club. Brought to you by <a href="http://themedesigner.in">BusyWay Tech</a> </div>
</div>
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/bootstrap-colorpicker.js"></script> 
<script src="js/bootstrap-datepicker.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/maruti.js"></script> 
<script src="js/maruti.form_common.js"></script>
<script src="js/jquery-3.1.1.min.js"></script>
</body>
</html>




<script type="text/javascript">

  
  var localChurch = ""
   $("#divMessage").hide()

 $("#divLoadFederation, #divLoadDistrict").hide()


  $("#cmbChurches").change(function()
  {

      selectChurch = $("#cmbChurches").val();
      localChurch = $("#cmbChurches option:selected").text();
      $("#divLoadFederation, #divLoadDistrict").show()
         
      $.ajax({
        url :"submitrecords.php",
        method : "post",
        dataType : "json",
        data : {selectChurch},
        success : function(data)
        {
          $("#txtDistrict").val(data.district)
          $("#txtFederation").val(data.federation)
          $("#txtcode").val(data.district_code)
          countApplicants()


          localStorage.setItem("federation", data.federation)
          localStorage.setItem("district", data.district)
          localStorage.setItem("church", localChurch.toUpperCase())

          $("#divLoadFederation, #divLoadDistrict").hide()
          
        }
      })


    })

    function countApplicants()
    {
      countApplicant = $("#cmbChurches").val();

      $.ajax({
        url :"submitrecords.php",
        method : "post",
        dataType : "json",
        data : {countApplicant},
        success : function(data)
        {
          totalRecords = data
          today = new Date();
        time = today.getSeconds()

          $("#txtRegisterCode").val("MGR"+countApplicant +""+data+""+time)
          document.getElementById("divRefrence").innerHTML = "Reference No. " + "MGR"+countApplicant +""+data+""+time
         
        }
      })
    }

    $("#btnSubmit").click(function(e)
    {e.preventDefault()
      districtCode = $("#txtcode").val();
      code = $("#txtDistrictCode").val();
      federation = $('#txtFederation').val();
      fullname = $("#txtFullname").val();
      contact = $("#txtContact").val()
      newApplicant = $("#txtRegisterCode").val()
      church_code = $("#cmbChurches").val()

      

      if (fullname == "")
      {
        // alert("Enter Fullname")
        $("#txtFullname").focus()
      }
      else if (contact == "")
      {
        // alert("Enter Contact")
        $("#txtContact").focus()
      }
      else if (church_code == "")
      {
        $("#cmbChurches").focus()
      }

      else if (code == "")
      {
        // alert("Enter District Code")
        $("#txtDistrictCode").focus()
      }

      else if (districtCode != code)
      {
        alert("invalid code entered")
      }
      else
      {
        $("#divMessage").show()
        $.ajax({
            url :"submitrecords.php",
            method : "post",
            // dataType : "json",
            data : {fullname, contact, newApplicant, church_code, districtCode, federation},
            success : function(data)
            {
              $("#divMessage").hide()
              if (data == 200)
              {
                alert("Sorry, your registration has already being received. Contact 0553090807 for any information")
              }
              else
              {
                localStorage.setItem("fullname", fullname)
                localStorage.setItem("registration_no", newApplicant)
           
                alert(data)
                
                $("#txtcode").val();
                $("#txtDistrictCode").val('');
                $("#txtFullname").val('');
                $("#txtContact").val('')
                $("#txtRegisterCode").val('')
                $("#cmbChurches").val('')

                window.open("official_receipt.php")
              }
               

            }
          })
      }
    })
</script>