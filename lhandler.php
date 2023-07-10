<?php
//print_r($_POST);

$login=$_POST['loginormail'];
$conn=new mysqli('localhost','root','','solenox');
$a=mysqli_real_escape_string($conn,$login);
$b=mysqli_real_escape_string($conn,$_POST['password']);
$b=md5($b);
//echo $b;
$sql="SELECT * from users where login='$a' AND password='$b'";
$result = $conn->query($sql);
if($result->num_rows==0){
    $sql="SELECT * from users where email='$a' AND password='$b'";
    $result = $conn->query($sql);
    if($result->num_rows==0){
        die(header('Location: http://www.example.com/'));
    }
    
}
foreach($result as $row){
    $id=$row['id'];
}
setcookie('user',$id,time()+36000,'/','localhost',true,true);
//print_r($result);
die(header('Location: http://localhost/solenox/index.php'));