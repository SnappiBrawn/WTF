<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';
    include "../classes/Connection.php";

    $username = $_POST["uname"];
    $password = $_POST["pword"];
    $encpassword = md5($_POST["pword"]);
    $email = $_POST["email"];
    $otp = rand(10000,99999);

    if($username=="" || $password=="" || $email==""){
        echo "All fields are mandatory!";
        die();
    }
    
    else{
        $conn = Connection::getInstance();
        $qry = "insert into inactivate_users values(?,?)";
        $exec = $conn->prepare($qry);
        $exec->execute([$username,md5($otp)]);
        $qry = "insert into users values(?,?,?,'','');";
        $exec = $conn->prepare($qry);
        $exec->execute([$email,$username,$encpassword]);
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'creativeswaroop@gmail.com';
        $mail->Password   = 'xzxpqufxcgpapcbs';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;


        $mail->setFrom('wtf.activation@gmail.com', 'Activation');
        $mail->addAddress($email, $username);    
        
        $mail->isHTML(true); 
       
        $msg="<body style='padding:10px; font-size: 2rem;background-color:lightpink'>Hey $username!<br>
        Glad you've decided to sign up for WTF's membership. <br>
        As a first step, verify your email by providing the below OPT to the app.<br>
        OTP: <b>$otp</b>
        </body>
        ";
                                
        $mail->Subject = 'Email verification code for WTF membership.';
        $mail->Body = $msg;

        $mail->send();
        echo 'Verification mail sent. Kindly check your inbox. (PS: Please wait for a minute or two before resending the code';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

?>