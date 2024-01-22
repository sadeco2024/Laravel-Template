<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\Exception\HttpException;

trait SendBrowser
{
    protected $browser; //, $code;
    private $indexPage = 1;
    private $arrayResult = [];

    // public function __construct()
    // {
    //     $this->browser = new HttpBrowser(HttpClient::create());
    //     $this->getPasswd();
    // }


    public function sendBrowser($opcs)
    {
        extract($opcs);
        // dd($opcs);

        $url = isset($url) ? (strstr($url, "http") || strstr($url, "https") ? $url : $this->url . $url) : $this->url;

		// if (isset($headers)) { 
		// 	foreach ($headers as $index => $value) {
		// 		if (0 === strpos($index, 'HTTP_') || 0 === strpos($index, ':') ) $indexH = $index;
		// 		else $indexH = 'HTTP_'.$index;
		// 		 echo "<br>Index: ",$index," - Make:   ",$indexH, "-- ",strpos($index, ':');
		// 	}
		// } else $headers = array();

        if (!isset($headers)) { 
            $headers = array();
        } else {
            foreach ($headers as $index => $value) {
                $indexH = (0 === strpos($index, 'HTTP_') || 0 === strpos($index, ':')) ? $index : 'HTTP_'.$index;
                // echo "<br>Index: ",$index," - Make:   ",$indexH, "-- ",strpos($index, ':');
            }
        }        


        switch ($method) {
            case 'POST':

                $doc = $this->browser->request('POST', $url, $array);
                break;
            case 'SUBMIT':
                $doc = $this->browser->submit($form, $params);
                break;
            case 'BOTON': // Se hace la búsqueda del botón.
                try {
                    $form = $documento->selectButton($methodoption)->form();
                    // $form->setValues($this->arrayMake($array, $form,$documento));
                    $this->arrayResult = isset($array) ? $this->arrayMake($array, $form,$documento) : array();
                    $doc = $this->browser->submit($form, $this->arrayResult);
                } catch (Exception $exx) {
                    $this->setError(99, $exx->getMessage());
                }
                
                break;
            default:
                $doc = $this->browser->request('GET',$url);
                break;
        }

        // Se obtiene el último código de respuesta.
        $this->resp["code"] = $this->browser->getResponse()->getStatusCode();
        $this->setScrapp($opcs);
        return $doc;
    }

    function arrayMake($array, $form, $doc)
    {
        $arrayMake = is_object($form) ? $form->getValues() : (is_array($form) ? $form : array());
        $indices = array_keys($array);
        
    
        foreach ($arrayMake as $index => $value) {
            if (isset($array[$index])) {
                $value = $array[$index];
                unset($array[$index]);
            }
            foreach($indices as $indice)
                if (strstr($index, $indice)) {
                    $value = $array[$indice];
                    unset($array[$indice]);
                    break;
                }

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
    
            $arrayMake[$javaFaces[$index] ?? $index] = $index === "faces.ViewState" ? $this->viewState($doc) : $value;
        }
    
        return $arrayMake;
    }

	function arrayMakeant($array, $form)
	{
		$arrayMake = array();

		if (is_object($form)) {
			$arrayMake = $form->getValues();

			foreach ($arrayMake as $index => $value) {  // Se actualiza el valor.
				foreach ($array as $indexS => $valueS)
					if (strstr($index, $indexS)) {
						$value = $valueS;
						unset($array[$indexS]);
						break;
					}
				$arrayMake[$index] = $value;
			}
			// Se guarda el form_values, para su envio
			return $arrayMake;
		} else {
			// Se ponen valores si se mando un array predefinido.
			$arrayMake = is_array($form) ? $form : array();

			foreach ($arrayMake as $index => $value) {
				foreach ($array as $indexS => $valueS) {
					if (strstr($index, $indexS)) {
						$value = $valueS;
						unset($array[$indexS]);
					} // Se actualiza el valor.
					if (strstr($index, '_rppDD')) {
						$this->javainput = intval(preg_replace('/[^0-9]+/', '', $index), 10);
					}
					if (strstr($index, "j_idt")) intVal($this->javanumero = preg_replace("#\D#", '', $index));
					//if (isset($this->javanumero)) dd($this->javanumero);
				}
				// Se guarda el form_values, para su envio
				$arrayMake[$index] = $value;
			}

			foreach ($array as $index => $value) {
				//predeterminadas:
				switch ($index) {
						/* JAVA FACES */
					case "partial.ajax":
						$arrayMake["javax.faces.partial.ajax"] = $value;
						break;
					case "partial.execute":
						$arrayMake["javax.faces.partial.execute"] = $value;
						break;
					case "partial.render":
						$arrayMake["javax.faces.partial.render"] = $value;
						break;
					case "partial.event":
						$arrayMake["javax.faces.partial.event"] = $value;
						break;
					case "faces.source":
						$arrayMake["javax.faces.source"] = $value;
						break;
					case "behavior.event":
						$arrayMake["javax.faces.behavior.event"] = $value;
						break;
					case "faces.ViewState":
						$arrayMake["javax.faces.ViewState"] = $this->viewState;
						break;
					default:
						$arrayMake[$index] = $value;
				}
			}
			return $arrayMake;
		}
	}
    

    private function viewState($doc)
    {
        // View state de faces.
        if (strstr($doc->html(), "javax.faces.ViewState")) {
            $contenido = [
                '//input[@name="javax.faces.ViewState:0"]/@value',
                '//update[@name="javax.faces.ViewState:0"]/@value',
                '//input[@name="javax.faces.ViewState"]/@value',
                '//update[contains(@id,"ViewState")]'
            ];
            foreach ($contenido as $busqueda) {
                try {
                    $viewState = $doc->filterXPath($busqueda)->text();
                } catch (Exception $e) {
                    $viewState = false;
                }
                if ($viewState) {
                    return $viewState;
                    break;
                }
            }
            return $viewState;
        }
        $this->setError(2, 'No se encontró el viewstate');
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
            "URIdoc" => $this->browser->getHistory()->current()->getUri()
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
                // if (strstr($cookie, "idrcox") || strstr($cookie, "idacox")) $this->session = $this->between('id', '=', $cookie); // Para la sessión de telcel.
                // if (strstr($cookie, "distrcox") || strstr($cookie, "distacox")) $this->canal = $this->between('=', '; domain=www', $cookie); // Para el canal del rcox
                // if (strstr($cookie, "matrizrcox") || strstr($cookie, "matrizacox")) $this->canalMatriz = $this->between('=', '; domain=www', $cookie); // Para el canal del rcox
                // echo "<br>Expira: ",$cookie->isExpired(),$cookie->getExpiresTime(),$cookie->getRawValue(),$cookie->isSecure();;
                $cookieJar->set($cookie);
            }
        } else {
            // TODA COOKIE ELIMINADA, MANDARÁ LOGUEO AUTOMÁTICO, NO ELIMINAR CUANDO REQUIERE TOKEN.
            $this->login();
            return false;
        }
        return true;
    }

    public function headers($type) {
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
