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
    $user_data,$permit_date, 
    $permit_category, 
    $permit_no,
    $permit_status,
    $permit_area,
    $permit_title,
    $permit_description,
    $permit_user,
    $permit_company
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
        
        $mail->setFrom('no-reply@firdgroup.com', 'Work Permit');
        // $mail->addReplyTo('no-reply@firdgroup.com', 'No Reply');
        
        // Add a recipient
        $mail->addAddress('firdausjuanda@hotmail.com');
        
        // Add cc or bcc 
        // $mail->addCC('firdaus.juanda@wilmar.co.id');
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = '[Permit] - '.$permit_title;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        $date_open = date_format(date_create($permit_date),"j M y");
        // Email body content
        $mailContent = "
        <p>Dear All,</br>
        Work Permit has just submitted as follows: </p>
            <table>
                <tr>
                    <td>Category </td>
                    <td>:</td>
                    <td><strong> $permit_category </strong></td>
                </tr>
                <tr>
                    <td>Number </td>
                    <td>:</td>
                    <td><strong> $permit_no </strong></td>
                </tr>
                <tr>
                    <td>Title </td>
                    <td>:</td>
                    <td><strong> $permit_title</strong> </td>
                </tr>
                <tr>
                    <td>Decription </td>
                    <td>:</td>
                    <td><strong> $permit_description </strong></td>
                </tr>
                <tr>
                    <td>Date </td>
                    <td>:</td>
                    <td><strong> $date_open </strong></td>
                </tr>
                <tr>
                    <td>Area </td>
                    <td>:</td>
                    <td><strong> $permit_area </strong></td>
                </tr>
                <tr>
                    <td>Status </td>
                    <td>:</td>
                    <td><strong> $permit_status </strong></td>
                </tr>
                <tr>
                    <td>User </td>
                    <td>:</td>
                    <td><strong> $permit_user </strong></td>
                </tr>
                <tr>
                    <td>Company </td>
                    <td>:</td>
                    <td><strong> $permit_company </strong></td>
                </tr>
            </table>
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

    function sendWorkEmail(
        $work_date_open, 
        $work_area, 
        $work_title,
        $work_status,
        $work_exact_place,
        $work_user,
        $work_company)
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
        
        $mail->setFrom('no-reply@firdgroup.com', 'Workline');
        // $mail->addReplyTo('no-reply@firdgroup.com', 'No Reply');
        
        // Add a recipient
        $mail->addAddress('firdausjuanda@hotmail.com');
        
        // Add cc or bcc 
        // $mail->addCC('firdaus.juanda@wilmar.co.id');
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = '[Work] Create - '.$work_title;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        
        $date_open = date_format(date_create($work_date_open),"j M y");
        // Email body content
        $mailContent = "
        <p>Dear All,</br>
        Work has just created with following details: </p>
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
                    <td>Exact Place </td>
                    <td>:</td>
                    <td> $work_exact_place </td>
                </tr>
                <tr>
                    <td>Status </td>
                    <td>:</td>
                    <td> $work_status </td>
                </tr>
                <tr>
                    <td>User </td>
                    <td>:</td>
                    <td> $work_user</td>
                </tr>
                <tr>
                    <td>Company </td>
                    <td>:</td>
                    <td> $work_company </td>
                </tr>
            </table>
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

    function sendWorkCompleteEmail(
        $work_date_open, 
        $work_date_close, 
        $work_area,
        $work_title,
        $work_status,
        $work_user_close,
        $work_company)
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
        
        $mail->setFrom('no-reply@firdgroup.com', 'Workline');
        // $mail->addReplyTo('no-reply@firdgroup.com', 'No Reply');
        
        // Add a recipient
        $mail->addAddress('firdausjuanda@hotmail.com');
        
        // Add cc or bcc 
        // $mail->addCC('firdaus.juanda@wilmar.co.id');
        // $mail->addBCC('bcc@example.com');
        
        // Email subject
        $mail->Subject = '[Work] Complete - '.$work_title;
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        
        // $date_open = date_format(date_create($work_date_open),"j M y");
        // Email body content
        $mailContent = "
        <p>Dear All,</br>
        Work has just <strong>completed</strong> with following details: </p>
            <table>
                <tr>
                    <td>Title </td>
                    <td>:</td>
                    <td> $work_title </td>
                </tr>
                <tr>
                    <td>Start </td>
                    <td>:</td>
                    <td> $work_date_open </td>
                </tr>
                <tr>
                    <td>Complete </td>
                    <td>:</td>
                    <td> $work_date_close </td>
                </tr>
                <tr>
                    <td>Area </td>
                    <td>:</td>
                    <td> $work_area </td>
                </tr>
                <tr>
                    <td>Status </td>
                    <td>:</td>
                    <td> $work_status </td>
                </tr>
                <tr>
                    <td>User </td>
                    <td>:</td>
                    <td> $work_user_close</td>
                </tr>
                <tr>
                    <td>Company </td>
                    <td>:</td>
                    <td> $work_company </td>
                </tr>
            </table>
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