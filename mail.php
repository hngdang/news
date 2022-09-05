<?php
    function sendMail($email,$subject,$body,$purpose){
        require "PHPMailer/src/PHPMailer.php";
        require "PHPMailer/src/SMTP.php";
        require "PHPMailer/src/Exception.php";

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->CharSet    = 'utf-8';
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '';
            $mail->Password   = '';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('', '');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->smtpConnect( array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_nam" => false,
                    "allow_self_signed" => true
                )
            ));

            $mail->send();
            if($purpose == 1){
                set_flash_session('mess_flash','Chúng tôi đã gửi đến địa chỉ email: ' . $email . ' một đường dẫn để kích hoạt tài khoản của bạn. Xin vui lòng hãy kiểm tra email để được hướng dẫn');
                redirect('login.php');
            }
            elseif($purpose == 2){
                set_flash_session('mess_flash','Chúng tôi đã gửi đến địa chỉ email: ' . $email . ' một đường dẫn để khôi phục mật khẩu của bạn. Xin vui lòng hãy kiểm tra email để được hướng dẫn');
                redirect('login.php');
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>