# ThemeXpert WpUtility

## Example

```php
require "vendor/autoload.php";

use ThemeXpert\WpUtility\Metabox;

class XBox extends Metabox{
	public function render($post){
		return view(__DIR__ . "/settings.php", array("name"=>"Tuhin"));
	}

	public function save($post_id){
		echo "saving.."; die();
	}
}

$box = new XBox("ps", "Page Sections", ["page_section"]);
```

## Installation
install with composer

```json
{
	"require": {
		"themexpert/wp-utility":"dev-master"
	}
}
```