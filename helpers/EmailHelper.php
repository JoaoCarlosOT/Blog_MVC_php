<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Email
{
    public function SendEmail($username, $email)
    {
        $mail = new PHPMailer();
        try {

            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 465;
            $mail->Username = '3a53c8f6bfed15';
            $mail->Password = '64d85c8b163520';
        
            
            $mail->setFrom('joaocarlosoliveirateixeira69@gmail.com', 'João Carlos');
            $mail->addAddress($email);               
        
            
            $mail->isHTML(true);                                  
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'Hello, vem vindo ao sistema, crie quantas tarefas quiser!!! <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'email enviado com sucesso';
        } catch (Exception $e) {
            echo "Não foi possivel enviar o email. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}



?>