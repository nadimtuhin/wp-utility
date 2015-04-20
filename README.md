# ThemeXpert WpUtility

## Example

``php
require "vendor/autoload.php";

use ThemeXpert\WpUtility\Metabox;

class XBox extends Metabox{
	public function render($post){
		echo view(__DIR__ . "/views/boxer-settings.php", array("name"=>"Tuhin"));
	}

	public function save($post_id){
		echo "saving.."; die();
	}
}

$box = new XBox("ps", "Page Sections", ["page_section"]);
``