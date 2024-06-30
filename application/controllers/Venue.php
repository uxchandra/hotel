<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Venue extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Venue_model');
        if (!$this->session->userdata('email')) redirect('Auth/login');
        if ($this->session->userdata('akses') == 'Admin') {
            // redirect('Welcome');
        } else {
            redirect('Welcome');
        }
        $this->load->database();
    }

    public function read()
    {

        $data['venue'] = $this->Venue_model->read();
        $data['error'] = '';
        $data['result'] = $this->db->order_by('id', 'DESC')
            ->get('venue')
            ->result();
        $this->load->view('admin/venue/data', $data);
    }

    public function edit($id)
    {

        $data['detail'] = $this->db->get_where('venue', ['id' => $id])->row();
        $this->load->view('admin/venue/ubah', $data);
    }

    public function do_upload()
    {
        $config['upload_path']          = './images/venue';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/venue/data', $error);
        } else {
            $_data = array('upload_data' => $this->upload->data());
            $data = array(
                'jenis' => $this->input->post('jenis'),
                'harga' => $this->input->post('harga'),
                'kapasitas' => $this->input->post('kapasitas'),
                'gambar' => $_data['upload_data']['file_name']
            );
            $query = $this->db->insert('venue', $data);
            if ($query) {
                $this->session->set_flashdata('msg', '<p style="color:green;">Berhasil menambahkan data!</p>');
                redirect('Venue/read');
            } else {
                $this->session->set_flashdata('msg', '<p style="color:red;">Gagal menambahkan data!</p>');
            }
        }
    }

    public function delete($id)
    {
        $_id = $this->db->get_where('venue', ['id' => $id])->row();
        $query = $this->db->delete('venue', ['id' => $id]);
        if ($query) {
            unlink("images/venue/" . $_id->gambar);
        }
        redirect('Venue/read');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $_image = $this->db->get_where('kamar', ['id' => $id])->row();
        $config['upload_path']          = './images/venue/';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            $data = array(
                'jenis' => $this->input->post('jenis'),
                'harga' => $this->input->post('harga'),
                'kapasitas' => $this->input->post('kapasitas')
            );
            $query = $this->db->update('venue', $data, array('id' => $id));
        } else {
            $_data = array('upload_data' => $this->upload->data());
            $data = array(
                'jenis' => $this->input->post('jenis'),
                'harga' => $this->input->post('harga'),
                'kapasitas' => $this->input->post('kapasitas'),
                'gambar' => $_data['upload_data']['file_name']
            );
            $query = $this->db->update('kamar', $data, array('id' => $id));
            if ($query) {
                unlink("images/venue/" . $_image->gambar);
            }
        }
        redirect('Venue/read');
    }
}
