
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class Laporantransaksi_controller extends CI_Controller
{
	public function __construct(){
		parent::__construct();
        if($this->session->userdata('username')==NULL){
            redirect('Login_controller','refresh');   
        }
		$this->load->model('Detailtransaksi_model');
		$this->load->helper('url');
		$this->load->helper('form');
	}
	public function index(){
		$content = $this->cart->contents();
		if ($this->input->post('filter')=='harian') {
			$data['LaporanTransaksi'] = $this->Detailtransaksi_model->getLaporanHarian();
			$data['Request'] = 'Harian';
		}
		else if ($this->input->post('filter')=='bulanan') {
			$data['LaporanTransaksi'] = $this->Detailtransaksi_model->getLaporanBulanan();
			$data['Request'] = 'Bulanan';
		}
		else if ($this->input->post('filter')=='tahunan') {
			$data['LaporanTransaksi'] = $this->Detailtransaksi_model->getLaporanTahunan();
			$data['Request'] = 'Tahunan';
		}
		else {
			$data['LaporanTransaksi'] = $this->Detailtransaksi_model->getLaporan();
			$data['Request'] = '';	
		}
        $nav ['title']= "Report Product";
        $this->load->view('navbar/index_navbar.php',$nav);
		$this->load->view('laporanTransaksi.php', $data);
		$this->load->view('cart/index_cart.php', array('content' => $content));
	}

	public function pdf()
    {
        $this->load->library('dompdf_gen');

        $data['LaporanTransaksi'] = $this->Detailtransaksi_model->getLaporan();
        $data['Waktu'] = "Semua Transaksi";
        $this->load->view('laporanPdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Laporan Transaksi (All).pdf", array('Attachment' => 0));
  		redirect('Laporantransaksi_controller','refresh');
    }

    public function pdfHarian()
    {
        $this->load->library('dompdf_gen');

        date_default_timezone_set('Asia/Jakarta');

        $data['LaporanTransaksi'] = $this->Detailtransaksi_model->getLaporanHarian();
        $data['Waktu'] = "Per-".date('d/M/Y')." (Harian)";
        $this->load->view('laporanPdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Laporan Transaksi (Harian).pdf", array('Attachment' => 0));
  		redirect('Laporantransaksi_controller','refresh');
    }

    public function pdfBulanan()
    {
        $this->load->library('dompdf_gen');

        date_default_timezone_set('Asia/Jakarta');

        $data['LaporanTransaksi'] = $this->Detailtransaksi_model->getLaporanBulanan();
        $data['Waktu'] = "Per-".date('M/Y')." (Bulanan)";
        $this->load->view('laporanPdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Laporan Transaksi (Bulanan).pdf", array('Attachment' => 0));
  		redirect('Laporantransaksi_controller','refresh');
    }

    public function pdfTahunan()
    {
        $this->load->library('dompdf_gen');

        date_default_timezone_set('Asia/Jakarta');

        $data['LaporanTransaksi'] = $this->Detailtransaksi_model->getLaporanTahunan();
        $data['Waktu'] = "Per-".date('Y')." (Tahunan)";
        $this->load->view('laporanPdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Laporan Transaksi (Tahunan).pdf", array('Attachment' => 0));
  		redirect('Laporantransaksi_controller','refresh');
    }
}
?>
