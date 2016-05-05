<?php
namespace Background\Library;
use Flywheel\Exception;

class EmailHelper {

    public static function sendEmail($data) {
        if(is_object($data)) $data = json_encode($data);
        try {
            $mail = new \MailHelper();
            $mailSent = $data['email'];
            if(isset($data['email'])) {
                $mail->setReciver($data['email']);
            }
            if(isset($data['subject'])) {
                $mail->setSubject($data['subject']);
            }

            if(isset($data['body'])) $mail->setBody($data['body']);

            if(isset($data['replyTo'])) {
                $mail->setReplyTo($data['replyTo']);
            }

            if(isset($data['replyName'])) {
                $mail->setReplyName($data['replyName']);
            }

            if(isset($data['attach_file']) && $data['attach_file'] !='') {
                $mail->setAttachFile($data['attach_file']);
            }
            $mail->send();
            return $mailSent;

        } catch(\Swift_SwiftException $se) { }
        catch(\Exception $e){

        }
        return false;
    }
}
