<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

trait SendBrowser
{
    protected $browser; //, $code;
    private $indexPage = 1;
    private $arrayResult = [];




    public function sendBrowser($opcs)
    {
        extract($opcs);

        $url = isset($url) ? (strstr($url, "http") || strstr($url, "https") ? $url : $this->url . $url) : $this->url;


        if (!isset($headers)) {
            $headers = array();
        } else {
            foreach ($headers as $index => $value) {
                $indexH = (0 === strpos($index, 'HTTP_') || 0 === strpos($index, ':')) ? $index : 'HTTP_' . $index;
                $this->browser->setServerParameter($indexH, $value);
            }
        }


        switch ($method) {
            case 'POST':
                if (isset($methodoption)) {
                    // Se busca de algún modo el form.
                    if (strstr($methodoption, "=")) {
                        // $opt = explode("=", $methodoption);
                        $opt = preg_split("/=/", $methodoption);
                        $form = $documento->filterXpath('//form[contains(@' . $opt[0] . ',"' . $opt[1] . '")]')->form(); #cambio
                        $url = $form->getUri(); #cambio - Se obtiene la url para hacerlo correcto.
                        $form = $form->getvalues(); #cambio
                    } else {
                        $form = $documento->selectButton($methodoption)->form(); #cambio
                        $url = $form->getUri(); #nuevo
                        $form = $form->getvalues(); #nuevo
                    }
                }
                // Se crea el array
                $this->arrayResult = isset($array) ? $this->arrayMake($array, $form ?? NULL, NULL) : array();

                try {
                    $doc = $this->browser->request('POST', $url, $this->arrayResult);
                } catch (Exception $ex) {
                    $this->setError(99, 'Sendbrowser::POST :' . $ex->getMessage());
                }
                break;
            case 'SUBMIT':
                try {
                    $doc = $this->browser->submit($form, $params);
                } catch (Exception $ex) {
                    $this->setError(99, 'Form SUBMIT:' . $ex->getMessage());
                }

                break;
            case 'BOTON': // Se hace la búsqueda del botón.
                try {
                    $form = $documento->selectButton($methodoption)->form();
                    // dd($form);
                    // $form->setValues($this->arrayMake($array, $form,$documento));
                    $this->arrayResult = isset($array) ? $this->arrayMake($array, $form, $documento) : array();
                    // dd($this->arrayResult,$array,$form->getValues());
                    $doc = $this->browser->submit($form, $this->arrayResult);
                } catch (Exception $exx) {
                    $this->setError(99, 'Form Boton:' . $exx->getMessage());
                }

                break;
            default:
                try {
                    $doc = $this->browser->request('GET', $url);
                } catch (Exception $ex) {
                    $this->setError(99, 'Form GET:' . $ex->getMessage());
                }
                break;
        }
        $this->setScrapp($opcs);

        // Se manejan los errores del Servicio
        if (method_exists($this, 'handleErrors'))
            if (!empty($doc)) $this->handleErrors($doc);

        try {

            $this->resp["code"] = $this->browser->getResponse()->getStatusCode();
        } catch (Exception $ex) {
            // $this->setError(99, 'Form GET:' . $ex->getMessage());
        }
        return $doc;
    }

    function arrayMake($array, $form, $doc)
    {
        $arrayMake = is_object($form) ? $form->getValues() : (is_array($form) ? $form : array());

        foreach ($arrayMake as $index => $value) {
            if (isset($array[$index])) {
                $value = $array[$index];
                unset($array[$index]);
            }

            // $indices = array_keys($array);
            // foreach ($indices as $indice)
            //     if (strstr($index, $indice)) {
            //         $value = $array[$indice];
            //         unset($array[$indice]);
            //         break;
            //     }

            if (strstr($index, '_rppDD')) {
                $this->javainput = intval(preg_replace('/[^0-9]+/', '', $index), 10);
            }
            if (strstr($index, "j_idt")) {
                intVal($this->javanumero = preg_replace("#\D#", '', $index));
            }
            $arrayMake[$index] = $value;
        }


        foreach ($array as $index => $value) {
            $javaFaces = [
                "partial.ajax" => "javax.faces.partial.ajax",
                "partial.execute" => "javax.faces.partial.execute",
                "partial.render" => "javax.faces.partial.render",
                "partial.event" => "javax.faces.partial.event",
                "faces.source" => "javax.faces.source",
                "behavior.event" => "javax.faces.behavior.event",
                "faces.ViewState" => "javax.faces.ViewState",
            ];

            $arrayMake[$javaFaces[$index] ?? $index] = $index === "javax.faces.ViewState" && $value == '' ? $this->viewState($doc) : $value;
        }
        $this->arrayResult = $arrayMake;

        return $arrayMake;
    }

