<?php
use LDAP\Result;
$efname = '';

############## role ##############
function role(){
    global $conn;
    $role = 'Admin';
    $stmt = $conn->prepare("SELECT * FROM `role_tbl` WHERE `role` != ? ");
    $stmt->bind_param('s', $role);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()):?>
        <option value="<?= $row['RID'] ?>"><?= $row['role'] ?></option>
   <?php
   endwhile;
}
########### generate hash code
function encryptID($id){
	$method = 'AES-128-CTR';
	$encryptKey = openssl_digest(php_uname(), 'SHA256', TRUE);
	$length = openssl_cipher_iv_length($method);
	$options = 0;
	$encryptIV = random_bytes($length);

	$encrypted_id = openssl_encrypt($id, $method, $encryptKey, $options, $encryptIV);
	return base64_encode($encrypted_id . '::' . $encryptIV);
} 

function decryptID($encrypted_id) {
	$method = 'AES-128-CTR';
	$encryptKey = openssl_digest(php_uname(), 'SHA256', TRUE);
	$options = 0;

    $parts = explode('::', base64_decode($encrypted_id), 2);
    if(count($parts) !== 2){
        return false;
    }

	list($encrypted_data, $encryptIV) = $parts; //= explode('::', base64_decode($encrypted_id), 2);
    if(strlen($encryptIV) !== openssl_cipher_iv_length($method)){
        return false;
    }
    return openssl_decrypt($encrypted_data, $method, $encryptKey, $options, $encryptIV);
}

############ dynamic tr #############
function generateTableHeaders($columnNames) {
    $headers = '';
    foreach ($columnNames as $columnName) {
        $headers .= '<th>' . $columnName . '</th>';
    }
    return $headers;
}

############## Cummulate Unit   ##########
function cu(){
    global $conn;
    $sql = "SELECT * FROM `vcu` WHERE `stu_ID` = '".$_SESSION['stdID']."' AND `MatricNo` = '".$_SESSION['matric']."'  ";
    $result = @mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
       while($row = mysqli_fetch_array($result)){
        echo $row['CU'];
       }
    }else{
        echo '';
    }
}
#############   Cummulting Point    ########
function cp($stdID, $matric){
    $total = 0;
    global $conn;
    //'".$_SESSION['stdID']."' AND `MatricNo` = '".$_SESSION['matric'].
    $sql = "SELECT * FROM `cgpa_view` WHERE `stu_ID` = '$stdID' AND `MatricNo` = '$matric' ";
    $result = @mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $total += $row['cPoint'];
        }
    }else{
        echo '';
    }
    echo $total;
}
################### cgpa   ###################
function cgpa(){
    global $conn;
    $cp = 0;
    $cu = 0;
    $sql = "SELECT * FROM `cgpa_view` WHERE `stu_ID` = '".$_SESSION['stdID']."' AND `MatricNo` = '".$_SESSION['matric']."'  ";
    $result = @mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $cp += $row['cPoint'];
            $cu += $row['TotalUnit']; 
        }
        if ($cu != 0) {
            $cgpa = $cp / $cu;
            echo number_format($cgpa, 2);
        } else {
            echo "Total Units cannot be zero.";
        }
    } else {
        echo '0.00';//'No records found.';
    }
} 
################ POINTS ##################
function point(){
    global $conn;
    //$sql = @mysqli
    $gradePoints = [
        'A' => 5.0,
        'B' => 4.0,
        'C' => 3.0,
        'D' => 2.0,
        'E' => 1.0,
        'F' => 0.0, // or whatever the grade point for failing is
    ];
}
############### stdcrsregtrtn_tbl #################
function stdcourseregister(){
    global $conn;
    $sql = @mysqli_query($conn, "SELECT * FROM `stdcrsregtrtn_tbl` WHERE `stdID`= '".$_SESSION['stdID']."' AND `SessionStd` = '".$_SESSION['stdsession']."' AND `SemeterStd` = '".$_SESSION['stdsemeter']."'    ");
    $i = 1;
    $totalUnit = 0;
    while($row = mysqli_fetch_array($sql)):?>
        <tr id="td">
            <td><?php echo $i++ ?></td>
            <td><?php
                $sqlcourse = @mysqli_query($conn, "SELECT * FROM `course_tbl` WHERE `course_ID` = '".$row['CourseTitle']."' ");
                $rowcourse = mysqli_fetch_array($sqlcourse);
                echo $rowcourse['CourseTitle'];
            ?></td>
            <td><?php echo $rowcourse['CourseCode'] ?></td>
            <td><?php
                echo $rowcourse['Unit'];
                $totalUnit += $rowcourse['Unit'];
            ?></td>
            <td><?php echo $row['Status'] ?></td>
            <td>
                <a onclick="return confirm('Do you really want to delete this course?')" href="courseregistration.php?page=courseregistration&stdIDC=<?php echo $row[0]; ?>"><span class="icofont-trash icofont-1x" style="align-items: center; color:red"></span></a>
            </td>
        </tr>
 <?php endwhile;?>
        <tr>
            <td colspan="3"><strong>Total Units</strong></td>
            <td><strong><?php echo $totalUnit; ?></strong></td>
            <td colspan="2"></td>
        </tr>
 <?php
}

