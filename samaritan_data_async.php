<?php
/**
 * Created by PhpStorm.
 * User: Shumail Mohy-ud-Din
 * Date: 12/14/2015
 * Time: 3:05 PM
 * -- session sahi krna ha
 */
?>

<?php
session_start();
$ret['errorCode']=0;

//if(  !isset(  $_SESSION['user_id'])  ){
//    $ret['errorCode']=1;
//}
//if(!isset(  $_SESSION['user_type']) ||  $_SESSION['user_type'] != 2){
//    $ret['errorCode']=1;
//}

if($ret['errorCode'] == 0){

    include 'db_connect.php';
    $query = "SELECT * FROM  `videos_detail` ";
    if ($result = $mysqli->query($query)) {
        $i=0;
        /* fetch associative array */
        while ($row = $result->fetch_assoc()) {
            $ret["data"][$row["id"]]=$row;
            $i=$i+1;

        }

        /* free result set */
        $result->free();
        $ret['count']=$i;
    }
    echo json_encode($ret);
}else{
    echo json_encode($ret);
}

?>

