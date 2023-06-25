<?php

/* All Codes By https://github.com/EduardoMoreiraDeSouza */

function communication($type) {

    $empty = "Please, Fill In All Fields";
    $age = "The Minimum Age Is 13 Years Old";
    $password_not_confirmed = "Password And Password Confirmation Do Not Match!";
    $terms_conditions = "To Continue, You Must Agree To The Terms And Conditions!";
    $successfully_registered_data = "Congratulations, your data has been sucessfully registered!";

    echo "
    
        <script>
            alert('".$$type."')
        </script>

    ";

}

function redirect($destiny) {

    echo "
    
        <script>
            window.location.href = `./$destiny`
        </script>

    ";

}

function get_extension($file) {

    if (!isset($file) or empty($file)) return false;

    $name_file = $file['name'];

    $characters = str_split($name_file);
    $last_character_position = count($characters)-1;
    $extension = array();
    $last_character = "";
    
    while ($last_character != ".") {

        $last_character = $characters[$last_character_position];
        array_unshift($extension, $last_character);

        $last_character_position--;

    }

    return strtolower(implode($extension));

}

function check_age($date_of_birth) {

    $date_of_birth = intval(str_replace('"', "", str_replace("'", "", $date_of_birth)));
    $current_date = date('d-m-Y');

    $day = intval(substr($current_date, 0, 2));
    $month = intval(substr($current_date, 3, 2));
    $year = intval(substr($current_date, 6, 5));

    $year_of_birth = intval(substr($date_of_birth, 0, 4));
    $month_of_birth = intval(substr($date_of_birth, 5, 2));
    $day_of_birth = intval(substr($date_of_birth, 8, 5));

    $years = $year - $year_of_birth;
    $months = $month - $month_of_birth;
    $days = $day - $day_of_birth;

    if ($months < 0 or $days < 0) {
        $years = $years - 1;
    }

    if ($years >= 13) {

        return true;

    }

    communication('age');
    return false;

}

function create_database() {

    $server = "localhost";
    $user = "root";
    $server_password = '';
    $db_name = "";
    $connection_db = mysqli_connect($server, $user, $server_password, $db_name);

    $code_my_sql = "CREATE DATABASE registration_form DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;";

    mysqli_query($connection_db, $code_my_sql);
    
    $connection_db = connect_database();

    $code_my_sql = "CREATE TABLE all_users(

        full_name VARCHAR(60),
        
        email VARCHAR(60) NOT NULL PRIMARY KEY,
        current_password VARCHAR(64) NOT NULL,
        profile_picture VARCHAR(15) NOT NULL,
        date_of_birth DATE,

        referrer VARCHAR(28) NOT NULL,
        bio VARCHAR(100) NOT NULL,
        
        account_type VARCHAR(8) NOT NULL,
        date_terms_conditions_accepted DATE
    
    ) DEFAULT CHARSET = utf8;";

    return (bool)mysqli_query($connection_db, $code_my_sql);

}

function drop_database() {

    $connection_db = connect_database();

    $code_my_sql = "DROP DATABASE registration_form;";
    return (bool)mysqli_query($connection_db, $code_my_sql);

}

function connect_database() {

    $server = "localhost";
    $user = "root";
    $server_password = '';
    $db_name = "registration_form";
    $connection_db = mysqli_connect($server, $user, $server_password, $db_name);

    return $connection_db;

}

/* All Codes By https://github.com/EduardoMoreiraDeSouza */

?>