############### student course registratin  #########
function courseRegistration(){
    global $conn;
    $sql = @mysqli_query($conn, "SELECT * FROM `course_tbl` WHERE `Status` = 'Active' ");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="'.$row[0].'">'.$row['CourseTitle'].' ('.$row['CourseCode'].')'. '</option>';
    }
}
#############   level ##############
function studentLevel($updatelevel = null){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `level_tbl`");
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){
        $selected = ($row['levelID'] == $updatelevel) ? 'selected' : '';
        echo "<option value=$row[levelID]; $selected>".$row['Level']."</option>";
    }
}
############ Function to generate random PINs   #########
function generatePIN() {
    return mt_rand(100000, 999999);
}

############ Function to generate random serial numbers #######
function generateSerialNumber() {
    return uniqid('SN');
}
############### grade point (GP)    ###########
function calculateGradePoint($Total,$Point,$courseUnit){
    global $conn;
    if($Total >=70){
        echo $Point;   
   }elseif($Total >= 60){
        echo $Point - $courseUnit;
   }elseif($Total >= 50){
        echo $Point - ($courseUnit*2);
   }elseif($Total >= 45){
        echo $Point - ($courseUnit * 3);
   }elseif($Total >= 40){
        echo $Point - ($courseUnit * 4);
   }else{
        echo $Point - ($courseUnit * 5);
   }
}
############# grade     #######################
function grade_for_exam_officer($Total) {
    if ($Total >= 70) {
        return "A";
    } elseif ($Total >= 60) {
        return "B";
    } elseif ($Total >= 50) {
        return "C";
    } elseif ($Total >= 45) {
        return "D";
    } elseif ($Total >= 40) {
        return "E";
    } else {
        return "F";
    }
}
function grade($Total){
    global $conn;
    if($Total >= 70) {
        return 'A';
    } elseif($Total >= 60) {
        return 'B';
    } elseif($Total >= 50) {
        return 'C';
    } elseif($Total >= 45) {
        return 'D';
    } elseif($Total >= 40) {
        return 'E';
    } else {
        return 'F';
    }
    /* if($Total >= 70){
        echo $grade = "A";
        $remark = "Excellent";
    }elseif($Total >= 60){
        echo $grade = "B";
        $remark = "V.Good";
    }elseif($Total >= 50){
        echo $grade = "C";
        $remark = "Good";
    }elseif($Total >= 45){
        echo $grade = "D";
        $remark = "Pass";                
    }elseif($Total >= 40){
        echo $grade = "E";
        $remark = "Fail";
    }elseif($Total == ''){
        echo '';
    }else{
        echo $grade = "F";
    } */
}
    #### Email Exist student
function isEmailExist($email){
    global $conn;
    $sql = "SELECT * FROM `student_tbl` WHERE `Email` = '$email' ";
    $result = mysqli_query($conn, $sql); 
    return (mysqli_num_rows($result) > 0);   
}
function isResultExist($studentID){
    global $conn;
    $sql = "SELECT * FROM `result_tbl` WHERE `stu_ID` = '$studentID' AND `ExamAddedBy` = '".$_SESSION['uname']."' AND `Session` = '".$_SESSION['session']."' AND `Semester` = '".$_SESSION['semester']."' ";
    $result = @mysqli_query($conn, $sql);
    return (mysqli_num_rows($result) > 0);
}

########### std course Exist    ###########
function isStdCourseExist($session_stdID){
    global $conn;
    $session_stdID = $_SESSION['stdID'];
    $sql = @mysqli_query($conn, "SELECT * FROM `stdcrsregtrtn_tbl` WHERE `stdID` = '$session_stdID' =");
    return(mysqli_num_rows($sql) > 0);
}
########### Phone Exist     #########
function isPhoneExist($phone){
    global $conn;
    $sql = "SELECT * FROM `student_tbl` WHERE `Phone` = '$phone' ";
    $result = @mysqli_query($conn, $sql);
    return(mysqli_num_rows($result) > 0);
}

