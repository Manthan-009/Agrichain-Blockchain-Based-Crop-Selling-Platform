<?php include('smtp/PHPMailerAutoload.php');

function OTP($email,$sub, $msg){
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "agrichain.yourtraders@gmail.com";
    $mail->Password = "vioy uhpn ccul qwil";
    $mail->SetFrom("agrichain.yourtraders@gmail.com");
    $mail->Subject = $sub;
    $mail->Body = $msg;
    $mail->AddAddress($email);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => false
));
return $mail->send();
}

?>