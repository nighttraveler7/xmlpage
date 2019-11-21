# PHP Page Commonization System

## Other Languages
- このドキュメントの日本語版は README-ja.md です。
- To read this document in English, please continue reading.

## Description
You can summarize your duplicated code on multiple files to one file using this library.  
Different parts can be written in XML.

## Requirements
- Web server
- PHP 7.3 or later
- SimpleXML Extension
- Composer

## Installation
Type the following command on your shell:
```shell
composer require nighttraveler7/xmlpage && composer install
```

## Mechanism
1. The client requests the first PHP file.
2. On the serverside, the PHP program creates instance of the template engine class.
3. The program calls load_template method of the instance.
4. The template engine loads the template file.
5. The template loads the XML file.
6. The template engine echos the parsed content to the client.

## Usage
- This is a content of the XML file on xmlpages directory. (Default path: "/xmlpages/<PAGE_BASENAME_WITHOUT_EXT>.xml" on your document root)

  ```XML
  <?xml version="1.0" encoding="utf-8" ?>
  <page>
  	<title>Helloworld</title>
  	<content><![CDATA[<p>Hello world!</p>]]></content>
  </page>
  ```

- This is a content of the first requested PHP file by client.

  ```PHP
  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
  use nighttraveler7\XMLPage\Template;
  $template_path = $_SERVER['DOCUMENT_ROOT'] . '/template.php';  

  $args = array();

  $template = new Template($template_path);
  $template->load_template($args);
  $template->show_template();
  ?>
  ```

- This is a content of the common template file. (Default path: "/template.php" on your document root)

  ```PHP
  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');
  use nighttraveler7\XMLPage\XMLPage;

  if (!isset($page_name)) {
  	$page_name = XMLPage::get_current_page_name();
  }

  $xmlpage = new XMLPage($page_name);
  $xml_content = $xmlpage->xml_content;
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  <meta charset="UTF-8">
  <title><?php echo $xml_content->title; ?></title>
  </head>
  <body>
  <div class="content"><?php echo $xml_content->content; ?></div>
  </body>
  </html>
  ```
