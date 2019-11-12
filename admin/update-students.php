<div class="px-5 py-3 col-lg-9">
    <h3><span class="text-primary"><i class="fa fa-user-plus"> Update Student</i></span> static overview</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item" href="/index.php?page=dashboard" aria-current="page"><i class="fa fa-dashboard"> Dashboard</i></li>
        <li class="breadcrumb-item" href="/index.php?page=all-student" aria-current="page"><i class="fa fa-user-plus"> All Students</i></li>
        <li class="breadcrumb-item active" href="/index.php?page=edit-student" aria-current="page"><i class="fa fa-pencil-square"> Update Student</i></li>
    </ol>
    <h3 class="display-5 text-center">Students Update</h3>
    <?php
    require_once('dbcon.php');
    if (!isset($_SESSION['user_login'])){
    header("location:login.php");
    }
    require_once('dbcon.php');
    $id = base64_decode($_GET['id']);
    if (isset($_POST['update'])) {
        $name = ucwords($_POST['name']);
        $class = $_POST['class'];
        $roll = $_POST['roll'];
        $gender = $_POST['gender'];
        $city = ucwords($_POST['city']);
        $contact = $_POST['contact'];
        $photo = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];

        if($photo){
            $folder = "../img/" . $photo;
            move_uploaded_file($tempname, $folder);
            $query = "UPDATE `student_info` SET `photo`='$photo' WHERE `id`='$id'";
            $result = mysqli_query($link, $query);
        }

        // Change photo name
        /*
            $ext = pathinfo($photo, PATHINFO_EXTENSION);
            $newname =$roll.".".$ext;
            $folder = "img/".$newname;
        */
//Query
        $query = "UPDATE `student_info` SET `name`='$name',`roll`='$roll',`class`='$class',`gender`='$gender',`city`='$city',`contact`='$contact' WHERE `id`='$id'";
        $result = mysqli_query($link, $query);
        $roll_d = mysqli_query($link, "SELECT * FROM `student_info` WHERE `roll`='$roll';");
        $class_d = mysqli_query($link, "SELECT * FROM `student_info` WHERE `class`='$class';");


//Validation
        $phone = array("017", "014", "019", "011", "018", "016", "013");



            if (strlen($roll) == 4) {
                if (strlen($contact) == 11 && in_array(substr($contact, 0, -8), $phone)) {
                    $result = mysqli_query($link, $query);
                    $succ_al = "Update Succcessfull";
                } else {
                    $err_al = "Failed to Update";
                    $contact_er = "* Contact Number is not vaild";
                }
            } else {
                $err_al = "Failed to Update";
                $roll_len = "* Roll Should Be in 4 digits";
            }
        }


        $query = "SELECT * FROM student_info WHERE `id`='$id'";
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row["class"] == '1') {
            $cl_1 = "";
        } elseif ($row["class"] == '2') {
            $cl_2 = "";
        } elseif ($row["class"] == '3') {
            $cl_3 = "";
        } elseif ($row["class"] == '4') {
            $cl_4 = "";
        } elseif ($row["class"] == '5') {
            $cl_5 = "";
        }

        if($row["gender"] == 'Male'){
            $g_m ="";
        }
        elseif($row["gender"] == 'Female'){
            $g_fm ="";
        }

    ?>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <form class="" action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <div>
                        <?php if (isset($succ_al)) {
                            echo "<p class='alert alert-success'>$succ_al</p>";
                        }
                        ?>
                        <?php if (isset($err_al)) {
                            echo "<p class='alert alert-danger'>$err_al</p>";
                        }
                        ?>
                        <?php if (isset(   $err_up)) {
                            echo "<p class='alert alert-warning'>   $err_up</p>";
                        }
                        ?>


                        <br>
                        <Span>Name <input class="form-control" type="text" name="name"
                                          value="<?php echo $row["name"]; ?>"></Span>
                        <Span>Class <select class="custom-select mr-sm-2" name="class" id="inlineFormCustomSelect" required>
                                            <option value="">Choose...</option>
                                            <option value="1" <?php if (isset($cl_1)) {
                                                echo "selected";
                                            } ?>>One</option>
                                            <option value="2" <?php if (isset($cl_2)) {
                                                echo "selected";
                                            } ?>>Two</option>
                                            <option value="3"<?php if (isset($cl_3)) {
                                                echo "selected";
                                            } ?>>Three</option>
                                            <option value="4"<?php if (isset($cl_4)) {
                                                echo "selected";
                                            } ?>>Four</option>
                                            <option value="5"<?php if (isset($cl_5)) {
                                                echo "selected";
                                            } ?>>Five</option>
                                     </select>
                         </Span>
                        <Span>Roll <input class="form-control" type="text" name="roll" value="<?php echo $row["roll"]; ?>" >
          <?php if (isset($roll_len)) {
              echo "<p class='lead text-danger'>$roll_len</p>";
          }
          ?>
          <?php if (isset($roll_ex)) {
              echo "<p class='lead text-danger'>$roll_ex</p>";
          }
          ?>
        </Span>
                        <Span>Gender <select class="custom-select mr-sm-2" name="gender" id="inlineFormCustomSelect"
                                            >
                            <option value="">Choose...</option>
                            <option value="Male" <?php if (isset($g_m)) {
                                echo "selected";
                            } ?>>Male</option>
                            <option value="Female" <?php if (isset($g_f)) {
                                echo "selected";
                            } ?>>Female</option>
                     </select>
         </Span>
                        <Span>City <input class="form-control" type="text" name="city" value="<?php echo $row["city"]; ?>" ></Span>
                        <Span>Contact <input class="form-control" type="text" name="contact" value="<?php echo '0'.$row["contact"]; ?>" >
          <?php if (isset($contact_er)) {
              echo "<p class='lead text-danger'>$contact_er</p>";
          }
          ?>
          </Span>
                        <img class=" mt-3 rounded mx-auto d-block" style="width:120px; align-content: center;" src="../img/<?php echo $row["photo"];?>" alt="">
                        <br>
                        <Span>Photo <input class="file-control" type="file" name="photo" value="<?php echo $row["photo"]; ?>" ></Span>

                        <input class="btn btn-primary mt-3 float-right" type="submit" name="update"
                               value="Update">
                    </div>
            </form>
        </div>
    </div>
</div>
