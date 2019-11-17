<?php
namespace nighttraveler7\XMLPage;

class XMLPage {
	const XMLPAGES_PATH = '/xmlpages';

	public $page_name = "404";
	public $xmlpages_path;
	protected $file_name;
	public $text_content;
	public $parsed_content;
	public $xml_content;

	public static function get_current_page_name() {
		return basename($_SERVER['SCRIPT_NAME'], '.php');
	}

	public function __construct($page_name) {
		$this->xmlpages_path = $_SERVER['DOCUMENT_ROOT'] . self::XMLPAGES_PATH;
		$this->page_name = $page_name;
		$this->file_name = $this->xmlpages_path . '/' . $page_name . '.xml';
		$this->text_content = file_get_contents($this->file_name);
		$this->parsed_content = Template::vksprintf($this->text_content, $args);
		$this->xml_content = new \SimpleXMLElement($this->parsed_content);
	}
}
?>
