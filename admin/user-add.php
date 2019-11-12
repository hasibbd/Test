<div class="px-5 py-3 col-lg-9">
<h3><span class="text-primary"><i class="fa fa-user-plus"> Add User</i></span> static overview</h3>
    <ol class="breadcrumb">
       <li class="breadcrumb-item" aria-current="page"><i class="fa fa-dashboard"> Dashboard</i>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user-plus"> Add User</i>
        </li>
    </ol>
    <h3 class="display-5 text-center">Add User</h3>
<?php

require_once('dbcon.php');
if (isset($_POST['registration'])) {
    $name = ucwords(strtolower($_POST['name']));
    $email = strtolower($_POST['email']);
    $user = $_POST['user'];
    $pass = $_POST['password1'];
    $pass_c = $_POST['password2'];
    $status ="Active";
    $filename = $_FILES["pic"]["name"];
    $tempname = $_FILES["pic"]["tmp_name"];
    $folder = "../img/".$filename;
    //  $ext = pathinfo($photo, PATHINFO_EXTENSION);
    //  echo $ext;
    $email_c =mysqli_query($link,"SELECT * FROM `users` WHERE `email`='$email';");
    $user_c =mysqli_query($link,"SELECT * FROM `users` WHERE `username`='$user';");
    $query= "INSERT INTO `users`(`name`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name','$email','$user','$pass','$filename','$status');";
    if (mysqli_num_rows($email_c)==0) {
        if ($pass==$pass_c) {
            if (strlen($pass)==5) {
                if (mysqli_num_rows($user_c)==0){

                    $result = mysqli_query($link,$query);
                    if ($result) {
                        $_SESSION['data_insert_success']="Data Insert Success";
                        move_uploaded_file($tempname, $folder);
                        $reg_s ="Registration Success";
                    }
                    else {
                        $_SESSION['data_insert_error']="Data Insert Error";
                    }
                }else{
                    $user_error = "User Already Exists";
                }
            }
            else {
                $pass_l_error = "Password Lenth Will be more Than 4";
            }
        }
        else {
            $pass_c_error = "Password Mismatched";
        }
    }
    else {
        $email_error = "Email Already Exists";
    }
}
?>  
    <div class="row">
    <div class="col-lg-6 offset-lg-3">
    <span class="" for=""><?php if (isset($reg_s)) {
              echo $reg_s;
          } ?></span>
            <form class="" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" value="<?php echo (isset($name))?$name:'';?>" placeholder="Name" id="name" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" name="email" value="<?php echo (isset($email))?$email:'';?>" placeholder="Email" id="email" required>
                    <span class="" for=""><?php if (isset($email_error)) {
                            echo $email_error;
                        } ?></span>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="user" value="<?php echo (isset($user))?$user:'';?>" placeholder="User Name" id="user" required>
                    <span class="" for=""><?php if (isset($user_error)) {
                            echo $user_error;
                        } ?></span>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password1" value="<?php echo (isset($pass))?$pass:'';?>" placeholder="Password" id="password1" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password2" value="" placeholder="Confirm Password" id="password2" required>
                    <span class="" for=""><?php if (isset($pass_c_error)) {
                            echo $pass_c_error;
                        } ?></span>
                    <span class="" for=""><?php if (isset($pass_l_error)) {
                            echo $pass_l_error;
                        } ?></span>
                </div>
                <div class="custom-file">
                    <input type="file" name="pic" class="custom-file-input" id="pic" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                </div>
                <br>
                <br>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name="registration" value="registration">
                </div>
            </form>
    </div>
    </div>
</div>
