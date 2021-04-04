<?php

class Email_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }
    public function sendEmail(
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
        $smtp_server = 'smtp.googlemail.com';
        $smtp_port = 465;
        $email = 'winpadsystem@gmail.com';
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => $smtp_server,
            'smtp_user' => $email,
            'smtp_pass' => 'Winpad12325800*',
            '_smtp_auth' => TRUE,
            'smtp_port' => $smtp_port,
            'smtp_crypto' => 'ssl',
            'emailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];
        $target = [
            $user_data['user_email'],
        ];
        $body_mail = 'Dear ';
        $body_mail .= $user_data['user_username'];
        $body_mail .= '

Work permit submitted with following details:

';
        $body_mail .= '
Date                 :';
        $body_mail .= $permit_date;
        
        $body_mail .= '
Category            :';
        $body_mail .= $permit_category;
        
        $body_mail .= '
No.          :';
        $body_mail .= $permit_no;
        
$body_mail .= '
Status       :';
        $body_mail .= $permit_status;
        
$body_mail .= '
Area         :';
        $body_mail .= $permit_area;
        
$body_mail .= '
Title        :';
        $body_mail .= $permit_title;
        
$body_mail .= '
Desciption   :';
        $body_mail .= $permit_description;
        
$body_mail .= '
User         :';
        $body_mail .= $permit_user;
        
$body_mail .= '
Company      :';
        $body_mail .= $permit_company;
        $body_mail .= '

        ';
        $body_mail .= '
Sincerely
Permit System 
by Winpad';

        $this->email->initialize($config);
        $this->email->from($email, 'Permit System');
        $this->email->subject('Permit System');
        $this->email->to($target,'firdausjuanda@hotmail.com');
        // $this->email->cc(array('firdaus.juanda@wilmar.co.id'));
        $this->email->message($body_mail);
        $this->email->set_newline("\r\n");
        ini_set('smtp', $smtp_server);
        ini_set('smtp_port', $smtp_port);
        return $this->email->send();
        
    }
    public function workEmail(
        $user_data, 
        $work_date_open, 
        $work_area, 
        $work_title,
        $work_status,
        $work_exact_place,
        $work_user,
        $work_company
        )
        {
            $smtp_server = 'smtp.googlemail.com';
            $smtp_port = 465;
            $email = 'winpadsystem@gmail.com';
            $config = [
                'protocol' => 'smtp',
                'smtp_host' => $smtp_server,
                'smtp_user' => $email,
                'smtp_pass' => 'Winpad12325800*',
                '_smtp_auth' => TRUE,
                'smtp_port' => $smtp_port,
                'smtp_crypto' => 'ssl',
                'emailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
            ];
            $target = [
                $user_data['user_email'],
            ];
            $body_mail = 'Dear ';
            $body_mail .= $user_data['user_username'];
            $body_mail .= '
    
    Work order submitted with following details:
    
    ';
            $body_mail .= '
    Date                 :';
            $body_mail .= $work_date_open;
            
    $body_mail .= '
    Status       :';
            $body_mail .= $work_status;
            
    $body_mail .= '
    Area         :';
            $body_mail .= $work_area;
            
    $body_mail .= '
    Title        :';
            $body_mail .= $work_title;
            
    $body_mail .= '
    Exact Place   :';
            $body_mail .= $work_exact_place;
            
    $body_mail .= '
    User         :';
            $body_mail .= $work_user;
            
    $body_mail .= '
    Company      :';
            $body_mail .= $work_company;
            $body_mail .= '
    
            ';
            $body_mail .= '
    Sincerely
    Work Order System 
    by Winpad';
    
            $this->email->initialize($config);
            $this->email->from($email, 'Work Order System');
            $this->email->subject('Work Order System');
            $this->email->to($target, 'firdausjuanda@hotmail.com');
            // $this->email->cc(array('rafiola.fitri@wilmar.co.id','firdaus.juanda@wilmar.co.id'));
            $this->email->message($body_mail);
            $this->email->set_newline("\r\n");
            ini_set('smtp', $smtp_server);
            ini_set('smtp_port', $smtp_port);
            return $this->email->send();
        //     if($this->email->send() == true){
        //         return $this->email->send();
        //     }
        //     else
        //     {
        //         $this->email->print_debugger();
        //         die;
        //     }
            
        }
}