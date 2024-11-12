<h4>New Course Management Window</h4>
<div class="card">
    <div class="card-header">
        <h5 class="head-title">Add New Course</h5>
    </div>
    <?php require_once '../alart2.php' ?>
    <div class="card-body">
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="">Select Faculty</label>
                <select name="faculty" id="" class="form-control">
                    <option disabled selected></option>
            <?php
                $sql = mysqli_query($conn, "SELECT * FROM `faculty_tbl`");
                while($row = mysqli_fetch_array($sql)):?>
                <option value="<?php echo $row[0]; ?>"><?php echo $row['FacultyName']; ?></option>
                <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Select Course</label>
                <input type="text" name="course" id="" class="form-control" placeholder="Enter Course">
            </div>
            <div class="form-group">
                <button type="submit" name="addcourse" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
    <div class="card-footer"></div>
</div>