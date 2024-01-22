<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;

trait Utilidades
{



    public function parseTable($html)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        $titulos = [];
        foreach ($xpath->query('//thead/tr/th') as $th) {
            $titulos[] = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($th->nodeValue)); //$th->nodeValue;
        }

        $data = [];
        foreach ($xpath->query('//tbody/tr') as $tr) {
            $row = [];
            $tds = $xpath->query('td', $tr);
            foreach ($tds as $i => $td) {
                $row[$titulos[$i]] = $td->nodeValue;
            }
            $data[] = $row;
        }

        return $data;
    }
}

?>