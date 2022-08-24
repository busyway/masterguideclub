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
  <div  class="quick-actions_homepage">
    <ul class="quick-actions">
          <li> <a href="#"> <i class="icon-dashboard"></i> My Dashboard </a> </li>
          <li> <a href="../accounts"> <i class="icon-shopping-bag"></i>Accounts</a> </li>
          <li> <a href="../district"> <i class="icon-web"></i>District</a> </li>
          <li> <a href="#"> <i class="icon-people"></i>Federation</a> </li>
          <li> <a href="#"> <i class="icon-calendar"></i> Manage Events </a> </li>
        </ul>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12"> 
        <div class="widget-box">
          <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span>
            <h5>Site Analytics</h5>
            <div class="buttons"><a href="#" class="btn btn-mini"><i class="icon-refresh"></i> Update stats</a></div>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span12">
                <div class="chart"></div>
              </div>
            </div></div></div>
      
      </div>
    </div>
    <hr>
    
  </div>
</div>

<?php include __DIR__ . '/footer.php'; ?>




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
