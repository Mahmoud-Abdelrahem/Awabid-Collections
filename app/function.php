<?php


//function PATH
function path($go){
echo"
    <script>
    window.location.replace('/Awabid_Collection-main/$go')
    </script>   
    ";
}



//function auth()

function auth($rule2 = null, $rule3 = null)
{
    if (isset($_SESSION['users'])) {
        if ($_SESSION['users']['role'] == 1 || $_SESSION['users']['role'] == $rule2) {
        } else {
            path("401.php");
        }
    }
}

// logout
function logout()
{
    session_destroy();
    session_unset();
    path('login.php');
}



// required
function required($input_value) {
    return !empty($input_value);
}



?>