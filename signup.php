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

         /* .input-group-eye {
            position: relative;
             background: transparent; 
        }  */

        /* .input-group-eye .bi {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            background:transparent;
        }

        .input-group-eye input[type="password"] {
            padding-right: 30px; /* Adjust as needed 
        }*/
    </style> 
</head>
<body>
    <?php
        // include 'header.html';
    ?>

    <div class="container d-flex " style="margin-top: 50px;">
      
        <img src="img\Login.svg" class="img-fluid w-50 d-none d-sm-block" alt="">
        
        <div class="container d-flex  justify-content-center my-auto " >
            <form action="form1.php" id="signin" method="post">
                <h1 class="mb-3">Create Your Account</h1>

                <div class="mb-3 form-group"> 
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control border-dark">
                </div>

                <div class="mb-3 form-group"> 
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email"  class="form-control border-dark">
                </div>

                <div class="mb-3 form-group">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="tel" class="form-control border-dark" name="phoneNumber">
                </div>

                <div class="mb-3 form-group"> 
                    <label for="password" class="form-label">Password:</label>
                    <div class="input-group ">
                        <input type="password" id="password" name="password" class="form-control border-dark">
                        <span class="input-group-text bi bi-eye btn btn-outline-secondary" style="background:#76ABAE;color:white;" id="togglePassword"></span>
                        
                    </div>
                </div>

                <div class="mb-3 form-group"> 
                    <label for="cpassword" class="form-label">Confirm Password:</label>
                    <div class="input-group ">
                        <input type="password" id="cpassword" name="cpassword" class="form-control border-dark">
                        <span class="input-group-text bi bi-eye btn btn-outline-secondary" style="background:#76ABAE;color:white;"id="toggleConfirmPassword"></span>
                       
                          </div>
                </div>

                <button type="submit" class="btn input-group my-2" name="submit" style="background-color:#31363F; color:#fff;">Submit</button>

                <div class="login">Already have an account? <a href="login.php">Login</a></div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            console.log("jQuery is working!");
            jQuery.validator.addMethod("noSpace", function(value,element) {
                console.log("name was validated");
                    return /^(?! )[\p{L} .]+$/u .test(value);
              
            },"Name can only contain alphabet characters, spaces, and periods.");

            $.validator.addMethod("pwdcheck",function(value,element){
                return /^[A-Za-z0-9\d=!\-@._*]{10}$/.test(value);
            },"Password must contain at least one capital letter, one small letter, one numeric character, one special character");
           
       
            // Function to toggle password visibility
            $('#togglePassword, #toggleConfirmPassword').click(function(){
                var field = $(this).closest('.input-group').find('input');
                var fieldType = field.attr('type');
                field.attr('type', fieldType === 'password' ? 'text' : 'password');
                $(this).toggleClass('bi-eye bi-eye-slash');
            // });   
        }),
           
      

            // Validation
            $("#signin").validate({
                rules: {
                    name: {
                        required: true,
                        noSpace:true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phoneNumber:{
                        required:true,
                        number:true,
                        minlength:10,
                        maxlength:10
                    },
                    password: {
                        required: true,
                        pwdcheck:true
                    },
                    cpassword: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a name"
                    },
                    email: {
                        required: "Please enter an email address",
                        email: "Please enter a valid email address"
                    },
                    phoneNumber: {
                        required: "Please enter your phone number",
                        number: "Only numbers should be allowed",
                        minlength: "Mobile Number should be 10 digits",
                        maxlength: "Mobile Number should be 10 digits"
                    },
                    password: {
                        required: "Please enter a password"
                    },
                    cpassword: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    }
                },
// errorPlacement: function(error, element) {
//     if (element.attr("id") === "password" || element.attr("id") === "cpassword") {
//         error.insertAfter(element.closest(".form-group").find(".input-group"));
//     } else {
//         error.insertAfter(element);
//     }
// },

errorPlacement: function(error, element) {
    if (element.attr("id") === "password" || element.attr("id") === "cpassword") {
        error.insertAfter(element.closest(".input-group"));
    } else {
        error.insertAfter(element);
    }
},
              submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
