<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'button_Login' => 'Login', 
            'button_register' => 'Register', 
            'action_login' => site_url('auth/login_action'), 
            'action_register' => site_url('auth/register_action'), 
        );
        $this->load->view('login',$data);
    } 
    public function login_action(){
        $username = $this->input->post('username',TRUE);
        $password = sha1($this->input->post('password',TRUE));
        $remember_me = $this->input->post('remember_me',TRUE);

        $data = $this->User_model->login($username,$password);

        if($data){
            $sess = array(
                'id' => $data->id,
                'name'=> $data->name,
                'username'=> $data->username,
                'email'=> $data->email,
                'phone'=>$data->phone,
                'image'=> $data->image,
                'level'=> $data->level,

            );
            $this->session->set_userdata('logged_in', $sess);
            if($remember_me == 'on'){
               $this->set_cookis('username',$username);
               $this->set_cookis('password',$password);
            }
            var_dump($this->input->cookie('username',true));
            redirect('user','refresh');
        }else{
            $this->session->set_flashdata('error_message', 'invalid username or password');
            redirect('auth','refresh');
        }
    }
    
    public function register_action(){
        $this->_rules();
        
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $password = sha1($this->input->post('password',TRUE));
            $re_password = sha1($this->input->post('re_password',TRUE));
    
            $config['upload_path']          = './assets/upload/profile/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 1000000000;
            $config['max_width']            = 10240;
            $config['max_height']           = 7680;
            
            $this->load->library('upload', $config);
    
            if($password == $re_password){
                if ( !$this->upload->do_upload('image')){
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                }else{
                    $file = 'assets/upload/profile/'.$this->upload->data('file_name');
                    $data = array(
                        'name' => $this->input->post('name',TRUE),
                        'username' => $this->input->post('username',TRUE),
                        'password' => $password,
                        'email' => $this->input->post('email',TRUE),
                        'phone' => $this->input->post('phone',TRUE),
                        'image' => $file,
                        'level_user_id' => $this->input->post('type',TRUE),
                    );
    
                    $this->User_model->insert($data);
    
                    $this->session->set_flashdata('success_message', 'Register Success !');
                    redirect(site_url('auth'));
                }
            }else{
                $this->session->set_flashdata('error_message', 'Password Not matching !');
                redirect(site_url('auth'));
            }
        }
    }

    private function set_cookis($name,$value){
        $cookie = array(
            'name' => $name,
            'value' => $value,
            'expire' => '3600',
        );
        $this->input->set_cookie($cookie);
    }
    public function _rules() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('re_password', 'Re_password', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('image', 'Image', 'trim|required');
        $this->form_validation->set_rules('type', 'Type User', 'trim|required');
    }

}

/* End of file Gallery.php */
/* Location: ./application/controllers/Gallery.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-03-22 05:40:35 */
/* http://harviacode.com */