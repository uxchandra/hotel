<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MeetingRoom extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('MeetingRoom_model');
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

        $data['meeting_room'] = $this->MeetingRoom_model->read();
        $data['error'] = '';
        $data['result'] = $this->db->order_by('id', 'DESC')
            ->get('meeting_room')
            ->result();
        $this->load->view('admin/meeting_room/data', $data);
    }

    public function edit($id)
    {

        $data['detail'] = $this->db->get_where('meeting_room', ['id' => $id])->row();
        $this->load->view('admin/meeting_room/ubah', $data);
    }

    public function do_upload()
    {
        $config['upload_path']          = './images/meeting_room';
        $config['allowed_types']        = 'jpg|png';
        $config['max_size']             = 0;
        $config['max_width']            = 0;
        $config['max_height']           = 0;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/meeting_room/data', $error);
        } else {
            $_data = array('upload_data' => $this->upload->data());
            $data = array(
                'jenis' => $this->input->post('jenis'),
                'harga' => $this->input->post('harga'),
                'kapasitas' => $this->input->post('kapasitas'),
                'gambar' => $_data['upload_data']['file_name']
            );
            $query = $this->db->insert('meeting_room', $data);
            if ($query) {
                $this->session->set_flashdata('msg', '<p style="color:green;">Berhasil menambahkan data!</p>');
                redirect('MeetingRoom/read');
            } else {
                $this->session->set_flashdata('msg', '<p style="color:red;">Gagal menambahkan data!</p>');
            }
        }
    }

    public function delete($id)
    {
        $_id = $this->db->get_where('meeting_room', ['id' => $id])->row();
        $query = $this->db->delete('meeting_room', ['id' => $id]);
        if ($query) {
            unlink("images/meeting_room/" . $_id->gambar);
        }
        redirect('MeetingRoom/read');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $_image = $this->db->get_where('meeting_room', ['id' => $id])->row();
        $config['upload_path']          = './images/meeting_room/';
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
            $query = $this->db->update('meeting_room', $data, array('id' => $id));
        } else {
            $_data = array('upload_data' => $this->upload->data());
            $data = array(
                'jenis' => $this->input->post('jenis'),
                'harga' => $this->input->post('harga'),
                'kapasitas' => $this->input->post('kapasitas'),
                'gambar' => $_data['upload_data']['file_name']
            );
            $query = $this->db->update('meeting_room', $data, array('id' => $id));
            if ($query) {
                unlink("images/meeting_room/" . $_image->gambar);
            }
        }
        redirect('MeetingRoom/read');
    }
}
