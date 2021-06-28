<?php

class Email_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');
        
        
    }
    public function sendPermitEmail(
        $permit_to_send,
        $user_company,
        $email_managers,
        $email_area,
        $email_user,
        $user_firstname,
        $user_lastname
    )
    {
        
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'mail.firdgroup.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@firdgroup.com';
        $mail->Password = 'Juanda12325800*';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('no-reply@firdgroup.com', "$user_firstname $user_lastname");
        // $mail->addReplyTo('no-reply@firdgroup.com', 'No Reply');
        
        // Add a recipient
        $mail->addAddress($email_user);   

        foreach($email_area as $v)
        {
            $mail->addAddress($v['user_email']);   
        }

        foreach($email_managers as $v)
        {
            //Add cc or bcc
            $mail->addCC($v['user_email']);
        }
        // Email subject
        $mail->Subject = 'Work Permits Released';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // $date_open = date_format(date_create($permit_date),"j M y");
        // Email body content
        $mailContent = "
        <style>
            table, td, th {
            border: 1px solid black;
            }

            table {
            width: 100%;
            border-collapse: collapse;
            }
        </style>
        <p><strong>$user_firstname $user_lastname ($user_company)</strong> has just released the following work permit: </p>
        <table>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Area</th>
                <th>Title</th>
                <th>Category</th>
                <th>No</th>
                <th>Description</th>
                <th>Giver</th>
                <th>APD</th>
                <th>Tools</th>
            </tr>
        ";
        $i = 1;
        foreach($permit_to_send as $permit)
        {   
            $category = $permit['permit_category'];
            $no = $permit['permit_no'];
            $title = $permit['permit_title'];
            $area = $permit['permit_area'];
            $description = $permit['permit_description'];
            $date = $permit['permit_date'];
            $apd = $permit['permit_apd'];
            $tools = $permit['permit_tools'];
            $giver = $permit['permit_giver'];   
            $mailContent .= "
            
            <tr>
                <td>$i</td>
                <td>$date</td>
                <td>$area</td>
                <td>$title</td>
                <td>$category</td>
                <td>$no</td>
                <td>$description</td>
                <td>$giver</td>
                <td>$apd</td>
                <td>$tools</td>
            </tr>
            
            ";
            
        $i++;
        }
            
        $mailContent .= "
            </table>
            This email is auto-generated to notify activities on <a href='https://winpad.firdgroup.com/login'>Winpad<a>.
            <p>Sincerely,</p>
            <p><strong>Winpad System</strong></p>
            ";
        $mail->Body = $mailContent;
        
        // Send email
        // if(!$mail->send()){
        //     echo 'Message could not be sent.';
        //     echo 'Mailer Error: ' . $mail->ErrorInfo;
        //     die;
        // }else{
        return $mail->send();
        // }
    }
    function sendWorkEmail(
        $work_date_open, 
        $work_vendor, 
        $work_area, 
        $work_title,
        $work_exact_place,
        $work_company,
        $email_managers,
        $email_area,
        $email_user,
        $user_firstname,
        $user_lastname)
    {
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'mail.firdgroup.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@firdgroup.com';
        $mail->Password = 'Juanda12325800*';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('no-reply@firdgroup.com', "$user_firstname $user_lastname");
        // $mail->addReplyTo('no-reply@firdgroup.com', 'No Reply');
        
        
        // Add a recipient
        $mail->addAddress($email_user);   

        foreach($email_area as $v)
        {
            $mail->addAddress($v['user_email']);   
        }

        foreach($email_managers as $v)
        {
            //Add cc or bcc
            $mail->addCC($v['user_email']);
        }
        
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = 'Work Created from '.$work_vendor.' - '.$work_title;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        
        $date_open = date_format(date_create($work_date_open),"j M y");
        // Email body content

        $mailContent = "
        <p> <strong>$user_firstname $user_lastname ($work_vendor)</strong> has just started new work with following details: </p>
            <table>
                <tr>
                    <td>Title </td>
                    <td>:</td>
                    <td> $work_title </td>
                </tr>
                <tr>
                    <td>Date </td>
                    <td>:</td>
                    <td> $date_open </td>
                </tr>
                <tr>
                    <td>Area </td>
                    <td>:</td>
                    <td> $work_area </td>
                </tr>
                <tr>
                    <td>Specific Place </td>
                    <td>:</td>
                    <td> $work_exact_place </td>
                </tr>
            </table>
            </br>
            This email is auto-generated to notify activities on <a href='https://winpad.firdgroup.com/login'>Winpad<a>.
            <p>Sincerely,</p>
            <p><strong>Winpad System</strong></p>
            ";
        $mail->Body = $mailContent;
        
        // Send email
        // if(!$mail->send()){
        //     echo 'Message could not be sent.';
        //     echo 'Mailer Error: ' . $mail->ErrorInfo;
        // }else{
            return $mail->send();
        //     echo "Success";
        // }
    }

    function sendWorkCompleteEmail(
        $work_area, 
        $work_exact_place, 
        $work_date_open,
        $work_date_close,
        $work_title,
        $work_status,
        $work_company,
        $user_firstname,
        $user_lastname,
        $email_area,
        $email_user,
        $email_managers
        )
    {
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'mail.firdgroup.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@firdgroup.com';
        $mail->Password = 'Juanda12325800*';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('no-reply@firdgroup.com', "$user_firstname $user_lastname");
        // $mail->addReplyTo('no-reply@firdgroup.com', 'No Reply');
        
        // Add a recipient
        $mail->addAddress($email_user);   

        foreach($email_area as $v)
        {
            $mail->addAddress($v['user_email']);   
        }

        foreach($email_managers as $v)
        {
            //Add cc or bcc
            $mail->addCC($v['user_email']);
        }
        // Email subject
        $mail->Subject = 'Work Completed by '.$work_company.' - '.$work_title;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        
        // $date_open = date_format(date_create($work_date_open),"j M y");
        // Email body content
        $mailContent = "
        <p> <strong>$user_firstname $user_lastname ($work_company)</strong> has just completed a work with as follows: </p>
            <table>
                <tr>
                    <td>Title </td>
                    <td>:</td>
                    <td> $work_title </td>
                </tr>
                <tr>
                    <td>Date Start</td>
                    <td>:</td>
                    <td> $work_date_open </td>
                </tr>
                <tr>
                    <td>Area </td>
                    <td>:</td>
                    <td> $work_area </td>
                </tr>
                <tr>
                    <td>Status </td>
                    <td>:</td>
                    <td> CLS </td>
                </tr>
                <tr>
                    <td>Specific Place </td>
                    <td>:</td>
                    <td> $work_exact_place </td>
                </tr>
            </table>
            </br>
            This email is auto-generated to notify activities on <a href='https://winpad.firdgroup.com/login'>Winpad<a>.
            <p>Sincerely,</p>
            <p><strong>Winpad System</strong></p>
            ";
        $mail->Body = $mailContent;
        
        // Send email
        // if(!$mail->send()){
        //     echo 'Message could not be sent.';
        //     echo 'Mailer Error: ' . $mail->ErrorInfo;
        // }else{
        return $mail->send();
        // }
    }

    function sendCommentEmail(
        $work_area, 
        $work_exact_place,
        $work_title,
        $work_company,
        $user_commenter_firstname,
        $user_commenter_lastname,
        $user_commenter_company,
        $email_area,
        $email_user,
        $email_managers,
        $email_worker,
        $comment_text
        )
    {
        // PHPMailer object
        $mail = $this->phpmailer_lib->load();
        
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'mail.firdgroup.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@firdgroup.com';
        $mail->Password = 'Juanda12325800*';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        
        $mail->setFrom('no-reply@firdgroup.com', "$user_commenter_firstname $user_commenter_lastname");
        // $mail->addReplyTo('no-reply@firdgroup.com', 'No Reply');
        
        // Add a recipient
        $mail->addAddress($email_user);   

        foreach($email_area as $v)
        {
            $mail->addAddress($v['user_email']);   
        }
        foreach($email_worker as $v)
        {
            $mail->addAddress($v['user_email']);   
        }

        foreach($email_managers as $v)
        {
            //Add cc or bcc
            $mail->addCC($v['user_email']);
        }
        // Email subject
        $mail->Subject = $work_title;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        
        // $date_open = date_format(date_create($work_date_open),"j M y");
        // Email body content
        $mailContent = "
        <p> <strong>$user_commenter_firstname $user_commenter_lastname ($user_commenter_company)</strong> commented on this work: </p>
            <table>
                <tr>
                    <td>Title </td>
                    <td>:</td>
                    <td> $work_title </td>
                </tr>
                <tr>
                    <td>Area </td>
                    <td>:</td>
                    <td> $work_area </td>
                </tr>
                <tr>
                    <td>Specific Place </td>
                    <td>:</td>
                    <td> $work_exact_place </td>
                </tr>
                <tr>
                    <td>Comment </td>
                    <td>:</td>
                    <td> <strong>$comment_text</strong> </td>
                </tr>
            </table>
            </br>
            This email is auto-generated to notify activities on <a href='https://winpad.firdgroup.com/login'>Winpad<a>.
            <p>Sincerely,</p>
            <p><strong>Winpad System</strong></p>
            ";
        $mail->Body = $mailContent;
        
        // Send email
        // if(!$mail->send()){
        //     echo 'Message could not be sent.';
        //     echo 'Mailer Error: ' . $mail->ErrorInfo;
        // }else{
        return $mail->send();
        // }
    }
}
