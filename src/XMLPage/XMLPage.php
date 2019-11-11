<?php
namespace nighttraveler7\XMLPage;

class XMLPage
{
	const XMLPAGES_PATH = $_SERVER['DOCUMENT_ROOT'] . '/xmlpages';

	public $page_name = "404";
	public $xmlpages_path = self::XMLPAGES_PATH;
	protected $file_name;
	public $text_content;
	public $xml_content;

	public function __construct($page_name) {
		$this->page_name = $page_name;
		$this->file_name = $xmlpages_path . '/' . $page_name . '.xml';
		$this->text_content = file_read_contents($this->file_name);
		$xml_content = new SimpleXMLElement($this->text_content);
	}

	public function getHeadText($file)
	{
		$result = <<<EOF
<meta charset="UTF-8">
<title>${xml_content->title}</title>
EOF;
		return $result;
	}
}

class Template {
	public function showTemplate($page_name = NULL) {
		if (is_null($page_name)) {
			$page_name = basename($_SERVER['SCRIPT_NAME'], '.php');
		}
		require_once(__DIR__ . '/Template.php');
	}
}
?>
