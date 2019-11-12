<?php
    require_once("dbcon.php");
    if (!isset($_SESSION['user_login'])){
    header("location:login.php");
}
    require_once('dbcon.php');
    $query = "SELECT * FROM student_info";
    $result = mysqli_query($link,$query);
    $query1 = "SELECT * FROM users";
    $result1 = mysqli_query($link,$query1);
    ?>
<div class="px-5 py-3 col-lg-9">
    <h3><span class="text-primary"><i class="fa fa-dashboard"> Dashboard</i></span> static overview</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-dashboard"> Dashboard</i>
        </li>
    </ol>
    
    <div class="row">
        <div class="col-sm-4">
            <div class="card  bg-primary text-light">
                <div class="card-title">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="container">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="container">
                                <div class="pull-right display-1">
                                  <span><?php print_r(mysqli_num_rows($result)); ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="pull-right">All Student</div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="index.php?page=all-student">
                    <div class="card-footer bg-light">
                        <div class="container">
                            <span>View All Students</span>
                            <span><i class="fa fa-arrow-circle-o-right pull-right"></i></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-primary text-light">
                <div class="card-title ">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="container">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="container">
                                <div class="pull-right display-1">
                                    <span><?php print_r(mysqli_num_rows($result1)); ?></span>
                                </div>
                                <div class="clearfix"></div>
                                <div class="pull-right">All Users</div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="index.php?page=user">
                    <div class="card-footer bg-light">
                        <div class="container">
                            <span>View All Users</span>
                            <span><i class="fa fa-arrow-circle-o-right pull-right"></i></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <hr>
    <h3 class="display-5 text-center">New Students</h3>
    <table class="table table-hover table-bordered table-responsive-sm" id="dataTableEx">
        <thead class="bg-primary text-light">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Class</th>
            <th>Roll</th>
            <th>Gender</th>
            <th>City</th>
            <th>Contact</th>
            <th>Photo</th>
        </tr>
        </thead>
        <tbody>
        
        <?php
        
        //if (mysqli_num_rows($result) > 0){

        $srid=0;
        while($row = mysqli_fetch_assoc($result)){
            $srid++;
            ?>

          <tr>
            <td><?php echo $srid;?></td>
            <td><?php echo $row["name"];?></td>
            <td><?php echo $row["class"];?></td>
            <td><?php echo $row["roll"];?></td>
            <td><?php echo $row["gender"];?></td>
            <td><?php echo $row["city"];?></td>
            <td><?php echo '0'.$row["contact"];?></td>
            <td><img style="width:35px;" src="../img/<?php echo $row["photo"];?>" alt=""></td>
           </tr>
      <?php  }
            
            
         //   }
            ?>
     

        </tbody>
    </table>
</div>