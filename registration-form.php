<?php

/* All Codes By https://github.com/EduardoMoreiraDeSouza */

date_default_timezone_set('America/Sao_Paulo');
require_once "./funcoes.php";

$full_name = ucwords(addslashes($_POST['full-name']));
$email = strtolower(addslashes($_POST['email']));

$password = hash('sha256', addslashes($_POST['password']));
$confirm_password = hash('sha256', addslashes($_POST['confirm-password']));

$picture = $_FILES['profile-picture'];
$date_birth = addslashes($_POST['date-birth']);
$referrer = ucwords(addslashes($_POST['referrer']));
$bio = ucwords(addslashes($_POST['bio']));
$account_type = addslashes($_POST['account-type']);
$terms_conditions = addslashes($_POST['terms-and-conditions']);
$directory = "./images/";

if (
    empty($full_name) or 
    empty($email) or 

    $password == 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855' or 
    $confirm_password == 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855' or 

    empty($picture) or 
    empty($date_birth) or 
    empty($referrer) or 
    empty($bio) or 
    empty($account_type) 
) {

    communication('empty');
    redirect('index.html');
    exit();

}

elseif ($password != $confirm_password) {

    communication('password_not_confirmed');
    redirect('index.html');
    exit();

}

elseif (!check_age($date_birth)) {

    redirect('index.html');
    exit();

}

elseif ($terms_conditions != 'on') {

    communication('terms_conditions');
    redirect('index.html');
    exit();

}

$id_picture = md5(random_int(0, 1000)).get_extension($picture);

$connection_db = connect_database();
$code_my_sql = "INSERT INTO all_users VALUES ('$full_name', '$email', '$password', '$id_picture', '$date_birth', '$referrer', '$bio', '$account_type', '".date('Y-m-d')."')";

mysqli_query($connection_db, $code_my_sql);

move_uploaded_file($_FILES['profile-picture']['tmp_name'], $directory . $id_picture);

communication('successfully_registered_data');
redirect('index.html');
exit();

/* All Codes By https://github.com/EduardoMoreiraDeSouza */

?>