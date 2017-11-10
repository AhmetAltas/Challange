<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User_model class.
 * 
 * @extends CI_Model
 */
class Dranken_model extends CI_Model {
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	
	/**
	 * create_user function.
	 * 
	 * @access public
	 * @param mixed $gebruikersnaam
	 * @param mixed $email
	 * @param mixed $wachtwoord
	 * @return bool true on success, false on failure
	 */

	public function addDrank($drinkNaam, $beschrijving) {

		$data = array(
			'drinknaam' => $drinkNaam,
			'beschrijving' => $beschrijving,
		);

		return $this->db->insert('dranken', $data);
	}

	
	/**
	 * resolve_user_login function.
	 * 
	 * @access public
	 * @param mixed $gebruikersnaam
	 * @param mixed $wachtwoord
	 * @return bool true on success, false on failure
	 */
	public function resolve_user_login($gebruikersnaam, $wachtwoord) {
		
		$this->db->select('wachtwoord');
		$this->db->from('gebruikers');
		$this->db->where('gebruikersnaam', $gebruikersnaam);
		$hash = $this->db->get()->row('wachtwoord');
		
		return $this->verify_password_hash($wachtwoord, $hash);
		
	}
	
	/**
	 * get_user_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $gebruikersnaam
	 * @return int the user id
	 */
	public function get_user_id_from_username($gebruikersnaam) {
		
		$this->db->select('id');
		$this->db->from('gebruikers');
		$this->db->where('gebruikersnaam', $gebruikersnaam);
		return $this->db->get()->row('id');
		
	}
	
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $gebruikers_id
	 * @return object the user object
	 */
	public function get_user($gebruikers_id) {
		
		$this->db->from('gebruikers');
		$this->db->where('id', $gebruikers_id);
		return $this->db->get()->row();
		
	}
	
	/**
	 * hash_password function.
	 * 
	 * @access private
	 * @param mixed $wachtwoord
	 * @return string|bool could be a string on success, or bool false on failure
	 */
	private function hash_password($wachtwoord) {
		
		return password_hash($wachtwoord, PASSWORD_BCRYPT);
		
	}
	
	/**
	 * verify_password_hash function.
	 * 
	 * @access private
	 * @param mixed $wachtwoord
	 * @param mixed $hash
	 * @return bool
	 */
	private function verify_password_hash($wachtwoord, $hash) {
		
		return password_verify($wachtwoord, $hash);
		
	}
	

	/**
	 * get_user_id_from_username function.
	 * 
	 * @access public
	 * @param mixed $gebruikersnaam
	 * @return int the user id
	 */
	public function get_drank_id_from_drinknaam($drinknaam) {
		
		$this->db->select('id');
		$this->db->from('dranken');
		$this->db->where('drinknaam', $drinknaam);
		return $this->db->get()->row('id');
	}
		
	/**
	 * get_user function.
	 * 
	 * @access public
	 * @param mixed $gebruikers_id
	 * @return object the user object
	 */
	public function get_drank($dranken_id) {
		
		$this->db->from('dranken');
		$this->db->where('id', $dranken_id);
		return $this->db->get()->row();
		
	}
}