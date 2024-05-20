<?php
include ('config/db.php');
if (isset($_SESSION['adminid'])!='') {
  header("Location: index.php"); 
  exit();
}
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $det=$conn->query("SELECT * FROM admininfo WHERE emailid = '$email' AND password ='$password'");
    if ($det->num_rows == 1) {
        $adminDetails=$det->fetch_assoc();
         $_SESSION['adminid']=$adminDetails['adminid'];
          header("Location: index.php");
    } else {
        echo '<script>alert("Wrong Email or Password");</script>';
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <style>
      .container{
        background:#0E0220;
        border-radius: 15px;
        position: relative;
        margin-top: 10%;
        color:#E40475;
        padding:10px;
        box-shadow: rgba(228, 4, 117, 0.5) 0px 22px 70px 4px;
    }
    a{
      color:#D7FBF6;
    }
    .bi-eye-fill{
        position: absolute;
        top:28%;
        right:4%;
        cursor:pointer;
    }
    .background-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("assets/img/bg.jpg");
            background-size: cover;
            background-repeat: no-repeat;
             filter: blur(0px); 
        }
        .btn{
          background-color:#48E0E4;
        }
        .btn:hover{
          background-color:#E40475;
          color:#48E0E4;
        }
        h2{
          color:#48E0E4;
        }
        .error-message{
            color:red;
        }
    </style>
  </head>
  <body>
  <div class="background-container"></div>
    <div class="container col-lg-4 col-md-5 col-sm-3 text-center">
      <h2> ADMIN LOGIN</h2>
       <form method="post" id="login">    
          <div class="form-floating mb-3 mt-5">
            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
            <label for="email">Email address</label>
            <div class="error-message" id="email-error"></div>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            <label for="password">Password</label>
            <div class="error-message" id="password-error"></div>
            <i class="bi bi-eye-fill toggle-icon" data-target="password"></i>
          </div>
            <button type="submit" class="btn px-4 py-2 mb-3 mt-4"name="submit">Login</button>
        </form>
    </div>
  </body> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  
  <script>
    document.querySelectorAll('.toggle-icon').forEach(icon => {
        icon.addEventListener('click', function () {
            const targetId = this.dataset.target;
            const passwordField = document.querySelector(`#${targetId}`);
            
            this.classList.toggle("bi-eye-slash-fill");
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);
        });
    });

    $(document).ready(function() {
      $("#login").validate({
      rules: {
                    email: {
                        required: true
                    },
                    password:{
                      required:true
                    }
                  },
      messages:{
        email:{
          required:"Please Enter Email"
        },
        password:{
          required:"Please Enter Password"
        }
      },
      errorPlacement: function (error, element) {
                    var fieldId = element.attr("id");
                    error.appendTo(`#${fieldId}-error`); 
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
</script>

</html>