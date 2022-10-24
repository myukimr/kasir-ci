
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class End_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')==NULL){
            redirect('Login_controller','refresh');   
        }
        $this->load->helper('download');
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function index(){
		$content = $this->cart->contents();
		$data ['cashback']= $this->session->flashdata('cashback');
		$data ['via']= $this->session->flashdata('via');
		$nav ['title']= "Sukses";
		$this->load->view('navbar/index_navbar.php',$nav);
		$this->load->view('end.php',$data);
		$this->load->view('cart/index_cart.php', array('content' => $content));
	}

	public function downloadStruk($via){
		if ($via == "Tunai") {
			$data = file_get_contents("./assets/struk/Struk Transaksi (Tunai).txt"); // Read the file's contents
			$name = 'Struk.txt';
			force_download($name, $data);
		}
		else if ($via == "Linkaja") {
			$data = file_get_contents("./assets/struk/Struk Transaksi (Linkaja).txt"); // Read the file's contents
			$name = 'Struk.txt';
			force_download($name, $data);
		}
		else if ($via == "OVO") {
			$data = file_get_contents("./assets/struk/Struk Transaksi (OVO).txt"); // Read the file's contents
			$name = 'Struk.txt';
			force_download($name, $data);
		}
	}
}
?>
