
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class Riwayattransaksi_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
        if($this->session->userdata('username')==NULL){
            redirect('Login_controller','refresh');   
        }
		$this->load->model('Transaksi_model');
		$this->load->helper('url');
		$this->load->helper('form');
	}
	public function index(){
		$content = $this->cart->contents();
		if ($this->input->post('filter')=='harian') {
			$data['Transaksi'] = $this->Transaksi_model->getRiwayatHarian();
			$data['Request'] = 'Harian';
		}
		else if ($this->input->post('filter')=='bulanan') {
			$data['Transaksi'] = $this->Transaksi_model->getRiwayatBulanan();
			$data['Request'] = 'Bulanan';
		}
		else if ($this->input->post('filter')=='tahunan') {
			$data['Transaksi'] = $this->Transaksi_model->getRiwayatTahunan();
			$data['Request'] = 'Tahunan';
		}
		else {
			$data['Transaksi'] = $this->Transaksi_model->getRiwayat();
			$data['Request'] = '';	
		}
        $nav ['title']= "History Transaction";
        $this->load->view('navbar/index_navbar.php',$nav);
		$this->load->view('riwayatTransaksi.php', $data);
		$this->load->view('cart/index_cart.php', array('content' => $content));
	}

	public function pdf()
    {
        $this->load->library('dompdf_gen');

        $data['Transaksi'] = $this->Transaksi_model->getRiwayat();
        $data['Waktu'] = "Semua Transaksi";
        $this->load->view('riwayatPdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Riwayat Transaksi (All).pdf", array('Attachment' => 0));
  		redirect('Riwayattransaksi_controller','refresh');
    }

    public function pdfHarian()
    {
        $this->load->library('dompdf_gen');

        date_default_timezone_set('Asia/Jakarta');

        $data['Transaksi'] = $this->Transaksi_model->getRiwayatHarian();
        $data['Waktu'] = "Per-".date('d/M/Y')." (Harian)";
        $this->load->view('riwayatPdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Riwayat Transaksi (Harian).pdf", array('Attachment' => 0));
  		redirect('Riwayattransaksi_controller','refresh');
    }

    public function pdfBulanan()
    {
        $this->load->library('dompdf_gen');

        date_default_timezone_set('Asia/Jakarta');

        $data['Transaksi'] = $this->Transaksi_model->getRiwayatBulanan();
        $data['Waktu'] = "Per-".date('M/Y')." (Bulanan)";
        $this->load->view('riwayatPdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Riwayat Transaksi (Bulanan).pdf", array('Attachment' => 0));
  		redirect('Riwayattransaksi_controller','refresh');
    }

    public function pdfTahunan()
    {
        $this->load->library('dompdf_gen');

        date_default_timezone_set('Asia/Jakarta');

        $data['Transaksi'] = $this->Transaksi_model->getRiwayatTahunan();
        $data['Waktu'] = "Per-".date('Y')." (Tahunan)";
        $this->load->view('riwayatPdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Riwayat Transaksi (Tahunan).pdf", array('Attachment' => 0));
  		redirect('Riwayattransaksi_controller','refresh');
    }
}
?>
