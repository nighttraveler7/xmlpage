PHP Page Commonization System
====

## Other Languages
- このドキュメントの日本語版は README-ja.md です。
- To read this document in English, please continue reading.

## Description
You can summarize your duplicated code on multiple files to one file using this library.  
Different part(s) can be written in XML.

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

## Usage
- This is a content 

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

- This is a content of the common template file (Default Path: "/template.php" on your document root)
