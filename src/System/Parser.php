<?php

namespace System;

require 'vendor/autoload.php';

use DiDom\Document;




class Parser
{

  public function getHtml(string $url)
  {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
  }

  public function getCurrencies()
  {
    $arr = [];
    $document = new Document();
    $document->loadHtmlFile("https://www.cbr.ru/currency_base/daily/");
    $dom = $document->first('table.data')->find('tr');
    echo '<pre>';
    foreach ($dom as $key => $item) {

      $tdItems =  $item->find('td');
      foreach ($tdItems as $item2) {
        $arr[$key][] = $item2->text();
      }
    };

    return array_values($arr);
  }
}
