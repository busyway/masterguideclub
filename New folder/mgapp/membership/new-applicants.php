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

  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #474e5d;
      font-family: Helvetica, sans-serif;
    }

    /* The actual timeline (the vertical ruler) */
    .timeline {
      position: relative;
      max-width: 1200px;
      margin: 0 auto;
    }

    /* The actual timeline (the vertical ruler) */
    .timeline::after {
      content: '';
      position: absolute;
      width: 6px;
      background-color: white;
      top: 0;
      bottom: 0;
      left: 50%;
      margin-left: -3px;
    }

    /* Container around content */
    .container {
      padding: 10px 40px;
      position: relative;
      background-color: inherit;
      width: 50%;
    }

    /* The circles on the timeline */
    .container::after {
      content: '';
      position: absolute;
      width: 25px;
      height: 25px;
      right: -17px;
      background-color: red;
      border: 4px solid red;
      top: 15px;
      border-radius: 50%;
      z-index: 1;
    }

    /* Place the container to the left */
    .left {
      left: 0;
    }

    /* Place the container to the right */
    .right {
      left: 50%;
    }

    /* Add arrows to the left container (pointing right) */
    .left::before {
      content: " ";
      height: 0;
      position: absolute;
      top: 22px;
      width: 0;
      z-index: 1;
      right: 30px;
      border: medium solid white;
      border-width: 10px 0 10px 10px;
      border-color: transparent transparent transparent white;
    }

    /* Add arrows to the right container (pointing left) */
    .right::before {
      content: " ";
      height: 0;
      position: absolute;
      top: 22px;
      width: 0;
      z-index: 1;
      left: 30px;
      border: medium solid white;
      border-width: 10px 10px 10px 0;
      border-color: transparent white transparent transparent;
    }

    /* Fix the circle for containers on the right side */
    .right::after {
      left: -16px;
    }

    /* The actual content */
    .content {
      padding: 20px 30px;
      background-color: white;
      position: relative;
      border-radius: 6px;
    }

    /* Media queries - Responsive timeline on screens less than 600px wide */
    @media screen and (max-width: 600px) {
      /* Place the timelime to the left */
      .timeline::after {
      left: 31px;
      }
      
      /* Full-width containers */
      .container {
      width: 100%;
      padding-left: 70px;
      padding-right: 25px;
      }
      
      /* Make sure that all arrows are pointing leftwards */
      .container::before {
      left: 60px;
      border: medium solid white;
      border-width: 10px 10px 10px 0;
      border-color: transparent white transparent transparent;
      }

      /* Make sure all circles are at the same spot */
      .left::after, .right::after {
      left: 15px;
      }
      
      /* Make all right containers behave like the left ones */
      .right {
      left: 0%;
      }
    }
  </style>

</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">MG APP</a></h1>
</div>

<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/sidebar.php'; ?>


<!-- <div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>

  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>New Applicants</h5>
          </div>
          
        </div>
      </div>
    </div><hr>
    
  </div>


</div> -->

<div class="container-fluid">
  <div class="row-fluid"><br><br>
    <div class="timeline">
      <div class="container left">
        <div class="content">
          <h3 style="color: red">CONFERNCE PENDING</h3>
          <p style="color: blue"><h4>Waiting For Conference Approval</h4></p>
        </div>
      </div>
      
      <div class="container left">
        <div class="content">
          <h3 style="color: red">FEDERATION PENDING</h3>
          <p style="color: blue"><h4>Waiting For Federation Approval</h4></p>
        </div>
      </div>
        
      <div class="container left">
        <div class="content">
          <h3 style="color: red">DISTRICT PENDING</h3>
          <p style="color: blue"><h4>Waiting For District Approval</h4></p>
        </div>
      </div>
      
    </div>
  </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>

<!-- <script src="jquery-3.1.1.min.js"></script>
  <script src="jquery.min.js"></script> -->


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
