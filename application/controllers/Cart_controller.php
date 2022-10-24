
<?php
defined('BASEPATH') OR exit('No direct scipt access allowes');
/**
 * 
 */
class Cart_controller extends CI_Controller
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
	}

	public function addCart($kd_menu){
		$this->Menu_model->getMenuToCart($kd_menu);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function removeCart($rowid){
        $data = array(
		    'rowid' => $rowid,
		    'qty'   => 0
		);
		$this->cart->update($data);
		redirect($_SERVER['HTTP_REFERER']);
    }

    public function editCart(){
		$rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');
        $catatan = $this->input->get('catatan');
        
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' 	=> $rowid,
                'qty'   	=> $qty,
                'catatan'   => $catatan
            );
            $this->cart->update($data);
        }
		redirect($_SERVER['HTTP_REFERER']);
    }

    public function destroyCart(){
    	$this->cart->destroy();
    	redirect($_SERVER['HTTP_REFERER']);
    }
}
?>
