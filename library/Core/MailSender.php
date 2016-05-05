<?php
namespace Core;
use Flywheel\Config\ConfigHandler;
use Flywheel\Exception;

class MailSender {
    protected static $_transporter;

    protected
                $reciver = array(),
                $subject = '',
                $body = '',
                $replyTo = '',
                $attach_file = '',
                $replyName = '';

//    protected

    public function setReciver($reciver){

        if(is_string($reciver) && $reciver!='') $recivers[] = $reciver;
        else $recivers = $reciver;

        $lastReciver = array();
        if(!empty($recivers)){
            foreach ($recivers as $reciver){
                array_push($lastReciver, $reciver);
            }
        }
        $this->reciver = $lastReciver;
    }

    public function getReciver(){
        return (!empty($this->reciver)?$this->reciver:false);
    }

    public function setSubject($subject){
        $this->subject = $subject;
    }

    public function getSubject(){
        return $this->subject;
    }

    public function setAttachFile($path_file){
        if($path_file != '' && file_exists($path_file)){
            $this->attach_file = $path_file;
        }else{
            $this->attach_file = '';
        }
    }

    public function getAttachFile(){
        return $this->attach_file;
    }

    public function setBody($body){
        $this->body = $body;
    }

    public function getBody(){
        return $this->body;
    }



    public function setReplyTo($replyTo) {
        $this->replyTo = $replyTo;
    }
    public function getReplyTo(){

        if(!$this->replyTo || $this->replyTo == ''){
            $sender = ConfigHandler::get('mail.default_sender');
            $this->replyTo = $sender['mail'];
        }
        return $this->replyTo;
    }


    public function setReplyName($replyName) {
        $this->replyName = $replyName;
    }

    public function getReplyName(){
        if(!$this->replyName || $this->replyName == ''){
            $sender = ConfigHandler::get('mail.default_sender');
            if(isset($sender['first_name']) && isset($sender['last_name'])) {
                $this->replyName = $sender['first_name'].' '.$sender['last_name'];
            }
        }

        return $this->replyName;
    }


    public function send() {
        try{
            $transport = self::getTransport();
            if(!$transport){
                throw new Exception('Mail config is wrong !');
            }

            $mailer = \Swift_Mailer::newInstance($transport);

            $message = \Swift_Message::newInstance($this->getSubject(), $this->getBody(),'text/html','utf-8');

            $numSent = 0;

            $receivers = $this->getReciver();
            if(empty($receivers)) throw new Exception('Recivers empty !');


            if(!empty($receivers)){
                foreach ($receivers as $name => $email) {
                    if (is_int($name)) $message->setTo($email);
                    else $message->setTo($email, $name);

                    if (null !== $this->getReplyTo()) {
                        $message->setFrom($this->getReplyTo(), $this->getReplyName());
                    }

                    if($this->getAttachFile() != ''){
                        $message->attach(\Swift_Attachment::fromPath($this->getAttachFile()));
                    }

                    $numSent += $mailer->send($message);
                }
            }
            return $numSent;
        }catch (\Exception $e){
            throw new \Flywheel\Exception('exception when send mail: '.$e->getMessage());
        }

    }

    /**
     * @return \Swift_SmtpTransport
     */
    public static function getTransport() {
        $mailConfig = ConfigHandler::get('mail');
        if(!$mailConfig || empty($mailConfig)) return false;

        if (self::$_transporter == null) {
            self::$_transporter =  \Swift_SmtpTransport::newInstance($mailConfig['host'], $mailConfig['port'], $mailConfig['security'])
                ->setUsername($mailConfig['username'])
                ->setPassword($mailConfig['password']);
        }

        return self::$_transporter;
    }

}