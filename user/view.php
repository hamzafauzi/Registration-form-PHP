<?php

include "conn.php";



if(isset($_POST['submit'])){
    $name= $_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $file=$_FILES['file']['name'];
    $temp_name= $_FILES['file']['tmp_name'];
   
   


    $sql= "insert into `users`(name,email,password,picture) 
    values('$name', '$email', '$phone','$file')";
    $result= mysqli_query($con, $sql);
    if($result){
     echo "Data inserted"; 
     echo "</br>";
     echo "Name:" ;echo $name;
     echo "</br>";   
     echo "Email:"; echo $email;
     echo "</br>";
     echo "Mobile number:"; echo $phone;
     echo "</br>";
     echo "Profile Picture:"; echo $file;
    
        move_uploaded_file($temp_name,"images/$file");

    }else{
        die(mysqli_error($conn));
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $("#registration-form").submit(function(event) {
                // Validate name
                var name = $("#name").val().trim();
                if (name.length < 3) {
                    $("#name-error").text("Name must be at least 3 characters long.");
                    event.preventDefault();
                } else {
                    $("#name-error").text("");
                }
                
                // Validate email
                var email = $("#email").val().trim();
                if (!isValidEmail(email)) {
                    $("#email-error").text("Invalid email address.");
                    event.preventDefault();
                } else {
                    $("#email-error").text("");
                }
                
                // Validate phone number
                var phone = $("#phone").val().trim();
                if (!isValidPhone(phone)) {
                    $("#phone-error").text("Invalid phone number.");
                    event.preventDefault();
                } else {
                    $("#phone-error").text("");
                }

                // Validate file upload
                var file = $("#file").val();
                if (file.length > 0) {
                    var fileSize = $("#file")[0].files[0].size;
                    var maxSize = 5 * 1024 * 1024; // 5 MB
                    if (fileSize > maxSize) {
                        $("#file-error").text("File size must be less than 5 MB.");
                        event.preventDefault();
                    } else {
                        $("#file-error").text("");
                    }
                }
            });
            
            function isValidEmail(email) {
                var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return pattern.test(email);
            }
            
            function isValidPhone(phone) {
                var pattern = /^[0-9]{10}$/;
                return pattern.test(phone);
            }
        });
    </script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <h1>Registration Form</h1>
    <form action="" form id="registration-form" method="post" enctype="multipart/form-data">
        
    <div class="mb-3">
    
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="">
            <span id="name-error" class="error"></span>
    </div>
        
    
    <div class="mb-3">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="">
            <span id="email-error" class="error"></span>
    </div>
        
    
    
    <div class="mb-3">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" value="">
            <span id="phone-error" class="error"></span>
    </div>
    
    
    <div class="mb-3">
            <label for="file">File:</label>
            <input type="file" id="file" name="file">
            <span id="file-error" class="error"></span>
    </div>
    
    
    <div class="mb-3">
    <button type="submit" id="submit" name="submit">Submit</button> 
    </div>
    </form>
    <a href="display.php">Display Results</a>
    


</body>
</html>