#########   staff email exist   #######
function isStaffEmailexist($staffemail){
    global $conn;
    $sql = "SELECT * FROM `users_tbl` WHERE `Email` = '$staffemail' ";
    $result = @mysqli_query($conn, $sql);
    $rowexist = mysqli_num_rows($result);
    return($rowexist);

}
#############   staff phone exist   ########
function isStaffPhoneExist($staffphone){
    global $conn;
    $sql = "SELECT * FROM `users_tbl` WHERE `Phone` = '$staffphone' ";
    $result = @mysqli_query($conn, $sql);
    $pexist = mysqli_num_rows($result);
    return($pexist);
}
############## course and title exist   #######
function isTitleCodeExist($cousertitle, $coursecode, $unit, $semester, $level){
    global $conn;
    $sql = "SELECT * FROM `course_tbl` WHERE `CourseTitle` = '$cousertitle' AND `CourseCode` = '$coursecode' AND `Unit` = '$unit' AND `SemesterCourse` = '$semester' AND `stdLevel` = '$level' ";
    $result = mysqli_query($conn, $sql);
    return (mysqli_num_rows($result) > 0);
}
#####   faculty, course Lecturer and Student __JOIN    ########
function FacultyCouseExist(int $faculty,$course){
    global $conn;
    $sql = "SELECT * FROM `department_tbl` WHERE `faculty_ID` = '$faculty' AND `CourseofStudy` = '$course' ";
    $resultfc = @mysqli_query($conn, $sql);
    return(mysqli_num_rows($resultfc) > 0);
}
#########   manage student information #######
function managestudent(){
    global $conn;
    $sql = "SELECT * FROM `student_tbl` WHERE `Status` = 'Active' ";
    $result = @mysqli_query($conn, $sql);
    $i = 1;
    while($row = mysqli_fetch_array($result)):?>
    <tr style="font-family: 'Times New Roman', Times, serif; font-size:12pt;color:#07294d">
        <td><?= htmlspecialchars($i++); ?></td>
        <td><?= htmlspecialchars($row['Firstname'].' '.$row['Middlename'].' '.$row['Surname']) ?></td>
        <td><?php echo $row['Reg_no']; ?></td>
        <td><?php
            $sqldpt = @mysqli_query($conn, "SELECT * FROM `department_tbl` WHERE `dept_ID` = '".$row['Course_of_study']."' ");
            $rowcourse = mysqli_fetch_array($sqldpt);
            echo $rowcourse['CourseofStudy'];
            //echo $row['Course_of_study']; 
        ?></td>
        <td>
            <a href="dashboard.php?page=updatestudent&editstudent=<?php echo $row[0]; ?>"><span class="icofont-edit"></span></a>
        </td>
    </tr> 
<?php endwhile; }

###########     eDIT AND uPDATE sTUDENT     ####################
function editstudent(){
    global $conn;
    $editID = $_GET['editstudent'];
    $sql = "SELECT * FROM  `student_tbl` WHERE `stu_ID` = '$editID' ";
    $result = @mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $efname = $row['Firstname'];
            $emname = $row['Middlename'];
            $esname = $row['Surname'];
        }
    }
    
} 
#############   FETCH faculties     ###############
function facultyList(){
    global $conn;
    $sql = @mysqli_query($conn, "SELECT * FROM `faculty_tbl` WHERE `Status` = 'Active' ORDER BY `FacultyName` ASC");
    while($row = mysqli_fetch_array($sql)){
        echo '<option value="'.htmlspecialchars($row['faculty_ID']).'">'.htmlspecialchars($row['FacultyName']).'</option>';
    }
}
#################     fetch department ###############  
function departmentList($updatedpt = null){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `department_tbl`");
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()):
            $selected = ($row['dept_ID'] == $updatedpt) ? 'selected' : '';
        ?>
        <option value="<?= $row['dept_ID'] ?>" <?= $selected ?> ><?= $row['CourseofStudy'] ?></option>			
    <?php endwhile;
} 
##########  selected state and all state  ############
function selectedState($estate){
    global $conn;
    $sqlstate = @mysqli_query($conn, "SELECT * FROM `state_tbl` WHERE `state_ID` = '$estate' ");
    $rowstate = mysqli_fetch_array($sqlstate);
    $sqlAllState = @mysqli_query($conn, "SELECT * FROM `state_tbl` ORDER BY `state_ID` ASC");
    while($rowst = mysqli_fetch_array($sqlAllState)){
        //$selected = ($rowst['State'] == $rowstate['State'])?'selected = "selected"' : '';
        $selected = $rowst[0] == $estate?'selected = "selected"': '';
        echo "<option value='".$rowst[0]."' ".$selected.">".$rowstate['State']."</option>";
    } 
}
################### selected faculty and all faculties   ##############
function selectedFaculty($efaculty){
    global $conn;
    $sqlsfcty = mysqli_query($conn, "SELECT * FROM `faculty_tbl` WHERE `faculty_ID` = '$efaculty' ");
    $rowsfcty = mysqli_fetch_array($sqlsfcty);
    $sqlaf = mysqli_query($conn, "SELECT * FROM `faculty_tbl` ORDER BY `FacultyName` ASC");
    while($rowaf = mysqli_fetch_array($sqlaf)){
        $selected = $rowaf[0] == $efaculty?'selected = "selected"': '';
        echo "<option value='".$rowaf[0]."' ".$selected.">".$rowaf[1]."</option>";
    }
}
#############   tEST and eXAM   ###################

