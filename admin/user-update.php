<div class="px-5 py-3 col-lg-9">
    <h3><span class="text-primary"><i class="fa fa-user-plus"> Update User</i></span> static overview</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item" href="/index.php?page=dashboard" aria-current="page"><i class="fa fa-dashboard"> Dashboard</i></li>
        <li class="breadcrumb-item" href="/index.php?page=all-student" aria-current="page"><i class="fa fa-user-plus"> All Users</i></li>
        <li class="breadcrumb-item active" href="/index.php?page=edit-student" aria-current="page"><i class="fa fa-pencil-square"> Update User</i></li>
    </ol>
    <h3 class="display-5 text-center">User Update</h3>
    <?php
    require_once('dbcon.php');
    if (!isset($_SESSION['user_login'])){
        header("location:login.php");
    }
    require_once('dbcon.php');
    $id = base64_decode($_GET['id']);
    if (isset($_POST['update'])) {
        $name = ucwords($_POST['name']);
        $email= $_POST['email'];
        $user= $_POST['user'];
        $status = $_POST['status'];
        $pass1 =$_POST['pass1'];
        $pass2 =$_POST['pass2'];
        $pass3 =$_POST['pass3'];
        $photo = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];

        if($photo){
            $folder = "../img/" . $photo;
            move_uploaded_file($tempname, $folder);
            $query = "UPDATE `users` SET `photo`='$photo' WHERE `id`='$id'";
            $result = mysqli_query($link, $query);
            $suc_m = "Update Successful";
        }

        // Change photo name
        /*
            $ext = pathinfo($photo, PATHINFO_EXTENSION);
            $newname =$roll.".".$ext;
            $folder = "img/".$newname;
        */
//Query
        $query = "UPDATE `users` SET `name`='$name',`email`='$email',`username`='$user',`status`='$status' WHERE `id`='$id'";
        $query_p = "UPDATE `users` SET `password`='$pass2', WHERE `id`='$id'";
        $result = mysqli_query($link, $query);
        $email_d = mysqli_query($link, "SELECT * FROM `users` WHERE `email`='$email';");
        $user_d = mysqli_query($link, "SELECT * FROM `users` WHERE `username`='$user';");
        $pass_d = mysqli_query($link, "SELECT * FROM `users` WHERE `password`='$pass1';");
        if ($result){
            $suc_m = "Update Successful";
        }
        else{
            $suc_e = "Update Falid";
        }

//Validation
        if (!empty($pass1)){
            if (mysqli_num_rows($pass_d)==1){
                if ($pass2 == $pass3){
                    if (strlen ($pass2) == 5){
                        $result = mysqli_query($link, $query_p);
                        $suc_m = "Update Successful";
                    }
                    else{
                        $p_e_l = "Password will be in 5 digits";
                    }
                }
                else{
                    $p_e_n = "Password Not Matched";
                }
            }
            else{
                $p_e_o = "Old Password Incorrect";
            }
        }

    }


    $query = "SELECT * FROM users WHERE `id`='$id'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    if($row["status"] == 'Active'){
        $g_m ="";
    }
    elseif($row["status"] == 'Deactive'){
        $g_f ="";
    }

    ?>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <form class="" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <div>
                        <?php if (isset($suc_m)) {
                            echo "<p class='alert alert-success'>$suc_m</p>";
                        }
                        if (isset($suc_e)) {
                            echo "<p class='alert alert-danger'>$suc_e</p>";
                        }
                        ?>
                        <br>
                        <Span>Name <input class="form-control" type="text" name="name" value="<?php echo $row["name"]; ?>"></Span>
                        <Span>Email <input class="form-control" type="text" name="email" value="<?php echo $row["email"]; ?>"></Span>
                        <Span>User Name <input class="form-control" type="text" name="user" value="<?php echo $row["username"]; ?>"></Span>
                        <Span>Status <select class="custom-select mr-sm-2" name="status" id="inlineFormCustomSelect">
                                            <option class="text-success" value="Active" <?php if (isset($g_m)) {
                                                echo "selected";
                                            } ?>>Active</option>
                                            <option class="text-danger" value="Deactive" <?php if (isset($g_f)) {
                                                echo "selected";
                                            } ?>>Deactive</option>
                                     </select>
                        </Span>
                        <Span>Old Password <input class="form-control" type="password" name="pass1" value="">
                         <?php if (isset($p_e_o)) {
                             echo "<p class='lead text-danger'>$p_e_o</p>";
                         }
                         ?>

                        </Span>
                        <Span>New Password <input class="form-control" type="password" name="pass2">
                         <?php if (isset($p_e_l)) {
                             echo "<p class='lead text-danger'>$p_e_l</p>";
                         }
                         ?>
                            <?php if (isset($p_e_n)) {
                                echo "<p class='lead text-danger'>$p_e_n</p>";
                            }
                            ?>
                        </Span>
                        <Span>Confirm Password <input class="form-control" type="password" name="pass3"></Span>
                        <img class=" mt-3 rounded mx-auto d-block" style="width:120px; align-content: center;" src="../img/<?php echo $row["photo"];?>" alt="">
                        <Span>Photo <input class="file-control" type="file" name="photo" value="<?php echo $row["photo"]; ?>" ></Span>
                        <input class="btn btn-primary mt-3 float-right" type="submit" name="update" value="Update">
                    </div>
            </form>
        </div>
    </div>
</div>
