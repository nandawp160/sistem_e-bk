<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

    public function index() {
        $data['judul'] = 'Pengaturan Sistem';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('errors/html/error_coming_soon', $data);
        $this->load->view('templates/footer', $data);
    }
}
