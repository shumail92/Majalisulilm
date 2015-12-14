<?php
/**
 * Created by PhpStorm.
 * User: Shumail Mohy-ud-Din
 * Date: 12/14/2015
 * Time: 5:51 PM
 */

//logout file
?>

<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
    header("Location: samaritan_machine.php"); // Redirecting To Home Page
}
?>

