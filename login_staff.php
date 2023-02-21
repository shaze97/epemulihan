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
$pass=validate($_POST['password']);

$sql="SELECT * FROM staffs WHERE id='$id' AND pass='$pass'";
$conn = OpenCon();
$result=mysqli_query($conn,$sql);


//nanti tuka kpd 1 sbb result patut 1 je..ni sbb db problem ade 2 data same(solution: buat id jadi unique)
if(mysqli_num_rows($result)===1){
    $row=mysqli_fetch_assoc($result);

    if($row['id']===$id && $row['pass']===$pass){
        echo '<script>alert("successfully log in")</script>';
    }

    $_SESSION['id']=$row['id'];
    $_SESSION['name']=$row['name'];
    

    header("Location:Staff_page.php");
    exit();
}

?>