<?php require_once("_top.php");
$name     = (!empty($_POST['name']))?FilterInput(strval($_POST['name'])):null; 
$phone    = (!empty($_POST['phone']))?FilterInput(strval($_POST['phone'])):null; 
$message  = (!empty($_POST['message']))?FilterInput(strval($_POST['message'])):null;



if (empty($name) OR empty($phone)) {
    echo $response = json_encode(array(
            "status" => false,
            "msg"    => "<div class='alert alert-danger'><strong>Enter the Details!</strong></div>" 
    ));
    die();
}
if (!ctype_digit($phone) OR strlen($phone)!=10) {
    echo $response = json_encode(array(
            "status" => false,
            "msg"    => "<div class='alert alert-danger'><strong>Enter 10 Digit Mobile Number!</strong></div>" 
    ));
    die();
}
if(!preg_match('/^[6-9][0-9]{9}$/',$phone)) {
    echo $response = json_encode(array(
            "status" => false,
            "msg"    => "<div class='alert alert-danger'><strong>Phone Number is Not Valid!</strong></div>" 
    ));
    die();
}

$time= Date('Y-m-d H:i:s');



$sql = "INSERT INTO quick_quote SET
            quote_name           = :quote_name,
            quote_phone          = :quote_phone,
            quote_req            = :quote_req,
            quote_date           = :quote_date,
            quote_ip             = :quote_ip";
            $insert = $PDO->prepare($sql);
            $insert->bindParam(':quote_name',$name);
            $insert->bindParam(':quote_phone',$phone);
            $insert->bindParam(':quote_req',$message);
            $insert->bindParam(':quote_date',$time);
            $insert->bindParam(':quote_ip',$ip);
            $insert->execute();
            if($insert->rowCount() > 0){
                echo $response = json_encode(array(
                    "status" => true,
                    "msg"    => "<div class='alert'><strong>Thank You ".$name."! Will Contact You Soon!</strong></div>" 
            ));
            }
            else {
                echo $response = json_encode(array(
                    "status" => false,
                    "msg"    => "<div class='alert alert-danger'><strong>Something is wrong</strong></div>" 
            ));
            }