############## course code and course title #########

function coursetitleandcode(){
	global $conn;
	$stmt = $conn->prepare("SELECT * FROM `course_tbl`");
	$stmt->execute();
	$result = $stmt->get_result();
	$i = 1;
	while($row = $result->fetch_assoc()):?>
	<tr id="td">
			<td><?= $i++; ?></td>
			<td><?= htmlspecialchars($row['CourseTitle']); ?></td>
			<td><?= htmlspecialchars($row['CourseCode']); ?></td>
			<td><?php 
				$stmtLevel = $conn->prepare("SELECT `Level` FROM `level_tbl` WHERE `levelID` = ?");
				$stmtLevel->bind_param("i", $row['stdLevel']);
				$stmtLevel->execute();
				$resultLevel = $stmtLevel->get_result();
				$rowLevel = $resultLevel->fetch_assoc();
				echo htmlspecialchars($rowLevel['Level']);
			?></td>
			<td><?php 
				$stmtsem = $conn->prepare("SELECT `Semester` FROM `semester_tbl` WHERE `sem_ID` = ?");
				$stmtsem->bind_param("i", $row['SemesterCourse']);
				$stmtsem->execute();
				$resultsem = $stmtsem->get_result();
				$rowsem = $resultsem->fetch_assoc();
				echo htmlspecialchars($rowsem['Semester']);
			?></td>
			<td><?php echo htmlspecialchars($row['Unit']); ?></td>
			<td><?php echo htmlspecialchars($row['Status']); ?></td>
			<td>
					<a href="dashboard.php?page=updatecoursetitle&editcodetitle=<?php echo urlencode(encryptID($row['course_ID'])); ?>" title="Edit this information"><span class="icofont-edit icofont-1x" style="align-items: center;"></span></a>
			</td>
	</tr>
	<?php endwhile; 
}
######## add userd  #################
/* function addusers($staffname,$staffmname,$staffsname,$staffemail,$staffphone,$staffgender,$staffdob,$stafffaculty,$staffrole,$fn,$_SESSION['session'], $_SESSION['semester']){
    global $conn;
        $fn = $_FILES['photo']['name'];
        $ftype = $_FILES['photo']['type'];
        $fsize = $_FILES['photo']['photo'];
        $ftmpn = $_FILES['photo']['tmp_name'];
        $store = "upload/".$fn;
        move_uploaded_file($ftmpn, $store);
    $sql = "INSERT INTO `users_tbl` (`Firstname`,`Othername`,`Surname`,`Email`,`Phone`,`Gender`,`DOB`,`Faculty`,`Role`,`DateRegister`,`TimeRegister`,`Registerdby`,`Passphort`,`SessionLec`,`SemesterLec`) VALUES ('$staffname','$staffmname','$staffsname','$staffemail','$staffphone','$staffgender','$staffdob','$stafffaculty','$staffrole',now(),now(),'".$_SESSION['uname']."','$fn','".$_SESSION['session']."','".$_SESSION['semester']."' )";
    $result = @mysqli_query($conn, $sql);
    if($result == true){
        $_SESSION['message'] = 'Record save successfully';
        $_SESSION['msg_typ'] = 'success';
        header('location:dashboard.php?page=addstaff');
        exit();
    }else{
        $_SESSION['message'] = 'Something Goes Wrong';
        $_SESSION['msg_typ'] = 'danger';
        header('location:dashboard.php?page=addstaff');
        exit();
    }
}
 */########### assign course to lecturer   ############
