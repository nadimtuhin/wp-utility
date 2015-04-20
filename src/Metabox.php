<?php namespace ThemeXpert\WpUtility;

// use ThemeXpert\WpUtility\Nonce;

abstract class Metabox {
	protected $slug;
	protected $title;
	protected $screens;

	/**$screens = array( 'page_section' )**/
	public function __construct($slug, $title, $screens){
		$this->slug = $slug;
		$this->title = $title;
		$this->screens = $screens;
		
		//register a metabox
		add_action( 'add_meta_boxes', [$this, 'registerMetaBox'] );
		//save metabox
		add_action( 'save_post', [$this, 'onSavePost'] );
	}

	public function registerMetaBox(){
		foreach ( $this->screens as $screen ){
			add_meta_box($this->slug, $this->title, [$this, 'renderMetaBox'], $screen);
		}
	}

	public function renderMetaBox($post){
		$this->getNonce()->field();

		echo $this->render($post);
	}

	public function onSavePost($post_id){
		if($this->getNonce()->fail()){
			return;
		}

		if($this->isDoingAutoSave()){
			return;
		}

		if(!$this->userHasPermission($post_id)){
			return;
		}

		$this->save($post_id);
	}

	protected function isDoingAutoSave(){
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return true;
		}

		return false;
	}

	protected function userHasPermission($post_id){
		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return false;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return false;
			}
		}

		return true;
	}

	protected function getNonce(){
		return new Nonce($this->slug);
	}

	public function getTitle(){
		return $this->title;
	}

	public function getSlug(){
		return $this->slug;
	}

	abstract public function render($post);
	abstract public function save($post_id);
}