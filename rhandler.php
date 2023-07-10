<?php 
print_r($_POST);
$conn=new mysqli('localhost','root','','solenox');
$a=mysqli_real_escape_string($conn,$_POST['email']);
$b=mysqli_real_escape_string($conn,$_POST['login']);
$pass=md5($_POST['password']);
$sql="SELECT * from users where email='$a' OR login='$b'";
$insert="INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES (NULL, '$b', '$pass', '$a')";
$result = $conn->query($sql);
print_r($result);
if($result->num_rows==0){
    $result = $conn->query($insert);
    print_r($result);
    if($result==1){

    }else{
        die('с вашим запросом что-то произошло <p><a>Отправить администрации</a></p>');
    }
}else{
    die(header('Location: http://www.example.com/'));
}
$sql="SELECT * from users where email='$a' AND login='$b' AND password='$pass'";
$result = $conn->query($sql);
foreach($result as $row){
    $id=$row['id'];
}
setcookie('user',$id,time()+36000,'/','localhost',true,true);
//print_r($result);
//die(header('Location: http://localhost/solenox/index.php'));