
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class Menu_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')==NULL){
            redirect('Login_controller','refresh');   
        }
		$this->load->model('Menu_model');
		$this->load->helper('url');
		$this->load->helper('form');
	}
	
	public function index(){
		$content = $this->cart->contents();
		$data ['menu']= $this->Menu_model->tampilMenu();
		$nav ['title']= "Product Management";
		$this->load->view('navbar/index_navbar.php',$nav);
		$this->load->view('manajemenMenu.php', $data);
		$this->load->view('cart/index_cart.php', array('content' => $content));
	}

	public function tambahMenu(){
		$cekKode = $this->Menu_model->cekKodeMenu();
		if ($cekKode=="NULL") {
			$cekKode="0000";
		}
		$noUrut = (substr($cekKode, 0, -3)) + 1;
		if ($this->input->post('type')=="makanan") {
			$kd_menu = $noUrut.'MKN';
		}
		elseif ($this->input->post('type')=="minuman") {
			$kd_menu = $noUrut.'MNM';
		}
		elseif ($this->input->post('type')=="snack") {
			$kd_menu = $noUrut.'SNK';
		}

		$img=0;

		$config['upload_path']          = './upload/menu/';
		$config['allowed_types']        = 'jpeg|jpg|png';
		$config['file_name']            = $kd_menu.$img;
		$config['max_size']             = 3072; // 3MB
		$config['remove_space'] 		= TRUE;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('upload')){
			$this->session->set_flashdata('errorUploadAdd', 'Menu berhasil ditambahkan. Tidak ada file yang diupload!');
			$this->Menu_model->tambahMenu($kd_menu, 'default.jpg');
			redirect('Index_controller','refresh');	
		}else{
			$this->session->set_flashdata('successUploadAdd', 'Menu berhasil ditambahkan.');
			$this->Menu_model->tambahMenu($kd_menu, $this->upload->data('file_name'));
			redirect('Index_controller','refresh');	
		}
	}

	public function editMenu(){
		if ($this->input->post('kd_menu') == NULL) {
			$this->Menu_model->editMenu($kd_menu, $cekImg);
			redirect('Index_controller','refresh');
		}
		else {
			$kd_menu = $this->input->post('kd_menu');
			$cekImg = $this->Menu_model->cekImg($this->input->post('kd_menu'));
			if ($cekImg=='default.jpg') {
				$tempImg=$kd_menu.'0.jpg';
				$noUrut = (substr($tempImg, 4, -4)) + 1;
				$namaImg = substr($tempImg, 0, -5).$noUrut;
			}
			else {
				$noUrut = (substr($cekImg, 4, -4)) + 1;
				$namaImg = substr($cekImg, 0, -5).$noUrut;
			}
			$config['upload_path']          = './upload/menu/';
			$config['allowed_types']        = 'jpeg|jpg|png';
			$config['file_name']            = $namaImg;
			$config['max_size']             = 3072; // 3MB
			$config['remove_space'] 		= TRUE;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('upload')){
				$this->session->set_flashdata('errorUploadEdit', 'Update data berhasil. Tidak ada file yang diupload!');
				$this->Menu_model->editMenu($kd_menu, $cekImg);
				redirect('Menu_controller','refresh');	
			}else{
				$this->session->set_flashdata('successUploadEdit', 'Update data berhasil.');
				$this->Menu_model->editMenu($kd_menu, $this->upload->data('file_name'));
				if ($cekImg!='default.jpg') {
					unlink('./upload/menu/'.$cekImg);
				}
				redirect('Menu_controller','refresh');	
			}
		}
	}

	public function hapusMenu($kd_menu)
	{
		$cekImg = $this->Menu_model->cekImg($kd_menu);
		if ($cekImg!='default.jpg') {
			unlink('./upload/menu/'.$cekImg);
		}
		$this->Menu_model->hapusMenu($kd_menu);
		$this->session->set_flashdata('successHapus', 'Data berhasil dihapus.');
		redirect('Menu_controller','refresh');
	}
}
?>