function assignCtoLecturer(){
    global $conn;
    $sql = "SELECT * FROM `users_tbl` WHERE `Status` = 'Active' ";
    $result = @mysqli_query($conn, $sql);
    $i = 1;
    while($row = mysqli_fetch_array($result)):?>
    <tr style="font-family: 'Times New Roman', Times, serif; color: #07294d;font-size:12pt;">
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['Surname'].' '.$row['Firstname'].' '.$row['Othername'] ?></td>
        <td><?php echo $row['Email'] ?></td>
        <td><?php
            $sqlschl = @mysqli_query($conn, "SELECT * FROM `faculty_tbl` WHERE `faculty_ID` = '".$row['Faculty']."' ");
            $rowsch = mysqli_fetch_array($sqlschl);
            echo $rowsch['FacultyName'];
         ?>
        <td><?php //echo $row['Faculty'];?>
        <td>
            <a href="dashboard.php?page=assgnlc&lecturerc=<?php echo $row[0]; ?>"><span title="Delete this Assigned Course" class="btn btn-center icofont-list" style="align-items: center;font-size: 20pt; color:#07294d"></span></a>
        </td>
    </tr>
<?php endwhile; }

############### lectueres list of assign course ##############
function listofassigncourse($userLecID, $session, $semester){
    global $conn;
    //$sql = "SELECT * FROM `assigncourse_tbl` WHERE `Lecturer` = '$userLecID' ";
    $sql = "SELECT * FROM `assigncourse_tbl` WHERE `Lecturer` = '$userLecID' AND `Session` = '$session' AND `Semester` = '$semester' ";
    $result = @mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_array($result)):?>
    <tr style="font-size: 12pt;color:#07294d">
        <td><?php echo $i++; ?></td>
        <td><?php
                $sqldpt = @mysqli_query($conn, "SELECT * FROM `department_tbl` WHERE `dept_ID` = '".$row['Department']."' ");
                $rowdpt = mysqli_fetch_array($sqldpt);
                echo $rowdpt['CourseofStudy'];
            ?>
        </td>
        <td>
        <?php
            $sqlc = "SELECT * FROM `course_tbl` WHERE `course_ID` = '".$row['CourseTitle']."' ";
            $resultC = @mysqli_query($conn, $sqlc);
            $rowC = mysqli_fetch_array($resultC);
            echo $rowC['CourseTitle'];
        ?>
        </td>
        <td><?php echo $rowC['CourseCode'] ?></td>
        <td><?php echo $rowC['Unit'] ?></td>
        <td>
            <a onclick="return confirm('Are you sure you want to delete this record')" title="Delete this Record" class="btn" href="assignlecturercourse.php?deleteassigcourse=<?php echo $row[0]; ?>"><span class="icofont-trash icofont-2x" style="align-items: center;color:red"></span></a>
        </td>
    </tr>
<?php  endwhile; }

############# DELETE Course assign  #############
function deletecouser($dID,$LID){
    $LID = '';
    global $conn;
    $LID = $_POST['LID'];
    $sql = "DELETE FROM `assigncourse_tbl` WHERE `assigncourse_tbl`.`assignCourseID` = '$dID' ";
    $result = @mysqli_query($conn, $sql);
    if($result){
        $_SESSION['message'] = 'Record deleted successfully';
        $_SESSION['msg_typ'] = 'warning';
        header("location:dashboard.php");
        exit();
    }else{
        echo 'no';
    }
}

####################  assign couese exist   #################
function isCouserandLecExist($dptname,$course,$LID){
    global $conn;
    $sql = "SELECT * FROM `assigncourse_tbl` WHERE `Department` = '$dptname' AND `CourseTitle` = '$course' AND `Lecturer` = '$LID' ";
    $result = @mysqli_query($conn, $sql);
    $rowexist = mysqli_num_rows($result);
    return($rowexist);
}

######################          session          ##############
function schl_session(){
    global $conn;
    $sql = "SELECT * FROM `session_tbl` ORDER BY `session_ID`";
    $result = @mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)):?>    
    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
<?php endwhile; }

