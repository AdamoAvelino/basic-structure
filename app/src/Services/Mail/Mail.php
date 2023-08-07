<?php

namespace App\src\Services\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
class Mail
{
    private $smtp_host;
    private $smtp_auth;
    private $username;
    private $password;
    private $smtp_secure;
    private $port;
    private $mail;

    public function __construct(String $assunto)
    {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->CharSet = "UTF-8";
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Username = env('USERNAME');
        $this->mail->Host = env('SMTP_HOST');
        $this->mail->Password = env('PASSWORD');
        $this->mail->Port = env('PORT');
        $this->mail->Subject = $assunto;
        $this->mail->isHTML(true);
        $this->mail->setFrom(env('USERNAME'), 'Departamento de Contrato Funeral Pass');
    }

    /** 
     * -----------------------------------------------------------------------------------------------------------
     */
    public function para(String $destinatario_email, ?String $destinatario_nome = null) : void
    {
        $this->mail->addAddress($destinatario_email, $destinatario_nome);
    }
    
    /** 
     * -----------------------------------------------------------------------------------------------------------
     */
    public function comCopia(String $destinatario_email, ?String $destinatario_nome = null)
    {
        $this->mail->addCC($destinatario_email, $destinatario_nome);
    }
    /** 
     * -----------------------------------------------------------------------------------------------------------
     */
    public function anexar(String $caminho_arquivo)
    {
        $this->mail->addAttachment($caminho_arquivo);
    }
    /** 
     * -----------------------------------------------------------------------------------------------------------
     */
    public function corpo(String $conteudo) 
    {
        $this->mail->Body = $conteudo;

    }
    /** 
     * -----------------------------------------------------------------------------------------------------------
     */
    public function enviar()
    {
        $this->mail->send();
    }
}