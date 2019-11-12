<div class="px-5 py-3 col-lg-9">
    <h3><span class="text-primary"><i class="fa fa-group"> All Students</i></span> static overview</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><i class="fa fa-dashboard"> Dashboard</i></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-group"> All Students</i></li>
    </ol>
    <h3 class="display-5 text-center">Students List</h3>
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (!isset($_SESSION['user_login'])){
         header("location:login.php");
         }
        require_once('dbcon.php');
        //Reading Student_info Data
        $query = "SELECT * FROM student_info";
        $result = mysqli_query($link, $query);
        $srid=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $srid++;
            ?>
            <tr>
                <td><?php echo $srid; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["class"]; ?></td>
                <td><?php echo $row["roll"]; ?></td>
                <td><?php echo $row["gender"]; ?></td>
                <td><?php echo $row["city"]; ?></td>
                <td><?php echo '0' . $row["contact"]; ?></td>
                <td><img style="width:35px;" src="../img/<?php echo $row["photo"]; ?>" alt=""></td>
                <td><a href="delete_student.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-danger">Delete</a>
                    <a href="index.php?page=update-students&id=<?php echo base64_encode($row['id']); ?>" class="btn btn-warning">Edit</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