############# semester  ################
function schlsemester($updatesemester = null){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `semester_tbl`");
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()):
        $selected = ($row['sem_ID'] == $updatesemester) ? 'selected' : '';
    ?>
        <option value="<?php echo $row['sem_ID'] ?>" <?= $selected ?> ><?php echo $row['Semester'] ?></option>
    <?php endwhile;
}

function testandxam($values,$matric,$faculty,$course){
    global $conn;
    $sql = "INSERT INTO `result_tbl` (`Stu_ID`,`MatricNo`,`Faculty`,`CourseofStudy`) VALUES ('$values','$matric','$faculty','$course' )";
    $result = @mysqli_query($conn, $sql);
    if($result == true){
        $_SESSION['message'] = "Students records save successfully";
        $_SESSION['msg_typ'] = "success";
        header('location:dashboard.php?page=testandexam');
        exit();
    }else{
        $_SESSION['message'] = "Error";
        $_SESSION['msg_typ'] = "danger";
        header('location:dashboard.php?page=testandexam');
        exit();
    }
}

################ Test and exam entry form   ##################
function addtestandexam(){
    global $conn;
    //$Total = '';
    $sql = "SELECT * FROM `assigncourse_tbl` INNER JOIN `stdcrsregtrtn_tbl` USING(CourseTitle) WHERE `Lecturer` = '".$_SESSION['id']."' ";
    $result = mysqli_query($conn, $sql);
    $i = 0;
    $sn = 1;
    while($row = mysqli_fetch_array($result)):?>
        <tr style="color: #07294d; font-size:14pt">
            <td><?php echo $sn++; ?></td>
            <td style="text-align: left;">
                <?php
                    $sqlmatric = @mysqli_query($conn, "SELECT * FROM `student_tbl` WHERE `stu_ID` = '".$row['stdID']."' ");
                    $rowmatric = mysqli_fetch_array($sqlmatric);
                    echo $rowmatric['Reg_no'];    
                ?>
            </td>
            <?php
                $sqlresult = mysqli_query($conn, "SELECT * FROM `result_tbl` WHERE `stu_ID` = '".$rowmatric[0]."' ");
                $rowresult = mysqli_fetch_array($sqlresult);
                /* if($rowresult['Test'] == '' || $rowresult['Exam'] == ''){
                    
                }else{
                    $Total = $rowresult['Test'] + $rowresult['Exam'];
                } */
            ?>
            <input type="hidden" name="count" style="width: 30px;" value="<?php echo $i ?>">
            <input type="hidden" value="<?php echo $rowmatric[0] ?>" name="Reg_no[]">
            <td><input type="number" name="test<?php echo $i; ?>" style="width: 30px;" value="<?php echo $rowresult['Test'] ?>"></td>
            <td><input type="number" name="exam<?php echo $i; ?>" style="width: 30px;" value="<?php echo $rowresult['Exam'] ?>"></td>
            <td><input type="text" style="width: 30px;" value="<?php //echo $Total; ?>" disabled></td>
            <td>
            </td>
            
            <?php  $i++;?>
        </tr>
<?php endwhile; }
########### cPoints   ##################
function cPoints($Total,$tblUnit){
        //$gradepoint = 0;
    if($Total >= 70){
        $point = 5.0;
        $ttp = $tblUnit * $point;
        echo $ttp;
    }elseif($Total >= 60){
        $point = 4.0;
        $ttp = $tblUnit * $point;
        echo $ttp;
    }elseif($Total >= 50){
        $point = 3.0;
        $ttp = $tblUnit * $point;
        echo $ttp;
    }elseif($Total >= 45){
        $point = 2.0;
        $ttp = $tblUnit * $point;
        echo $ttp;
    }elseif($Total >= 40){
        $point = 1.0;
        $ttp = $tblUnit * $point;
        echo $ttp;
    }else{
        $point = 0.0;
        $ttp = $tblUnit * $point;
        echo $ttp;
    }
    //$gradepoint += $ttp; //$ttp + $ttp + $ttp + $ttp + $ttp + $ttp;
    //$gpa = $gradepoint/$totalPoint;                            
}

function cPointsNew($Total, $tblUnit) {
    $gradepoint = 0;
    if ($Total >= 70) {
        $point = 5.0;
    } elseif ($Total >= 60) {
        $point = 4.0;
    } elseif ($Total >= 50) {
        $point = 3.0;
    } elseif ($Total >= 45) {
        $point = 2.0;
    } elseif ($Total >= 40) {
        $point = 1.0;
    } else {
        $point = 0.0;
    }
    $ttp = $tblUnit * $point;
    return $ttp;
}
