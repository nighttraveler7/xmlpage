<?php
namespace nighttraveler7\XMLPage;

class Template {
	public $page_name;
	public $template_path;
	public $raw_data;

	public static function vksprintf($str, $args) {
		if (is_object($args)) {
			$args = get_object_vars($args);
		}
		$map = array_flip(array_keys($args));
		$new_str = preg_replace_callback('/(^|[^%])%([a-zA-Z0-9_-]+)\$/', function ($m) use ($map) {
			return $m[1] . '%' . ($map[$m[2]] + 1) . '$';
		}, $str);
		return vsprintf($new_str, $args);
	}

	public function __construct($page_name = NULL, $template_path = NULL) {
		if (is_null($page_name)) {
			$page_name = XMLPage::get_current_page_name();
		}
		if (is_null($template_path)) {
			$template_path = $_SERVER['DOCUMENT_ROOT'] . '/template.php';
		}
		$this->page_name = $page_name;
		$this->template_path = $template_path;
	}

	public function load_template($args = array()) {
		$page_name = $this->page_name;
		ob_start();
		require_once($this->template_path);
		$this->raw_data = ob_get_contents();
		ob_end_clean();
	}

	public function show_template() {
		echo $this->raw_data;
	}
}
?>
