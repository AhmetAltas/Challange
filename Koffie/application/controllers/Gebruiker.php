<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 * 
 * @extends CI_Controller
 */
class Gebruiker extends CI_Controller {
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
		$this->load->model('gebruiker_model');
		
	}

	
	
	public function index() {
		
		
	}
	
	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		
		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('gebruikersnaam', 'Gebruikersnaam', 'trim|required|alpha_numeric|min_length[4]|is_unique[gebruikers.gebruikersnaam]', array('is_unique' => 'Deze gebruikersnaam bestaat al. Neem a.u.b. een andere.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[gebruikers.email]');
		$this->form_validation->set_rules('wachtwoord', 'Wachtwoord', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('wachtwoord_confirm', 'Confirm Wachtwoord', 'trim|required|min_length[6]|matches[wachtwoord]');
		$this->form_validation->set_rules('vraag', 'Vraag', 'trim|required|min_length[2]');
		
		if ($this->form_validation->run() === false) {
			
			$this->load->view('header');
			$this->load->view('gebruiker/register/register', $data);
			$this->load->view('footer');
			
		} else {
			
			$gebruikersnaam = $this->input->post('gebruikersnaam');
			$email    = $this->input->post('email');
			$wachtwoord = $this->input->post('wachtwoord');
			$vraag = $this->input->post('vraag');
			
			if ($this->gebruiker_model->create_user($gebruikersnaam, $email, $wachtwoord, $vraag)) {
				
				$this->load->view('header');
				$this->load->view('gebruiker/register/register_success', $data);
				$this->load->view('footer');
				
			} else {
				
				$data->error = 'Er is een probleem onstaan terwijl het maken van uw account. Probeert u het nog eens';
				
				$this->load->view('header');
				$this->load->view('gebruiker/register/register', $data);
				$this->load->view('footer');
				
			}
			
		}
		
	}




	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login() {
		
		$data = new stdClass();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('gebruikersnaam', 'Gebruikersnaam', 'required|alpha_numeric');
		$this->form_validation->set_rules('wachtwoord', 'Wachtwoord', 'required');
		
		if ($this->form_validation->run() == false) {
			
			$this->load->view('header');
			$this->load->view('gebruiker/login/login');
			$this->load->view('footer');
			
		} else {
			
			$gebruikersnaam = $this->input->post('gebruikersnaam');
			$wachtwoord = $this->input->post('wachtwoord');
			
			if ($this->gebruiker_model->resolve_user_login($gebruikersnaam, $wachtwoord)) {

				
				$gebruiker_id = $this->gebruiker_model->get_user_id_from_username($gebruikersnaam);
				$gebruiker    = $this->gebruiker_model->get_user($gebruiker_id);
				$is_admin    =  $this->gebruiker_model->get_admin($gebruiker_id);
				//$ktest = $this->gebruiker_model->get_admin($gebruiker_id);
				

               var_dump($is_admin);

             
				if ($is_admin === 'Admin') {
					$is_admin = true;
				}

				else if($is_admin === 'User') {
					$is_admin = false;
				};

			//	else {
			//		$ktest = '3';
			//	};
				
				$_SESSION['gebruiker_id']      = (int)$gebruiker_id;
				$_SESSION['gebruikersnaam']     = (string)$gebruikersnaam;
				$_SESSION['logged_in']    = (bool)true;
				//$_SESSION['is_confirmed'] = (bool)$gebruiker->is_confirmed;
				$_SESSION['is_admin']     = (bool)$is_admin;
				

			if ($is_admin == false) {
				
			
				$this->load->view('header');
				$this->load->view('gebruiker/login/login_success', $data);
				$this->load->view('footer');
				}
			elseif ($is_admin == true) {
				$this->load->view('header');
				$this->load->view('gebruiker/login/login_success_admin', $data);
				$this->load->view('footer');
			}

			} else {
				
				
				$data->error = 'Verkeerde gebruikersnaam of wachtwoord.';
				
				$this->load->view('header');
				$this->load->view('gebruiker/login/login', $data);
				$this->load->view('footer');
				
			}
			
		}
	//var_dump($_POST);
	
			//	die();	
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