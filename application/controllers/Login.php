<?php
/*halaman login utama 

author by Ismarianto Putra TEch Programer */

class Login extends CI_controller
{
	
	function __construct()
	{
	parent::__construct();	
  $this->load->helper('url');
  // needed ???
  $this->load->database();
  $this->load->library('session');
  
	$this->load->model('Login_m');
  $this->load->model('m_pengaturan');
	
	}

   public function index()
   {
   	if(isset($_POST['login'])){
      
      $nama=$this->input->post('email');
      $no_hp=$this->input->post('email');
      $email=$this->input->post('email');
      $password=$this->input->post('password');
     
     //cek data login
     $superadmin  = $this->Login_m->Superadmin($nama,$email,$no_hp,md5($password));
     $admin       = $this->Login_m->Admin($nama,$email,$no_hp,md5($password));
     $dokter      = $this->Login_m->Dokter($nama,$email,$no_hp,md5($password));
     $pasien      = $this->Login_m->Pasien($nama,$email,$no_hp,md5($password));
     
     if($superadmin->num_rows() > 0 ){
      $DataSuperadmin=$superadmin->row_array();
      $sessionSuperadmin = array(
          'superadmin'        => TRUE,
          'id_admin'          => $DataSuperadmin['id_admin'],
          'email'             => $DataSuperadmin['email'],
          'password'          => $DataSuperadmin['password'],
          'nama'              => $DataSuperadmin['nama'],
          'no_hp'             => $DataSuperadmin['no_hp'],
          'level'             => $DataSuperadmin['level'] );        
      $this->session->set_userdata($sessionSuperadmin);
      $this->session->set_flashdata('pesan','<div class="btn btn-primary">Anda Berhasil Login .....</div>');
      redirect(base_url('superadmin/home'));


      }elseif($admin->num_rows() > 0 ){
        $DataAdmin=$admin->row_array();
        $sessionAdmin = array(
            'admin'             => TRUE,
        	  'id_admin'          => $DataAdmin['id_admin'],
            'email'             => $DataAdmin['email'],
            'password'          => $DataAdmin['password'],
            'nama'              => $DataAdmin['nama'],
            'no_hp'             => $DataAdmin['no_hp'],
            'level'             => $DataAdmin['level'] );        
     $this->session->set_userdata($sessionAdmin);
     $this->session->set_flashdata('pesan','<div class="btn btn-primary">Anda Berhasil Login .....</div>');
     redirect(base_url('admin/home'));


     }elseif($dokter->num_rows() > 0){
        $DataDokter=$dokter->row_array();
        $sessionDokter = array(
            'Dokter'            => TRUE,
            'id_dokter'         => $DataDokter['id_dokter'],
            'no_hp'             => $DataDokter['no_hp'],
            'email'             => $DataDokter['email'],
            'password'          => $DataDokter['password'],
            'nama'              => $DataDokter['nama'],
            'level'             => 'Dokter',
              );       
    
     $this->session->set_userdata($sessionDokter);
     $this->session->set_flashdata('pesan','<div class="btn btn-success">Anda Berhasil Login .....</div>');
     redirect(base_url('dokter/home'));

    }elseif($pasien->num_rows() > 0){
      $DataPasien=$pasien->row_array();
      $sessionPasien = array(
          'Pasien'            => TRUE,
          'id_pasien'         => $DataPasien['id_pasien'],
          'no_hp'             => $DataPasien['no_hp'],
          'email'             => $DataPasien['email'],
          'password'          => $DataPasien['password'],
          'nama'              => $DataPasien['nama'],
          'tgl_periksa'       => $DataPasien['tgl_periksa'],
          'level'             => 'Pasien',
            );       
  
   $this->session->set_userdata($sessionPasien);
   $this->session->set_flashdata('pesan','<div class="btn btn-success">Anda Berhasil Login .....</div>');
   redirect(base_url('pasien/home'));

     }else{
          $pesan='<script>
                  swal({
                      title: "Nama / No HP / Email / Password Salah Atau Akun Anda Tidak Aktif",
                      type: "error",
                      showConfirmButton: true,
                      confirmButtonText: "OKEE"
                      });
                </script>';
        $this->session->set_flashdata('pesan', $pesan);
       redirect(base_url('login'));

     }
}else{ 
  $data = $this->m_pengaturan->view()->row_array();
  $x = array(
  	          'judul' =>'Login Aplikasi',
              'nama_judul'        =>$data['nama_judul'],
              'meta_keywords'     =>$data['meta_keywords'],
              'meta_description'  =>$data['meta_description'],
              'logo'              =>$data['logo'],
            );
  
  $this->load->view('login',$x);

}

   }

}