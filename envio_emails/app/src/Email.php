<?php


namespace app\src;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{
    private $data;

    public function data(array $data)
    {
        $this->data = (object)$data;
        return $this;
    }

    public function template($template)
    {
        if (!isset($this->data)) {
            throw new \Exception("Antes de chamar o template, passe os dados atraves do metodo data");
        }
    }

    public function send()
    {
        $mailer = new PHPMailer(true);

        try {
            //Server settings
            $mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mailer->isSMTP();                                            //Send using SMTP
            $mailer->Host       = '';                                     //Set the SMTP server to send through
            $mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mailer->Username   = '';                                     //SMTP username
            $mailer->Password   = '';                                     //SMTP password
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
            $mailer->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mailer->setFrom('from@example.com', 'Mailer');
            $mailer->addAddress('joe@example.net', 'Joe User');     //Add a recipient

            //Content
            $mailer->isHTML(true);                                  //Set email format to HTML
            $mailer->Subject = 'Assunto';
            $mailer->Body    = 'template';
            $mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
        }
    }
}