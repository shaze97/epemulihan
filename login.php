<?php
session_start();

include 'conn.php';

if (isset($_POST['id']) && isset($_POST['password'])){
    function validate($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
}

$id=validate($_POST['id']);
$pwd=validate($_POST['password']);

if(CRYPT_MD5 == 1) {
    $pass = crypt($pwd, '$12$hrd$reer');
}

$sql="SELECT * FROM teacher WHERE id='$id' AND passwords='$pass'";
$conn = OpenCon();
$result=mysqli_query($conn,$sql);



if(mysqli_num_rows($result)===1){
    $row=mysqli_fetch_assoc($result);

    if($row['id']===$id && $row['passwords']===$pass){
        echo '<script>alert("successfully log in")</script>';
    }

    $_SESSION['id']=$row['id'];
    $_SESSION['names']=$row['nameS'];
    $_SESSION['phone']=$row['phone'];
    

    header("Location:teacher_page.php");
    exit();
}

?>