    private function viewState($doc)
    {
        $documento = $doc;
        // View state de faces.
        if (!empty($doc) && strstr($documento->html(), "javax.faces.ViewState")) {
            $contenido = [
                '//input[@name="javax.faces.ViewState"]/@value',
                '//update[contains(@id,"ViewState")]',
                '//input[@name="javax.faces.ViewState:0"]/@value',
                '//update[@name="javax.faces.ViewState:0"]/@value',
            ];
            foreach ($contenido as $busqueda) {
                try {
                    // echo "<br>$busqueda";
                    $viewState = $doc->filterXPath($busqueda)->text();
                    break;
                } catch (Exception $e) {
                    $viewState = false;
                }
            }
            if ($viewState)
                return $viewState;
            else
                $this->setError(2, 'Sendbrow:viewState - Se requiere el ViewState y no se obtuvo.');
        }
    }

    // Función que obtiene lo mandado al sendbrowser
    private function setScrapp($opcs)
    {
        $file = "scrapp/scrapp" . $this->indexPage++ . ".html";
        Storage::put($file, $this->browser->getResponse()->getContent());
        $this->resp["scrapp"][] = [
            "file" => $file,
            "url" => isset($url) ? (strstr($url, "http") || strstr($url, "https") ? $url : $this->url . $url) : $this->url,
            "post" => $opcs,
            "maked" => $this->arrayResult,
            "CODE" => $this->browser->getResponse()->getStatusCode(),
            "URIdoc" => $this->browser->getHistory()->current()->getUri(),
        ];
    }


    public function saveCookies()
    {
        $cookieJar = $this->browser->getCookieJar();
        $cookies = $cookieJar->all();
        if ($cookies) {
            $file = "cookies/" . $this->cookie;
            Storage::put($file, serialize($cookies));
            return true;
        }
        return false;
    }

    protected function setCookie()
    {

        $file = "cookies/" . $this->cookie;
        if (Storage::exists($file)) {
            $contents = Storage::get($file);
            $cookies = unserialize(Storage::get($file));
            $cookieJar = $this->browser->getCookieJar();

            // echo "<br>",$this->cookie;
            foreach ($cookies as $cookie) {
                //  echo "<br>".$cookie;
                if (preg_match('/id(.*?)=/', $cookie, $matches)) {
                    $this->session = $matches[1]; // $text contiene el texto entre 'id' y '='
                }

                // if (strstr($cookie, "idrcox") || strstr($cookie, "idacox")) $this->session = $this->between('id', '=', $cookie); // Para la sessión de telcel.
                // if (strstr($cookie, "distrcox") || strstr($cookie, "distacox")) $this->canal = $this->between('=', '; domain=www', $cookie); // Para el canal del rcox
                // if (strstr($cookie, "matrizrcox") || strstr($cookie, "matrizacox")) $this->canalMatriz = $this->between('=', '; domain=www', $cookie); // Para el canal del rcox
                // echo "<br>Expira: ",$cookie->isExpired(),$cookie->getExpiresTime(),$cookie->getRawValue(),$cookie->isSecure();;
                $cookieJar->set($cookie);
            }
        } else {
            // TODA COOKIE ELIMINADA, MANDARÁ LOGUEO AUTOMÁTICO, NO ELIMINAR CUANDO REQUIERE TOKEN.
            $this->setError(0, 'No existe la cookie, se loguea.');
            $this->login();
            return false;
        }
        return true;
    }

    public function headers($type)
    {
        $headers = [];
        switch ($type) {
            case 'r8canales':
                $headers = [
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                    'Accept-Encoding' => 'gzip, deflate, br',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Host' => 'www.r8.telcel.com',
                    'Origin' => 'https://www.r8.telcel.com',
                    'Referer' => 'https://www.r8.telcel.com/CatalogoDAT/loginx.xhtml',
                    'sec-ch-ua' => '"Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"',
                    'sec-ch-ua-mobile' => '?0',
                    'sec-ch-ua-platform' => '"Windows"',
                    'Sec-Fetch-Dest' => 'document',
                    'Sec-Fetch-Mode' => 'navigate',
                    'Sec-Fetch-Site' => 'same-origin',
                    'Sec-Fetch-User' => '?1',
                    'upgrade-insecure-requests' => 1,
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
                ];
            case 'expirado':
                $headers = [
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                    'Accept-Encoding' => 'gzip, deflate, br',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Host' => 'www.r8.telcel.com',
                    'Origin' => 'https://www.r8.telcel.com',
                    'Referer' => 'https://www.r8.telcel.com/CatalogoDAT/loginx.xhtml',
                    'sec-ch-ua' => '"Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"',
                    'sec-ch-ua-mobile' => '?0',
                    'sec-ch-ua-platform' => '"Windows"',
                    'Sec-Fetch-Dest' => 'document',
                    'Sec-Fetch-Mode' => 'navigate',
                    'Sec-Fetch-Site' => 'same-origin',
                    'Sec-Fetch-User' => '?1',
                    'upgrade-insecure-requests' => 1,
                ];
                break;
        }

        return $headers;
    }

    private function setError($numero, $mensaje, $data = NULL) // Se utiliza para los códigos de error.
    {
        // Solo si no hay un numero error grave.
        $numAnterior = (int)$this->resp["status"];
        if ($numAnterior <= $numero) {
            $this->resp["status"] = $numero;
            $this->resp["msg"] = $mensaje;
        }
        if ((int)$this->resp["status"] <= $numero && $data != NULL)
            $this->resp["data"] = $data;

        if ($numero > 0) die(json_encode($this->resp));
    }
}
