<?php
Class Film extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://www.omdbapi.com/?apikey=[db512ae2]&";
    }
    
    // menampilkan data film
    function index(){
        $data['film'] = json_decode($this->curl->simple_get($this->API.'/film'));
        $this->load->view('film/list',$data);
    }
    
    // insert data mahasiswa
    function create(){
        if(isset($_POST['submit'])){
            $data = array(
                'judul'     =>  $this->input->post('judul'),
                'durasi'    =>  $this->input->post('durasi'),
                'genre'     =>  $this->input->post('genre'),
                'rating'    =>  $this->input->post('rating'));
            $insert =  $this->curl->simple_post($this->API.'/film', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($insert)
            {
                $this->session->set_flashdata('hasil','Insert Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Insert Data Gagal');
            }
            redirect('film');
        }else{
            $data['genre'] = json_decode($this->curl->simple_get($this->API.'/genre'));
            $this->load->view('film/create',$data);
        }
    }
    
    // edit data film
    function edit(){
        if(isset($_POST['submit'])){
            $data = array(
                'judul'     =>  $this->input->post('judul'),
                'durasi'    =>  $this->input->post('durasi'),
                'genre'     =>  $this->input->post('genre'),
                'rating'    =>  $this->input->post('rating'));
            $update =  $this->curl->simple_put($this->API.'/film', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('film');
        }else{
            $data['genre'] = json_decode($this->curl->simple_get($this->API.'/genre'));
            $params = array('judul'=>  $this->uri->segment(3));
            $data['film'] = json_decode($this->curl->simple_get($this->API.'/film',$params));
            $this->load->view('film/edit',$data);
        }
    }
    
    // delete data indomart
    function delete($judul){
        if(empty($judul)){
            redirect('film');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/film', array('judul'=>$nim), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('film');
        }
    }
}