
<div class="px-5 py-3 col-lg-9">
    <h3><span class="text-primary"><i class="fa fa-group"> All Users</i></span> static overview</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><i class="fa fa-dashboard"> Dashboard</i></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fa fa-group"> All Users</i></li>
    </ol>
    <?php
    if (!isset($_SESSION['user_login'])){
    header("location:login.php");
    }

    $query = "SELECT * FROM users WHERE `username`='$u'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $date = date("d/m/y", strtotime($row['date']));
    //date("d/m/y, H:i:s", strtotime($row["timestamp"]));


    ?>
    <h3 class="display-5 text-center">Users List</h3>
    <div class="row">
        <div class="col-lg-6">
            <table class="table table-hover table-bordered table-responsive-sm">
                <tbody>
                <tr>
                    <td>User ID</td>
                    <td><?php echo $row['id'];?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo $row['name'];?></td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td><?php echo $row['username'];?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $row['email'];?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo $row['status'];?></td>
                </tr>
                <tr>
                    <td>Signup Date</td>
                    <td><?php echo $date; ?></td>
                </tr>
                </tbody>
            </table>
            <a class="btn btn-primary" href="index.php?page=user-update&id=<?php echo base64_encode($row['id']); ?>">Edit Profile</a>
        </div>
        <div class="col-lg-6">
            <img style="width: 250px;" src="../img/<?php echo $row['photo'];?>" alt="">

        </div>
    </div>

</div>
