<?php
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$body = $_POST['body'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;  
use PHPMailer\PHPMailer\SMTP;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['body'])){
    echo '<script language="javascript">';
    echo 'alert("Please fill in all details on the form (full name, email address, subject and message)")';
    echo '</script>';
    header("Refresh:1, url=contact.php");
    exit();
}

else{
    if(isset($_POST["submit"])){

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'mhangonoelr@gmail.com';                     //SMTP username
        $mail->Password   = 'azsofdjyrottevvn';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress("bis16-nmhango@poly.ac.mw");     //Add a recipient
        $mail->addReplyTo($email, $name);                              // Add Reply to
        //$mail->addCC();                  //Add Copy address
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        if(!$mail->send()){
            echo '<script language="javascript">';
            echo 'alert("Technical Error: Your Message was not sent, Try again later")';
            echo '</script>';
            header("Refresh:1, url=contact.php");
           exit();
        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Your Message was successfully sent, Someone from AR Consultants will attend to your query as soon as possible")';
            echo '</script>';
            header("Refresh:1, url=contact.php");
           exit();
        }
    }
        
}

       
