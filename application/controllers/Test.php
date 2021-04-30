<?php

class Test extends CI_Controller{
    public function __construct()
    {
        parent:: __construct();
        $this->load->model('Work_model');
    }

    public function delete_file()
    {
        $doc = 'Test.jpeg';
        $path = './assets/img/work/';
        $file = $path.$doc;
        if(unlink($file)){
            echo "successfully deleted";
        }
        else{
            echo "cannot be deleted due to an error occured";
        }
    }
    public function reduce_file()
    {  
        $this->form_validation->set_rules('id','id','required');
        if($this->form_validation->run()==FALSE)
        {
            // $data['work'] = $this->Work_model->getAllWork();
            $this->load->view('try');
        }
        else
        {   
            
            $path                           = './assets/test/';
            $config['upload_path']          = $path;
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['file_name']            = 'Test';
            $this->load->library('upload', $config);  
            $this->upload->initialize($config);
            ini_set('memory_limit', '-1');
            if(!$this->upload->do_upload('upload_file'))  
            {  
                    echo $this->upload->display_errors();  
            }  
            else  
            { 
                    $data = $this->upload->data();  
                    $config['image_library'] = 'gd2';  
                    $config['source_image'] = $path.$data["file_name"];  
                    $config['create_thumb'] = FALSE;  
                    $config['maintain_ratio'] = TRUE;  
                    $config['quality'] = '100%';  
                    $config['width'] = 1080;  
                    $config['new_image'] = $path.$data["file_name"];  
                    $this->load->library('image_lib', $config);  
                    $this->image_lib->resize();
            
            }
        }
    }
}
    
