<?php


namespace app\src;


use app\templates\Template;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{
    private $data;
    private $mailer;
    private $template;

    public function __construct()
    {
        $this->mailer = new PHPMailer();
    }

    public function data(array $data)
    {
        $this->data = (object)$data;
        return $this;
    }

    public function template(Template $template)
    {
        if (!isset($this->data)) {
            throw new \Exception("Antes de chamar o template, passe os dados atraves do metodo data");
        }

        $this->template = $template->run($this->data);

        return $this;
    }

    public function send()
    {
        if (!isset($this->template)) {
            throw new \Exception("Por favor, antes de enviar o email, escolha um template com o método template");
        }

        $config = (object)$this->config()->email;

        try {
            //Server settings
            $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $this->mailer->isSMTP();                                            //Send using SMTP
            $this->mailer->Host = $config->host;                                     //Set the SMTP server to send through
            $this->mailer->SMTPAuth = true;                                   //Enable SMTP authentication
            $this->mailer->Username = $config->username;                                     //SMTP username
            $this->mailer->Password = $config->password;                                     //SMTP password
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
            $this->mailer->Port = $config->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $this->mailer->CharSet = 'UTF-8';

            //Recipients
            $this->mailer->setFrom($this->data->fromEmail, $this->data->fromName);
            $this->mailer->addAddress($this->data->toEmail, $this->data->toName);     //Add a recipient

            //Content
            $this->mailer->isHTML(true);                                  //Set email format to HTML
            $this->mailer->Subject = $this->data->subject;
            $this->mailer->Body = $this->template;
            $this->mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mailer->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }

    private function config()
    {
        return (object)Load::file('/config.php');
    }
}