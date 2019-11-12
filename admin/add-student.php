<div class="px-5 py-3 col-lg-9">
<h3><span class="text-primary"><i class="fa fa-user-plus"> Add Student</i></span> static overview</h3>
    <ol class="breadcrumb">
       <li class="breadcrumb-item" aria-current="page"><i class="fa fa-dashboard"> Dashboard</i>
        </li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-user-plus"> Add Student</i>
        </li>
    </ol>
    <h3 class="display-5 text-center">Add Student</h3>
    <?php
if (!isset($_SESSION['user_login'])){
    header("location:login.php");
    }
require_once('dbcon.php');
if(isset($_POST['add_student'])){
    $name = ucwords(strtolower($_POST['name']));
    $class = $_POST['class'];
    $roll = $_POST['roll'];
    $gender = $_POST['gender'];
    $city = ucwords(strtolower($_POST['city']));
    $contact = $_POST['contact'];
    $photo = $_FILES["photo"]["name"];
    $tempname = $_FILES["photo"]["tmp_name"];
    $folder = "../img/".$photo;
    // Change photo name
/*
    $ext = pathinfo($photo, PATHINFO_EXTENSION);
    $newname =$roll.".".$ext;
    $folder = "img/".$newname;
*/
//Query
$roll_d =mysqli_query($link,"SELECT * FROM `student_info` WHERE `roll`='$roll';");
$class_d =mysqli_query($link,"SELECT * FROM `student_info` WHERE `class`='$class';");
$query= "INSERT INTO `student_info` (`name`, `roll`, `class`, `gender`, `city`, `contact`, `photo`)";
$query.= "VALUES ('$name', '$roll','$class', '$gender', '$city', '$contact', '$photo')";
//Validation
$phone = array("017","014","019","011","018","016","013");
if ((mysqli_num_rows($class_d) && mysqli_num_rows($roll_d))==0) {
    if (strlen($roll)==4) {
        if(strlen($contact)==11 && in_array(substr($contact, 0, -8), $phone) ){
        $result = mysqli_query($link,$query);
        move_uploaded_file($tempname, $folder);
        $succ_al = "New Student Succcessfully Added";
        }
        else{
        $err_al = "Failed to Add Student";
        $contact_er="* Contact Number is not vaild";
        }
    }
    else{
    $err_al = "Failed to Add Student";
    $roll_len ="* Roll Should Be in 4 digits";
    }
}
else{
$err_al = "Failed to Add Student";
$roll_ex ="* Roll Exist";  
}
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

      <br>
          <Span>Name <input class="form-control" type="text" name="name" required></Span>
          <Span>Class <select class="custom-select mr-sm-2" name="class" id="inlineFormCustomSelect" required>
                            <option value="">Choose...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                            <option value="5">Five</option>
                     </select>
         </Span>
         <Span>Roll <input class="form-control" type="text" name="roll" required>
          <?php if (isset($roll_len)) {
          echo "<p class='lead text-danger'>$roll_len</p>";
     }
        ?>
        <?php if (isset($roll_ex)) {
          echo "<p class='lead text-danger'>$roll_ex</p>";
     }
        ?>
        </Span>
         <Span>Gender <select class="custom-select mr-sm-2" name="gender" id="inlineFormCustomSelect" required>
                            <option value="">Choose...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                     </select>
         </Span>
          <Span>City <input class="form-control" type="text" name="city" required></Span>
          <Span>Contact <input class="form-control" type="text" name="contact" required>
          <?php if (isset($contact_er)) {
          echo "<p class='lead text-danger'>$contact_er</p>";
     }
        ?>
          </Span>
          <br>
          <Span>Photo <input class="file-control" type="file" name="photo" required></Span>
          <input class="btn btn-primary mt-3 float-right" type="submit" name="add_student" value="Add Student">
        </div>
      </form>
    </div>
    </div>
</div>
