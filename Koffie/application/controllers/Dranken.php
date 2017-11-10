<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Dranken extends CI_Controller {
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('Dranken_model');
		
	}
	
	
	public function index() {
		  
		$data['drank_id'] = $dranken_id;
        $data['dranken'] = $this->Dranken_model->get_drank($dranken_id);
        $data['DrinkNaam'] = 'dranken';

        $this->load->view('header', $data);
        $this->load->view('dranken/drank/index', $data);
        $this->load->view('footer');
        }



	
	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function add() {

		$data = new stdClass();

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('drinknaam', 'drinkNaam', 'trim|required|alpha_numeric|is_unique[dranken.drinknaam]', array('is_unique' => 'Deze naam bestaat al voor een ander drankje, noem deze alstublieft anders!'));
		$this->form_validation->set_rules('beschrijving', 'Beschrijving', 'trim|required|is_unique[dranken.beschrijving]');
		
		if ($this->form_validation->run() === false) {

			$this->load->view('header');
			$this->load->view('dranken/admin/add/add', $data);
			$this->load->view('footer');
			
		} else {

			$drinknaam = $this->input->post('drinknaam');
			$beschrijving    = $this->input->post('beschrijving');
			
			if ($this->Dranken_model->addDrank($drinknaam, $beschrijving)) {

				$this->load->view('header');
				$this->load->view('dranken/admin/add/add_success', $data);
				$this->load->view('footer');
				
			} else {

				$data->error = 'Er was een probleem tijdens het aanmaken van jou account, probeer het alstublieft opnieuw.';

				$this->load->view('header');
				$this->load->view('gebruiker/register/register', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}

        public function view($beschrijving = NULL)
        {
        $data['drink_item'] = $this->dranken_model->get_drank($beschrijving);

        if (empty($data['drink_item']))
        {
                show_404();
     
        }
        
		$this->load->view('header');
		$this->load->view('dranken/drank/index', $data);
		$this->load->view('footer');
        }

		
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
    public function Edit($dranken_id){


            if (empty($dranken_id))
            {
                show_404();
            }

            $this->load->helper('form');
            $this->load->library('form_validation');

            //$data['title'] = 'Edit a books item';
            $data['drink_item'] = $this->Dranken_model->get_drank_by_id_from_drinknaam($dranken_id);     

		$this->form_validation->set_rules('drinknaam', 'Drinknaam', 'required|alpha_numeric');
		$this->form_validation->set_rules('beschrijving', 'Beschrijving', 'required|alpha_numeric');
		
		if ($this->form_validation->run() === false) {

			$this->load->view('header');
			$this->load->view('dranken/admin/edit/edit');
			$this->load->view('footer');
			
		} else {

			$Drinknaam = $this->input->post('Drinknaam');
			$beschrijving = $this->input->post('beschrijving');
			
			if ($this->Dranken_model->editDrank($Drinknaam, $beschrijving)) {
				
				$drank_id = $this->Dranken_model->krijg_id_van_drinknaam($Drinknaam);
				$drank    = $this->Dranken_model->krijg_drinknaam($drank_id);

				/*
				$_SESSION['gebruiker_id']      = (int)$gebruiker->id;
				$_SESSION['gebruikersnaam']     = (string)$gebruiker->gebruikersnaam;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_confirmed'] = (bool)$gebruiker->is_confirmed;
				$_SESSION['is_admin']     = (bool)$gebruiker->is_admin;
				*/
				
				$this->load->view('header');
				$this->load->view('dranken/admin/edit_gelukt', $data);
				$this->load->view('footer');
				
			} else {


				$data->error = 'Er is iets fout gegaan, probeer het alstublieft opnieuw!';

				$this->load->view('header');
				$this->load->view('dranken/admin/edit', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}
	
	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}

			$this->load->view('header');
			$this->load->view('gebruiker/logout/logout_success', $data);
			$this->load->view('footer');
			
		} else {
			redirect('/');	
		}
		
	}
	
}