<?php
    date_default_timezone_set('Asia/Kolkata');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once FCPATH."plugin/PHPMailer/src/Exception.php";
    require_once FCPATH."plugin/PHPMailer/src/PHPMailer.php";
    require_once FCPATH."plugin/PHPMailer/src/SMTP.php";
    class mailer{
        public $setMail;
        function config(){
            $data['email_host']			= 'smtp.gmail.com';
            $data['email_username']		= 'test@sansoftwares.com';
            $data['email_password']		= 'Sansoftwares@1806';
            $data['email_port']			= 587; 
            $data['email_display_name']	= 'Purchase Bill';
            $data['is_ssl']	= 0;
            return (object)$data;
        }
        function mailConfig() {
            $mail = $this->config();
            if (empty($mail->email_host) or empty($mail->email_username) or empty($mail->email_password)) {
                return json_encode(array('status' => false, 'message' => 'Mail configuration not exist, Please check branch setting'));
            }
            $this->setMail = new PHPMailer();
            //Server settings
            $this->setMail->SMTPDebug = 0;
            //SMTP::DEBUG_SERVER;
            $this->setMail->isSMTP();
            // Send using SMTP
            $this->setMail->Host = $mail->email_host;
            // Set the SMTP server to send through
            $this->setMail->SMTPAuth = true;
            // Enable SMTP authentication
            $this->setMail->Username = $mail->email_username;
            $this->setMail->From = $mail->email_username;
            $this->setMail->FromName = $mail->email_display_name;
            // SMTP username
            $this->setMail->Password = $mail->email_password;
            // SMTP password
            $this->setMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $this->setMail->Port = $mail->email_port ? $mail->email_port : 587;
            $this->setMail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
            //$this->setMail->SMTPSecure = 'ssl';                               // TCP port to connect to
            // //Recipients
            $this->setMail->SMTPSecure = 'tls';
            //  if ($mail->is_ssl == 1)
            //     $this->setMail->SMTPSecure = 'ssl';
            $this->setMail->isHTML(true);
            $this->setMail->setFrom($mail->email_username, $mail->email_display_name);
        }

        function sendEmail($to = '', $sub = '', $msg = '', $data = array()) {
            $this->mailConfig();
            if (empty($to) or empty($sub) or empty($msg)) {
                return json_encode(array('statusCode' => false, 'msg' => 'To/Subject/Message are required fields'));
            }
            try {
                $this->setMail->addAddress($to, '');

                if (!empty($data['cc'])) {
                    $this->setMail->addCC($data['cc']);
                }
                if (!empty($data['StringAttachment'])) { 
                    foreach($data['StringAttachment'] as $sa){
                        $this->setMail->addStringAttachment($sa['html'], $sa['name']);
                    }
                }
                if (!empty($data['attachment'])) {
                    foreach($data['attachment'] as $at){ 
                        $this->setMail->addAttachment($at['file'],$at['name']);
                    }
                }

                $this->setMail->Subject = $sub;
                $this->setMail->Body = $msg;
                //$this->setMail->AltBody = 'This is the body in plain text for non-HTML mail clients'; 
                $this->setMail->isHTML(true);
                if ($this->setMail->send()) {
                   return ( json_encode(array('status' => true, 'message' => 'Message has been sent')));
                } else {
                    return ( json_encode(array('status' => false, 'message' => "Message could not configured mail. Mailer Error : " . $this->setMail->ErrorInfo)));
                }
            } catch (Exception $e) {
                return (json_encode( array('status' => false, 'message' => "Message could not be sent. Mailer Error: " . $this->setMail->ErrorInfo)));
            }
        }

        function sendotp($to='', $sub='', $msg='' ){
            $this->mailConfig();
            if (empty($to) or empty($sub) or empty($msg)) {
                return json_encode(array('status' => false, 'message' => 'To/Subject/Message are required fields'));
            }
            try {
                $this->setMail->AddAddress($to);
                $this->setMail->Subject = $sub;
                $this->setMail->Body = 'Your One Time PAssword is '. $msg;
                $this->setMail->isHTML(true);
                if ($this->setMail->send()) {
                   return (json_encode(array('statusCode' => true, 'msg' => 'Message has been sent')));
                } else {
                    return ( json_encode(array('statusCode' => false, 'msg' => "Message could not configured mail. Mailer Error : " . $this->setMail->ErrorInfo)));
                }
            } catch (Exception $e) {
                return (json_encode( array('statusCode' => false, 'msg' => "Message could not be sent. Mailer Error: " . $this->setMail->ErrorInfo)));
            }

        }
    }
