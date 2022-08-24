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
                  <input type="text" class="span11" placeholder="Enter Registration Code" id="txtRegistrationCode" />
                </div>
                
              </div>
              <div class="control-group">
                <label class="control-label">Fullname :</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="Fullname" id="txtFullname" readonly="" style="background-color: white" />
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
                  <input type="text" class="span11" placeholder="Company name" id="txtContact" readonly="" style="background-color: white" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Amount</label>
                <div class="controls">
                  <input type="text" class="span11" id="txtAmount" placeholder="Enter Amount Paid" /> </div>
              </div>
              <!-- <div class="control-group">
                <label class="control-label">Message</label>
                <div class="controls">
                  <textarea class="span11" ></textarea>
                </div>
              </div> -->
              <div class="form-actions">
                <button type="submit" class="btn btn-success" id="btnApprove">APPROVED PAYMENT</button>
              </div>
            </form>
          </div>
        </div>
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


<script type="text/javascript">
  


    /*$("#btnSearch").click(function()
    {
      searchApplicants = $("#txtRegistrationCode").val();

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
            $("#txtAmount").val('30')
          }
        })
    })*/

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
      paymentApproved = $("#txtRegistrationCode").val();
      fullname = $("#txtFullname").val();
      church = $("#txtChurch").val();
      contact = $("#txtContact").val()
      amount = $("#txtAmount").val()

     
      if (fullname == "")
      {
        alert("No Records Found")
      }
      else if (amount == "")
      {
        alert("Enter Amount")
      }
      else
      {
        $.ajax({
            url :"submitrecords.php",
            method : "post",
            data : {paymentApproved, fullname, church, contact, amount},
            success : function(data)
            {
              alert(data)
            }
          })
      }
    })
</script>
