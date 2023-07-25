<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Periksa extends CI_controller
{
	function __construct()
	{
	 parent:: __construct();
     $this->load->helper('url');
      // needed ???
      $this->load->database();
      $this->load->library('session');
      $this->load->library('form_validation');
      
	 // error_reporting(0);
	 if($this->session->userdata('admin') != TRUE){
     redirect(base_url(''));
     exit;
	};
   $this->load->model('m_periksa');
   $this->load->model('m_pasien');
   $this->load->model('m_pengaturan');
	}

    //antrian
    public function antrian($tgl='')
    {
      if (isset($_POST['cari'])) {
        //cek data apabila berhasi Di kirim maka postdata akan melakukan cek .... dan sebaliknya
        $tgl = $this->input->post('tgl');
     $view = array('judul'     =>'Data Antrian',
                   'aksi'      =>'antrian',
                   'data'      =>$this->m_periksa->viewAntrian($tgl),
                   'tgl'       =>$tgl,
                   'depan'    =>FALSE,
                  );
      $this->load->view('admin/periksa/form',$view);
      }else{
      $view = array('judul'     =>'Buka Data Antrian',
                    'aksi'      =>'antrian',
                    'depan'    =>TRUE,
                    );
      $this->load->view('admin/periksa/form',$view);
      }
    }

    //antrian
    public function verifikasi($value='')
    {
     $pengaturan = $this->m_pengaturan->view()->row_array();
     
     $view = array('judul'          =>'Data Antrian Perlu Verifikasi',
                   'meta_deskripsi' =>$pengaturan['meta_description'],
                   'aksi'           =>'verifikasi',
                   'data'           =>$this->m_periksa->viewVerifikasi(),
                   'pasien'         =>$this->db->get('tb_pasien')->result_array(),
                  );
      $this->load->view('admin/periksa/form',$view);
    }

    //antrian
    public function sudah($value='')
    {
     $pengaturan = $this->m_pengaturan->view()->row_array();
     $view = array('judul'            =>'Sudah Periksa',
                   'meta_deskripsi'   =>$pengaturan['meta_description'],
                   'lokasi_praktik'   =>$pengaturan['lokasi_praktik'],
                   'aksi'             =>'sudah',
                   'data'             =>$this->m_periksa->viewSudah(),
                  );
      $this->load->view('admin/periksa/form',$view);
    }

    //antrian
    public function batal($value='')
    {
     $view = array('judul'     =>'Batal Periksa',
                   'aksi'      =>'batal',
                   'data'      =>$this->m_periksa->viewBatal(),
                  );
      $this->load->view('admin/periksa/form',$view);
    }


    private function acak_id($panjang)
    {
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $string = '';
        for ($i = 0; $i < $panjang; $i++) {
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter{$pos};
        }
        return $string;
    }
   

    //mengambil id antrian urut terakhir dan acak 5 digit
    private function id_antrian_urut($value='')
    {
    $this->m_periksa->id_urut();
    $query   = $this->db->get();
    $data    = $query->row_array();
    $id      = $data['id_antrian'];
    $karakter= $this->acak_id(5);
    $urut    = substr($id, 1, 3);
    $tambah  = (int) $urut + 1;
    
    if (strlen($tambah) == 1){
    $newID = "A"."00".$tambah.$karakter;
        }else if (strlen($tambah) == 2){
        $newID = "A"."0".$tambah.$karakter;
            }else (strlen($tambah) == 3){
            $newID = "A".$tambah.$karakter
            };
        return $newID;
    }

    // membuat nomor antrian otomatis dengan format 001 urut terakhir sesuai tanggal dan reset di tanggal baru
    // private function no_antrian($value='')
    // {
    // $this->m_periksa->no_antrian();
    // $query  = $this->db->get();
    // $data   = $query->row_array();
    // $id     = $data['no_antrian'];
    // $date   = date('dmY', strtotime($this->input->post('tgl_periksa')));
    // //reset nomor antrian tiap hari berdasarkan tanggal terakhir diinput
    // $data2  = $this->db->query("SELECT * FROM tb_periksa ORDER BY tgl_periksa");
    // $data2  = $data2->row_array();
    // $date2  = date('dmY', strtotime($data2['tgl_periksa']));
    // $urt    = substr($id, 0, 5);
    // $tambah = (int) $urt + 1;

    // if ($date == $date2) {
    // if (strlen($tambah) == 1){
    // $newID = "00".$tambah;
    //     }else if (strlen($tambah) == 2){
    //     $newID = "0".$tambah;
    //         }else (strlen($tambah) == 3){
    //         $newID = $tambah
    //         };
    //     return $newID;
    // }else{
    //     return "001";
    // }
    // }

    //input tanggal ditambah input waktu
    // private function tgl_waktu($value='')
    // {
    // date_default_timezone_set('Asia/Jakarta');
    // $tgl_waktu = date($this->input->post('tgl_periksa')." H:i:s");
    // return $tgl_waktu;
    // }

    //mengambil kode antrian urut terakhir
    // private function kode_antrian_urut($value='')
    // {
    // $this->m_periksa->kode_antrian();
    // $query  = $this->db->get();
    // $data   = $query->row_array();
    // $id     = $data['no_antrian'];
    // $date   = date('dmY', strtotime($this->db->get('tb_periksa')->row()->tgl_periksa));
    // //reset kode antrian tiap hari berdasarkan tanggal terakhir diinput
    // $data2  = $this->db->query("SELECT * FROM tb_periksa ORDER BY tgl_periksa DESC LIMIT 1");
    // $data2  = $data2->row_array();
    // $data3  = $data2['tgl_periksa'];
    // $date4  = substr($data3, 1, 10);
    // $data5  = date('dmY', strtotime($date4));
    // $urut   = substr($id, 1, 10);
    // $tambah = (int) $urut + 1;

    // if ($date == $data5) {
    // if (strlen($tambah) == 1){
    // $newID = "00".$tambah;
    //     }else if (strlen($tambah) == 2){
    //     $newID = "0".$tambah;
    //         }else (strlen($tambah) == 3){
    //         $newID = $tambah
    //         };
    //     return $newID;
    // }else{
    //     return "001";
    // }
    // }
    

    //menghitung durasi inputan waktu proses berapa detik contoh 0,006 detik
    // private function waktu_inputan($value='')
    // {
    // $waktu_inputan = date('H:i:s');
    // $waktu_inputan = explode(":", $waktu_inputan);
    // $waktu_inputan = $waktu_inputan[0] * 3600 + $waktu_inputan[1] * 60 + $waktu_inputan[2];
    // $waktu_inputan = $waktu_inputan/86400;
    // return $waktu_inputan;
    // }


  //API add periksa
  public function api_add($value='')
  {
    $rules = array(
      array(
        'field' => 'keluhan',
        'label' => 'keluhan',
        'rules' => 'required'
      )
    );
    $this->form_validation->set_rules($rules);
    if ($this->form_validation->run() == FALSE) {
      $response = [
        'status' => false,
        'message' => 'Tidak ada data'
      ];
    } else {
      $SQLinsert = [
        'id_antrian'      =>$this->id_antrian_urut(),
        'id_pasien'       =>$this->input->post('id_pasien'),
        'kode_antrian'    =>$this->acak_id(4),
        'mens_terakhir'   =>$this->input->post('mens_terakhir'),
        'keluhan'         =>$this->input->post('keluhan'),
        'tgl_periksa'     =>$this->input->post('tgl_periksa'),
        'status'          =>'PV',
        'uuid'            =>$this->acak_id(16)
      ];
      if ($this->m_periksa->add($SQLinsert)) {
        $response = [
          'status' => true,
          'message' => 'Berhasil menambahkan data'
        ];
      } else {
        $response = [
          'status' => false,
          'message' => 'Gagal menambahkan data'
        ];
      }
  }
  
  $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));
}

  //API dalam_antrian
  public function dalam_antrian($id='') {
    if(empty($id)){
      $response = [
        'status' => false,
        'message' => 'Tidak ada data yang dipilih'
      ];
    }else{
      $SQLupdate=array(
        'status'                    =>'ANTRI'
      );
      $cek=$this->m_periksa->update($id,$SQLupdate);
      if($cek){
        $response = [
          'status' => true,
          'message' => 'Berhasil'
        ];
        //mengirim email ke pelanggan dengan phpmailer
        //dibawahini untuk script phpmailer
      }else{
        $response = [
          'status' => false,
          'message' => 'Gagal'
        ];
      }
    }
    echo json_encode($response);
  }

    //API diperiksa
    public function diperiksa($id='') {
      if(empty($id)){
        $response = [
          'status' => false,
          'message' => 'Tidak ada data yang dipilih'
        ];
      }else{
        $SQLupdate=array(
          'status'                    =>'DIPERIKSA'
        );
        $cek=$this->m_periksa->update($id,$SQLupdate);
        if($cek){
          $response = [
            'status' => true,
            'message' => 'Berhasil'
          ];
          //mengirim email ke pelanggan dengan phpmailer
          //dibawahini untuk script phpmailer
        }else{
          $response = [
            'status' => false,
            'message' => 'Gagal'
          ];
        }
      }
      echo json_encode($response);
    }

    //API batal_periksa
    public function batal_periksa($id='') {
      if(empty($id)){
        $response = [
          'status' => false,
          'message' => 'Tidak ada data yang dipilih'
        ];
      }else{
        $SQLupdate=array(
          'status'                    =>'BTL'
        );
        $cek=$this->m_periksa->update($id,$SQLupdate);
        if($cek){
          $response = [
            'status' => true,
            'message' => 'Berhasil'
          ];
          //mengirim email ke pelanggan dengan phpmailer
          //dibawahini untuk script phpmailer
        }else{
          $response = [
            'status' => false,
            'message' => 'Gagal'
          ];
        }
      }
      echo json_encode($response);
    }

    private function waktu($value='')
    {
      //gmt +7
      date_default_timezone_set('Asia/Jakarta');
      $waktu = date('H:i:s');
      return $waktu;
    }

    //API edit pasien
    public function sudah_periksa($id='', $SQLupdate='')
    {
      $rules = array(
        array(
          'field' => 'catatan',
          'label' => 'catatan',
          'rules' => 'required'
        )
      );
      $this->form_validation->set_rules($rules);
      if ($this->form_validation->run() == FALSE) {
        $response = [
          'status' => false,
          'message' => 'Tidak ada data'
        ];
      } else {
        $SQLupdate = [
          'catatan'                   =>$this->input->post('catatan'),
          'status'                    =>'S',
          'waktu_keluar'              =>$this->waktu()
        ];
        if ($this->m_periksa->update($id, $SQLupdate)) {
          $response = [
            'status' => true,
            'message' => 'Berhasil mengubah data'
          ];
        } else {
          $response = [
            'status' => false,
            'message' => 'Gagal mengubah data'
          ];
        }
      }
      $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($response));
    }
	
}