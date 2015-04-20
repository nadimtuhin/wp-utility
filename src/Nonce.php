<?php namespace ThemeXpert\WpUtility;

class Nonce{
	protected $nonce_action;
	protected $nonce_field;

	public function __construct($slug){
		$this->nonce_ation = $slug."_nonce_action";
		$this->nonce_field = $slug.'_nonce_field';
	}

	public function field(){
		wp_nonce_field( $this->nonce_action, $this->nonce_field );
	}

	public function verify(){
		// Check if our nonce is set.
		if ( ! isset( $_POST[$this->nonce_field] ) ) {
			return false;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST[$this->nonce_field], 
				$this->nonce_action ) ) {
			return false;
		}

		return true;
	}

	public function fail(){
		return ! $this->verify();
	}
}