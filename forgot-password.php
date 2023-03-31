<?php
$connection=mysqli_connect("localhost","root","","aahemedabad");
include 'mailclass/PHPMailerAutoload.php';

$mail_smtp_secure="TLS";
$mail_host="smtp.gmail.com";
$mail_port=587;
$mail_username="womanempowerment2021@gmail.com";
$mail_password="woman*2021";
// $mail_email_send=$row_mail_setting["mail_email_send"];
$mail_title_new="Forgot Password";

//mail start
// $email_send =$mail_email_send;
$smtpsecure = $mail_smtp_secure;
$host_email = $mail_host;
$port = $mail_port;
$email_username = $mail_username;
$email_password = $mail_password;
$mail_title = $mail_title_new;
//mail end
$project_title = "Aahmedabad";
//Blank Array


$response = array();
//authentication check token name and token value

    if ((!empty($_POST["User_email"]))) { 
        $User_email = mysqli_real_escape_string($connection, $_POST["User_email"]);
        $query_check = mysqli_query($connection,"SELECT * FROM `user_master` WHERE `User_email`='{$User_email}'")or die(mysqli_error($connection));
        $count_check=mysqli_num_rows($query_check);
        if($count_check>0)
        {
               $row_user = mysqli_fetch_array($query_check);
               $password=$row_user["User_password"];
                //mail send start 
                $email_send = $User_email;
                $subject = "Forgot Password From $project_title";
                $body = "Your Password is $password";
            
                $mail = new PHPMailer;
                $mail->isSMTP();                                // Set mailer to use SMTP
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->SMTPSecure = $smtpsecure;                            // Enable TLS encryption, `ssl` also accepted
                $mail->Host = $host_email;
                $mail->Port = $port;                                    // TCP port to connect to
                $mail->Username = $email_username;                 // SMTP username
                $mail->Password = $email_password;                          // SMTP password
            
                $mail->addreplyto($email_username, $mail_title);
                $mail->setfrom($email_username, $mail_title);
            
                $mail->addaddress($email_send, $subject);
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->msgHTML($body);
            //         echo '<pre>';
            // print_r($mail);
            //                 exit;
                if (!$mail->send()) {
                    $response["flag"] = '0';
                    $response["message"] = "Email Id Not Valid";    
                }
                else{
                    $response["flag"] = '1';
                    $response["message"] = "Check Your Mail For Password";
                }
                //mail send end 


        }
        else{
            $response["flag"] = '0';
            $response["message"] = "Email Not Match With System.";
        }

    }
    //if any field is missing then this condition true
    else {
       $response["flag"] = '0';
       $response["message"] = "Required Field Is Missing";
   }



echo json_encode($response);
