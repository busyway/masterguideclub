<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: ../login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include __DIR__ . '/links.php'; ?>
  <?php include "../db.php" ?>

 

</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">MG APP</a></h1>
</div>

<?php include __DIR__ . '/header.php'; ?>

<?php include __DIR__ . '/sidebar.php'; ?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span8">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>New Applicants</h5>
          </div>
          <div class="widget-content nopadding">
            <!-- <button id="btnSearch">Search</button> -->
            <form  class="form-horizontal">
              <div class="control-group">
                <label class="control-label">Registration Code :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Enter Registration Code" id="txtRegistrationCode" readonly="" style="background-color: white" />
                </div>
                
              </div>
              <div class="control-group">
                <label class="control-label">Fullname :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Fullname" id="txtFullname"  style="background-color: white" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Church : </label>
                <div class="controls">
                  <input type="text"  class="span11" placeholder="Enter Password" id="txtChurch" readonly="" style="background-color: white"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Contact :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Company name" id="txtContact"  style="background-color: white" />
                </div>
              </div>
              <!-- <div class="control-group">
                <label class="control-label">Contact :</label>
                <div class="controls">
                  
                </div>
              </div> -->
              <!-- <div class="control-group">
                <label class="control-label">Edit Church</label>
                <div class="controls">
                  <select class="js-example-basic-single w-100 form-control span11" id="cmbChurches">
                    <option value="">Select Church</option>
                          <?php 
                          $sql_class = "SELECT * FROM `churches` order by church ASC";
                          $class_data = mysqli_query($conn,$sql_class);
                          while($row = mysqli_fetch_assoc($class_data))
                          {
                            $churchCode = $row['church_code']; 
                            $churchname = $row['church']; 
                            echo "<option value='".$churchCode."' >".$churchname."</option>";
                          }
                    ?>
                  </select>
                </div>
              </div> -->
              

              <!-- <div class="control-group">
                <label class="control-label">Message</label>
                <div class="controls">
                  <textarea class="span11" ></textarea>
                </div>
              </div> -->
              <div class="form-actions">
                <button type="submit" class="btn btn-success" id="btnApprove">UPDATE RECORDS</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="span4">
        <form action="javascript:void(0)" method="post" id="ajax-form">
          <input type="hidden" class="span11" placeholder="Enter Registration Code" id="txtRegister" name="txtRegister"/><br><br>
          <!-- <img src="../images/gallery/imgbox3.jpg" alt="avatar" style="border-radius: 50% 50% 50% 50%; width: 150px; height: 150px" id="testPreview"> -->
          <div id="loadimage"></div>
          <div class="control-group">
            <div class="span8">
              <!-- <label class="control-label">File upload input</label> -->
              <div class="controls">
              <input type="file" id="image" name="image" onchange="doTest()"/>
              </div>
            </div>
            <div class="span2"><br>
              <button class=" btn btn-primary" type="submit" id="btnUpload">UPLOAD</button>
            </div>
                  
          </div>
        </form>
      </div>
    </div><hr>
    
  </div>


</div>

<?php include __DIR__ . '/footer.php'; ?>

<!-- <script src="jquery-3.1.1.min.js"></script>
  <script src="jquery.min.js"></script> -->


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>

</html>


