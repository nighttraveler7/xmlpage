# PHP ページ共通化システム

## Other Languages
- このドキュメントを日本語でお読みになる場合、続けてお読みください。
- The English-translated version of this document is README.md

## 解説
このライブラリを使えば、複数のファイル上で重複したコードを、1つのファイルにまとめることができます。  
異なる部分はXMLに記述することができます。

## 必須要件
- Web サーバ
- PHP 7.3 以上
- SimpleXML 拡張機能
- Composer

## インストール
以下のコマンドをシェル上で入力してください:
```shell
composer require nighttraveler7/xmlpage && composer install
```

## 仕組み
1. クライアントが、最初の PHP ファイルを要求します。
2. サーバサイド上で、PHP プログラムがテンプレートエンジンクラスのインスタンスを作成します。
3. プログラムが、インスタンスの load_template メソッドを読み込みます。
4. テンプレートエンジンが、テンプレートファイルを読み込みます。
5. テンプレートが、XML ファイルを読み込みます。
6. テンプレートエンジンが、パースされた内容をクライアントに返します。

## 使い方
- これは xmlpages ディレクトリにある XML ファイルの内容です。(既定のパス: ドキュメントルート上にある "/xmlpages/<拡張子を除いたファイル名>.xml")

  ```XML
  <?xml version="1.0" encoding="utf-8" ?>
  <page>
  	<title>Helloworld</title>
  	<content><![CDATA[<p>Hello world!</p>]]></content>
  </page>
  ```

- これはクライアントによって最初にリクエストされる PHP ファイルの内容です。

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

- これは共通テンプレートファイルの内容です。(既定のパス: ドキュメントルート上にある "/template.php")

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
