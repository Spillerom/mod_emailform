<?php

// 
function GetPostVar($var) {
    // 
    if( !isset($_POST[$var] )) {
        die('{"status":"error","message":"Empty post variables detected"}');
    } else {
        return $_POST[$var];
    }
}

//
$name = GetPostVar('name');
$email = GetPostVar('email');
$phone = GetPostVar('phone');
$postnumber = GetPostVar('postnumber');
$residencesize = GetPostVar('residencesize');
$message = GetPostVar('message');
$pagetitle = GetPostVar('pagetitle');
$ipaddress = GetPostVar('ipaddress');
$browser = GetPostVar('browser');
$os = GetPostVar('os');
$screenresolution = GetPostVar('screenresolution');
$referrerurl = GetPostVar('referrerurl');

// 
$id = ModEmailFormHelper::storeFormData($name, $email, $phone, $postnumber, $residencestyle, $message, $pagetitle, $ipaddress, $browser, $os, $screenresolution, $referrerurl);

// 
echo '{"status":"ok","insert_id": '.$id.',"message":"Everything OK! Data was successfully inserted!"}';
