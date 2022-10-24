
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class Transaksi_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('username')==NULL){
            redirect('Login_controller','refresh');   
        }
		$this->load->model('Menu_model');
		$this->load->model('Transaksi_model');
		$this->load->model('Detailtransaksi_model');
		$this->load->helper('file');
		$this->load->library('escpos');
		$this->load->helper('url');
		$this->load->helper('form');
	}

	public function index(){
		$content = $this->cart->contents();
		$data ['cekStok']='True';
		$nav ['title']= "Checkout";
		$this->load->view('navbar/index_navbar.php',$nav);
		$this->load->view('transaksi.php', array('content' => $content), $data);
		$this->load->view('cart/index_cart.php', array('content' => $content));
	}
	
	public function inputPembayaran(){
		$content = $this->cart->contents();
		$cek = "True";
		foreach ($content as $item) {
			$cekStok=$this->Menu_model->cekStok($item['id']);
			if ($item['qty']>$cekStok) {
				$this->session->set_flashdata('errorStok', 'Stok tidak mencukupi!');
				redirect('Transaksi_controller','refresh');
				$cek = "False"; 
				return false;
			}
		}
		// Input Pembayaran
		if ($this->input->post('type')=='tunai') {
			if ($cek == "True") {
				$customer 	= $this->input->post('customer');
				$nomeja 	= $this->input->post('no_meja');
				$uang 		= $this->input->post('uang');
				$total 		= $this->input->post('total_harga');
				$selisih	= $this->input->post('uang') - $this->input->post('total_harga');
				if ($uang < $total) {
					$this->session->set_flashdata('errorMoney', 'Transaksi pembayaran kurang!');
					redirect('Transaksi_controller','refresh');
					return false;
				}
				else {
					$this->Transaksi_model->tambahTransaksi();
					$this->Detailtransaksi_model->tambahDetail();
					$this->session->set_flashdata('cashback', $selisih);
					$this->session->set_flashdata('via', 'Tunai');

					//Struk Tunai
					unlink('./assets/struk/Struk Transaksi (Tunai).txt');
					$location = fopen('./assets/struk/Struk Transaksi (Tunai).txt','a');
					fputs($location, "           Kasir.com" . "\n");
					fputs($location, "     Jl.Soekarno Hatta No.9," . "\n");
					fputs($location, "    Jatimulyo, Kec.Lowokwaru" . "\n");
					fputs($location, "        Kota Malang 65141" . "\n");
					fputs($location, "                             " . "\n");
					fputs($location, "           TABLE:".$this->input->post('no_meja')."        " . "\n");
					fputs($location, "Customer:".$this->input->post('customer')."\t     Id Kasir:".$this->input->post('id_user')."\n");
					fputs($location, "-------------------------------" . "\n");
					fputs($location, "-------------------------------" . "\n");
					$content = $this->cart->contents();
					foreach ($content as $item) {
						$jumlah = $item['price']*$item['qty'];
						fputs($location, $item['qty']."  ".$item['name']."\t\t ".$jumlah. "\n");
					}
					fputs($location, "-------------------------------" . "\n");
					fputs($location, "-------------------------------" . "\n");
					$subtotal = $this->cart->total();
					$ppn = 10 * $subtotal / 100;
					$total = $subtotal + $ppn;
					$uang = $this->input->post('uang');
					$kembalian = $uang - $total;
					fputs($location, "Subtotal \t\t ".$subtotal. "\n");
					fputs($location, "Ppn \t\t\t ".$ppn. "\n");
					fputs($location, "-------------------------------" . "\n");
					fputs($location, "TOTAL \t\t\t ".$total. "\n");
					fputs($location, "Cash \t\t\t ".$uang. "\n");
					fputs($location, "Kembalian \t\t ".$kembalian. "\n");
					fputs($location, "                             " . "\n");
					fputs($location, "          Via ".$this->input->post('type')." " . "\n");
					fputs($location, "<-----".$this->input->post('waktu')."----->" . "\n");
					fputs($location, "         Terima Kasih" . "\n");
					fclose($location);

					$this->cart->destroy();
					redirect('End_controller','refresh');
				} 
			}
		}
		else if ($this->input->post('type')=='linkaja'){
			$selisih	= 0;
			$this->Transaksi_model->tambahTransaksi();
			$this->Detailtransaksi_model->tambahDetail();
			$this->session->set_flashdata('cashback', $selisih);
			$this->session->set_flashdata('via', 'Linkaja');

			//Struk Linkaja
			unlink('./assets/struk/Struk Transaksi (Linkaja).txt');
			$location = fopen('./assets/struk/Struk Transaksi (Linkaja).txt','a');
			fputs($location, "           Kasir.com" . "\n");
			fputs($location, "     Jl.Soekarno Hatta No.9," . "\n");
			fputs($location, "    Jatimulyo, Kec.Lowokwaru" . "\n");
			fputs($location, "        Kota Malang 65141" . "\n");
			fputs($location, "                             " . "\n");
			fputs($location, "           TABLE:".$this->input->post('no_meja')."        " . "\n");
			fputs($location, "Customer:".$this->input->post('customer')."\t     Id Kasir:".$this->input->post('id_user')."\n");
			fputs($location, "-------------------------------" . "\n");
			fputs($location, "-------------------------------" . "\n");
			$content = $this->cart->contents();
			foreach ($content as $item) {
				$jumlah = $item['price']*$item['qty'];
				fputs($location, $item['qty']."  ".$item['name']."\t\t ".$jumlah. "\n");
			}
			fputs($location, "-------------------------------" . "\n");
			fputs($location, "-------------------------------" . "\n");
			$subtotal = $this->cart->total();
			$ppn = 10 * $subtotal / 100;
			$total = $subtotal + $ppn;
			$uang = $total;
			$kembalian = 0;
			fputs($location, "Subtotal \t\t ".$subtotal. "\n");
			fputs($location, "Ppn \t\t\t ".$ppn. "\n");
			fputs($location, "-------------------------------" . "\n");
			fputs($location, "TOTAL \t\t\t ".$total. "\n");
			fputs($location, "Cash \t\t\t ".$uang. "\n");
			fputs($location, "Kembalian \t\t ".$kembalian. "\n");
			fputs($location, "                             " . "\n");
			fputs($location, "          Via ".$this->input->post('type')." " . "\n");
			fputs($location, "<-----".$this->input->post('waktu')."----->" . "\n");
			fputs($location, "         Terima Kasih" . "\n");
			fclose($location);

			$this->cart->destroy();
			redirect('End_controller','refresh');
		}
		else if ($this->input->post('type')=='ovo'){
			$selisih	= 0;
			$this->Transaksi_model->tambahTransaksi();
			$this->Detailtransaksi_model->tambahDetail();
			$this->session->set_flashdata('cashback', $selisih);
			$this->session->set_flashdata('via', 'OVO');

			//Struk OVO
			unlink('./assets/struk/Struk Transaksi (OVO).txt');
			$location = fopen('./assets/struk/Struk Transaksi (OVO).txt','a');
			fputs($location, "           Kasir.com" . "\n");
			fputs($location, "     Jl.Soekarno Hatta No.9," . "\n");
			fputs($location, "    Jatimulyo, Kec.Lowokwaru" . "\n");
			fputs($location, "        Kota Malang 65141" . "\n");
			fputs($location, "                             " . "\n");
			fputs($location, "           TABLE:".$this->input->post('no_meja')."        " . "\n");
			fputs($location, "Customer:".$this->input->post('customer')."\t     Id Kasir:".$this->input->post('id_user')."\n");
			fputs($location, "-------------------------------" . "\n");
			fputs($location, "-------------------------------" . "\n");
			$content = $this->cart->contents();
			foreach ($content as $item) {
				$jumlah = $item['price']*$item['qty'];
				fputs($location, $item['qty']."  ".$item['name']."\t\t ".$jumlah. "\n");
			}
			fputs($location, "-------------------------------" . "\n");
			fputs($location, "-------------------------------" . "\n");
			$subtotal = $this->cart->total();
			$ppn = 10 * $subtotal / 100;
			$total = $subtotal + $ppn;
			$uang = $total;
			$kembalian = 0;
			fputs($location, "Subtotal \t\t ".$subtotal. "\n");
			fputs($location, "Ppn \t\t\t ".$ppn. "\n");
			fputs($location, "-------------------------------" . "\n");
			fputs($location, "TOTAL \t\t\t ".$total. "\n");
			fputs($location, "Cash \t\t\t ".$uang. "\n");
			fputs($location, "Kembalian \t\t ".$kembalian. "\n");
			fputs($location, "                             " . "\n");
			fputs($location, "          Via ".$this->input->post('type')." " . "\n");
			fputs($location, "<-----".$this->input->post('waktu')."----->" . "\n");
			fputs($location, "         Terima Kasih" . "\n");
			fclose($location);

			$this->cart->destroy();
			redirect('End_controller','refresh');
		}
	}
}
?>
