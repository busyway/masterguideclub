<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Maruti Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/maruti-login.css" />

        <style type="text/css">
            .text-danger{
                color: red;
            }
        </style>
        
</head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical">
				 <!-- <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div> -->
                 <img src="ajax-loader.gif" id="loader" style="display: none; ">
                 <div class="control-group normal_text"> <h3>MG App</h3></div>

                <div class="control-group" id="divStaffID">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="Registration Code" id="txtStaffID" onkeypress="clearMsg()"/>
                            <div class="form-control-feedback" id="ErrStaffID"></div>
                        </div>
                    </div>
                </div>
                <div class="control-group" id="divPassword">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="Password" id="txtPassword" onkeypress="clearMsg()"/>
                            <div class="form-control-feedback" id="ErrPassword"></div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <!-- <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-recover">Lost password?</a></span> -->
                    <!-- <span class="pull-right"><input type="submit" class="btn btn-success" value="Login" /></span> -->
                    <!-- <button class="btn btn-success pull-right" id="btnSignIn">Next</button> -->
                    <input type="button" class="btn btn-primary btn-lg btn-block" id="btnSignIn" value="NEXT">
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-inverse" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-info" value="Recover" /></span>
                </div>
            </form>
        </div>
        
        <script src="js/jquery-3.1.1.min.js"></script>
        <!-- <script src="js/jquery.min.js"></script> -->
        <!-- <script src="js/jquery.min.js"></script>   -->
        <script src="js/maruti.login.js"></script> 
    </body>

</html>






<script type="text/javascript">
    $("#divPassword").hide()
    $("#divNewPassword").hide()
    document.getElementById("txtStaffID").focus()

    var STATUS = "";

    function clearMsg() 
    {
        $('#ErrStaffID').html("<span class='text-danger'></span>")
        $('#ErrPassword').html("<span class='text-danger'></span>")
        $('#ErrNewPassword').html("<span class='text-danger'></span>")
        $('#ErrConfirmPassword').html("<span class='text-danger'></span>")
        // document.getElementById("txtStaffID").style.borderColor = "blue";
        // document.getElementById('txtStaffID').classList.toggle('is-invalid');
        document.getElementById('txtStaffID').classList.remove('is-invalid');
        document.getElementById('txtPassword').classList.remove('is-invalid');
    }

    $("#btnSignIn").click(function()
    {
        var staffId = $("#txtStaffID").val(); //this will be use to fetch only staff id
        var loginPassword = $("#txtPassword").val()
        // var loginId = $("#txtStaffID").val()//This will be used to login in with the password. If not it will trigger to fetch staff id again from the submit records.
        userLogin = $("#btnSignIn").val();

        

        if (userLogin == "NEXT" && staffId == "")
        {
            $('#ErrStaffID').html("<span class='text-danger'>Please Enter Staff ID</span>")
            // document.getElementById("txtStaffID").style.borderColor = "red";
            
            document.getElementById('txtStaffID').classList.toggle('is-invalid');

        }
        else if (userLogin == "SIGN IN" && loginPassword == "")
        {
            $('#ErrPassword').html("<span class='text-danger'>Please Enter Login Password</span>")
        }
        else if (userLogin == "SIGN IN" || userLogin == "NEXT")
        {
                $.ajax({
                    url : "submitrecords.php",
                    method : "post",
                    dataType : "json",
                    data : {userLogin, staffId, loginPassword},
                    success :function(data) 
                    {
                        if (data == 100)
                        {
                            $('#ErrStaffID').html("<span class='text-danger'>Invalid Staff ID</span>")
                            document.getElementById('txtStaffID').classList.toggle('is-invalid');
                            document.getElementById("txtStaffID").focus()
                        }
                        else if(data == 200)
                        {
                            document.getElementById('txtStaffID').classList.toggle('is-valid');
                            $("#btnSignIn").val('SIGN IN')
                            $("#divPassword").show('')
                            // $("#divStaffID").hide('')
                            document.getElementById("txtPassword").focus()
                            
                        }
                        else if(data == 300)
                        {
                            document.getElementById('txtPassword').classList.toggle('is-invalid');
                            $('#ErrPassword').html("<span class='text-danger'>Invalid Password</span>")
                            document.getElementById("txtPassword").focus()
                            
                        }
                        else
                        {
                            localStorage.setItem("USER_ID", staffId);
                            localStorage.setItem("USER_STATUS", data.status)
                            // localStorage.setItem("USER_LNAME", data.othername)
                            // localStorage.setItem("USER_FNAME", data.firstname)
                            // localStorage.setItem("USER_PIC", data.userPic)

                            STATUS = data.status;

// alert(STATUS)
                            /*if (loginPassword == "123")
                            {
                                $("#divPassword").hide('')
                                $("#divNewPassword").show('')
                                $("#btnSignIn").val('CREATE PASSWORD')
                                document.getElementById("txtNewPassword").focus()
                            }
                            else
                            {*/

                                if (data.status == "Admin" || data.status == "SuperAdmin")
                                {
                                    window.open('admin/index.php', '_self')
                                }
                                else if (data.status == "member")
                                {
                                    window.open('membership/index.php', '_self')
                                }
                                else if (data.status == "treasure")
                                {
                                    window.open('accounts/index.php', '_self')
                                }
                               
                            // }
                            
                            
                            
                        }
                    }
                })
            
        }

        else if (userLogin == "CREATE PASSWORD")
        {
            loginPassword = $("#txtNewPassword").val();
            confirmpassword = $("#txtConfirmPassword").val();

            if (loginPassword == "")
            {
                $('#ErrNewPassword').html("<span class='text-danger'>Enter New Password</span>")
            }
            else if (confirmpassword == "")
            {
                $('#ErrConfirmPassword').html("<span class='text-danger'>Confirm Password</span>")
            }

            else if (loginPassword != confirmpassword)
            {
                $('#ErrConfirmPassword').html("<span class='text-danger'>Password Mismatch !!!!!</span>")
                return
            }
            else
            {
                $.ajax({
                    url : "submitrecords.php",
                    method : "post",
                    dataType : "json",
                    data : {userLogin, staffId, loginPassword},
                    beforeSend: function()
                    {
                        $("#loader").show();
                    },
                    complete:function() {
                        $("#loader").hide();
                    },
                    success :function(data) 
                    {
                        alert(data);
                        // Redirecting user to page


                        if (STATUS == "Admin" || STATUS == "SuperAdmin")
                        {
                            window.open('admin/index.php', '_self')
                        }
                        else if (STATUS == "Sales Person")
                        {
                            window.open('salesperson/index.php', '_self')
                        }
                        /*else if (STATUS == "Doctor")
                        {
                            window.open('doctor', '_self')
                        }
                        else if (STATUS == "Massage")
                        {
                            window.open('massage', '_self')
                        }
                        else if (STATUS == "Store")
                        {
                            window.open('pharmacy', '_self')
                        }
                        else if (STATUS == "Admin")
                        {
                            window.open('admin', '_self')
                        }*/
                    }
                })
            }
            
        }

        
    })

    $("#txtStaffID, #txtPassword, #txtNewPassword, #txtConfirmPassword").keypress(function(e)
    {
        if (e.which == 13)
        {
            document.getElementById("btnSignIn").click()
        }
    })


</script>