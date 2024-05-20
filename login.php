<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <title>Document</title>

    <style>
        label{
            font-size:19px;
        }

        .error{
            color:#ff0000;
            font-size: 16px;
        }
        /* .bi-eye{
            border-right:none;

        } */
        
    </style>
</head>
<body>
     <?php
       // include 'header.html';

    ?> 

    <div class="container d-flex " style="margin-top: 50px; ">
      
        <img src="img\Signin.svg" class="img-fluid w-50 d-none d-sm-block"  alt="">
        
        <div class="container d-flex  justify-content-center my-auto " >
            <form action="form2.php" id="login" method="post">
                <h1 class="mb-3 " >Login to Shopping  </h1>

                <div class=" mb-3 form-group"> 
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email"  class="form-control border-dark">
                </div>

               
                <div class="mb-3 form-group ">
    <label for="password" class=" form-label">Password:</label>
        <div class="input-group">
            <input type="password" id="password" name="password" class="form-control border-dark">
            <span class="btn btn-outline-secondary" style="background:#76ABAE;color:white;" id="togglePassword">
                <i class="bi bi-eye"></i>
    </span>
            <!-- <i class="bi bi-eye btn btn-outline-secondary"  id="togglePassword"></i> -->
        </div>
    </div>

                <button type="submit" class=" btn input-group my-2" name ='login' style="background-color:#31363F; color:#fff;">Login</button>

                <div class="login">Don't have an account? <a href="signup.php">signUp</a></div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            
            $.validator.addMethod("pwdcheck",function(value,element){
                return /^[A-Za-z0-9\d=!\-@._*]{10}$/.test(value);
            },"Password must contain at least one capital letter, one small letter, one numeric character, one special character");
        
           
            
            $('#togglePassword').click(function(){
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');
            if(passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).find('i').removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $(this).find('i').removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });
        });

        $("#login").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    pwdcheck:true
                }
            },
            messages: {
                email: {
                    required :"Please enter an email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter a password"
                }
            },
                    errorPlacement: function(error, element) {
            if (element.attr("name") === "password") {
                error.insertAfter(element.closest(".input-group"));
            } else {
                error.insertAfter(element);
            }
        },

            submitHandler:function(form) {
                form.submit();
            }
        });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
