
<div class="row">
    <div class="col-lg-6">
        <table class="table table-bordered table-responsive-sm table-hover">
            <tbody>
            <tr>
                <td>Name</td>
                <td><?php echo $row["name"]; ?></td>
            </tr>
            <tr>
                <td>Class</td>
                <td><?php echo $row["class"]; ?></td>
            </tr>
            <tr>
                <td>Roll</td>
                <td><?php echo $row["roll"]; ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><?php echo $row["gender"]; ?></td>
            </tr>
            <tr>
                <td>City</td>
                <td><?php echo $row["city"]; ?></td>
            </tr>
            <tr>
                <td>Contact</td>
                <td><?php echo '0' . $row["contact"]; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-lg-6">
        <img style="width:55%;" src="img/<?php echo $row["photo"]; ?>" alt="">
    </div>
</div>
