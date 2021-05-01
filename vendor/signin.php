    <?php

session_start();
require_once 'connect.php';

$login_1 = $_POST['login'];
$password_1 =md5($_POST['password']);
$valid = true;

$check_user = mysqli_query($connect, "SELECT * FROM `users_reg` WHERE `login` = '$login_1' AND `password` = '$password_1'");


if (mysqli_num_rows($check_user) > 0){

    $user = mysqli_fetch_assoc($check_user);
    header('Location: ../index.php');

    $_SESSION['toastr'] = array(
        'type'      => 'success', // or 'success' or 'info' or 'warning'
        'message' => 'Hi'
    );

}else{
    header('Location: ../index.php');
    $_SESSION['toastr'] = array(
        'type'      => 'error', // or 'success' or 'info' or 'warning'
        'message' => 'Wrong login or password',
        'title'     => 'ERROR'
    );
}

?>

 
<pre>
        <?php
            print_r($user);
        ?> 
</pre>