<script> //student and parent picture upload

  if (window.FileReader) 
  {
    
      var reader = new FileReader(), rFilter = /^(image\/bmp|image\/cis-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x-cmu-raster|image\/x-cmx|image\/x-icon|image\/x-portable-anymap|image\/x-portable-bitmap|image\/x-portable-graymap|image\/x-portable-pixmap|image\/x-rgb|image\/x-xbitmap|image\/x-xpixmap|image\/x-xwindowdump)$/i; 
      
      reader.onload = function (oFREvent) 
      { 
        testPrev = document.getElementById("testPreview")
        testPrev.src = oFREvent.target.result;
        testPreview.style.display = "block"; 
      };  
  
      function doTest() 
      {
        
        if (document.getElementById("image").files.length === 0) 
          { 
            return; 
          }  
        var file = document.getElementById("image").files[0]; // Declear Variable for file 
        //validate file size
        var fsize = file.size||file.fileSize;
        if(fsize > 2000000)
        {
         alert("Maximum picture is 2MB. Please reduce the picture size and upload it again.");
         $('#image').val('');
         upload = document.getElementById("btnUpload");
            upload.style.display = "none"; 
         return false;
        }



      //Add file if OK.
      if (!rFilter.test(file.type)) 
      { 
        alert("select a valid image file!"); 
        $('#image').val('');

        upload = document.getElementById("btnUpload");
            upload.style.display = "none"; 
        return; 
        
      }


        reader.readAsDataURL(file);
        upload = document.getElementById("btnUpload");
        upload.style.display = "block";
    
      }
    
      
  } 
  else 
  {
    alert("FileReader object not found :( \nTry using Chrome, Firefox or WebKit");
  }



  $(document).ready(function()
  {
  
 
   $('#ajax-form').submit(function(event)
   {
    
     upload = document.getElementById("btnUpload");

      //Validate if records have be found
      if(document.getElementById("txtRegistrationCode").value == "")
      {
        alert("No records found. Fail to upload");
        return;
      }


    
     // Validate picture size

        /*var myImg = document.querySelector("#testPreview");

        var realWidth = myImg.naturalWidth;

        var realHeight = myImg.naturalHeight;*/

        /*if (realWidth != 220 || realHeight != 220) 
        {
          swal("Picture size is = " + realWidth +"×"+ realHeight + " Change it to 220 × 220");
          return;
        }*/

        //validation ends

        


    event.preventDefault();
    
      $.ajax({

     type: "POST",
       url:"uploadPIc",
       //method:"POST",
       data:new FormData(this),
       contentType:false,
       processData:false,
       success:function(data)
       {
      //swal("Successfull",data, "success"); 
        alert(data);
    
      // image.style.display = "none";

      /*upload.style.display = "none";
      document.getElementById("testPreview").style.display = "none";
      $("#image").val('');
*/
        loadPic();
       
       }
     
      });

   });

  });



 
</script>


<script type="text/javascript">
  $("#btnUpload").hide()
  searchRecords()

  function searchRecords()
  {
      searchApplicants = localStorage.getItem("USER_ID");
      $.ajax({
          url :"submitrecords.php",
          method : "post",
          dataType : "json",
          data : {searchApplicants},
          success : function(data)
          {
              $("#txtFullname").val(data.fullname)
              $("#txtChurch").val(data.church)
              $("#txtContact").val(data.contact)
              $("#txtRegistrationCode").val(data.registration_code)
              $("#txtRegister").val(data.registration_code)
            loadPic()
            
          }
        })
  }

  function loadPic() 
  {
    //Load student, picture
      var records = "";
      var loadimage = $("#txtRegistrationCode").val();
      
        $.ajax({
          url: "submitrecords.php", 
          method: "post", 
          //dataType : "json",
          data : {loadimage:loadimage},

          success: function(data)
          {
            // alert(data);
            $("#loadimage").html(data); 
          }
        });
  }

  $("#txtRegistrationCode").keypress(function(e)
  {
    
    if (e.which == 13)
    {e.preventDefault()
      searchApplicants = $("#txtRegistrationCode").val();

        $.ajax({
          url :"submitrecords.php",
          method : "post",
          dataType : "json",
          data : {searchApplicants},
          success : function(data)
          {
            if (data == 300)
            {
              alert("Member has already make payment")
            }
            else if (data == 100)
            {
              alert("Registration code not found")
            }
            else
            {
              $("#txtFullname").val(data.fullname)
              $("#txtChurch").val(data.church)
              $("#txtContact").val(data.contact)
              $("#txtAmount").val('30')
            }
            
          }
        })
    }
  })

  $("#btnApprove").click(function(e)
  {
      e.preventDefault()

      updateApplication = $("#txtRegistrationCode").val();
      fullname = $("#txtFullname").val();
      church = $("#txtChurch").val();
      contact = $("#txtContact").val()
      amount = $("#txtAmount").val()

     
      if (fullname == "")
      {
        alert("Enter Fullname")
      }
      else if (contact == "")
      {
        alert("Enter Contact")
      }
      else
      {
        $.ajax({
            url :"submitrecords.php",
            method : "post",
            data : {updateApplication, fullname, church, contact, amount},
            success : function(data)
            {
              alert(data)
            }
          })
      }
  })
</script>
