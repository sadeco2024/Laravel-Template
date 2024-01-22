<?php

namespace App\Services;

use App\Services\SendBrowser;
use DOMDocument;
use DOMXPath;
use Exception;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;


class Telcel
{
    use SendBrowser;

    

    public $url = "https://www.r8.telcel.com";
    
    public $resp = ['code' => '', 'status' => 0, 'msg' => '', 'data' => []];

    public $cookie = "cookies/r8telcel.txt";
    public $usuario, $contasena;

    public function __construct()
    {
        $this->browser = new HttpBrowser(HttpClient::create());
        $this->getPasswd();
    }    

    public function getPasswd()
    {
        //TODO: Obtiene el usuario y password de acuerdo al usuario logueado.
        $this->usuario  = 'acox17274';
        $this->contasena = 'acox31802';
        $this->cookie = 'r8_telcel_'.$this->usuario.'.txt';
        
    }

    function parseTable($html) {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
    
        $xpath = new DOMXPath($dom);
    
        $titulos = [];
        foreach ($xpath->query('//thead/tr/th') as $th) {
            $titulos[] = $th->nodeValue;
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

    //TODO: Falta hacer el expirado y el relogin
    public function login()
    {
        $opcs = [
            "method" => "GET",
            "url" => "/intranet/ingreso",
            "goutte" => "loginInicio"
        ];
        $doc = $this->sendBrowser($opcs);

        $opcs = [
            "method" => "BOTON",
            "methodoption" => "Entrar",
            "array" => [
                'j_username' => $this->usuario,
                'j_password' => $this->contasena,
            ],
            "documento" => $doc,
            "goutte" => "login"
        ];
        $doc = $this->sendBrowser($opcs);
        if (strstr($doc->html(),'Usuario o passw')) {
            $this->setError(1,'Usuario o password incorrectos');
        }

		if (strstr($doc->html(), "Password expirado")) {
            $this->setError(1,'Password expirado');
		}        

		try {
            // Si existe algún error en la página login.
           $this->setError(1,$doc->filterXPath('//div/font[@color="#FF6600"]')->text());
           
       } catch (Exception $e) {
           // Si no hay error, se guarda todo. Se obtiene la sessión y los demás frames.
           $frames =  $doc->filterXpath('//frame')->extract(array('name', 'src'));
           foreach ($frames as $index => $row) {
            //    if (strstr($row[1], "nt.pl?session=" . $this->usuario)) $this->session = $this->between('nt.pl?session=', '&user=', $row[1]);
               $doc = $this->browser->request('GET', $this->url . $row[1]);
           }
           $this->saveCookies($this->usuario); 
       }    
        return $this->resp;
    }

	public function getCanales() // Solo funciona con el acox principal.
	{
		if (!$this->validaSesion()) return $this->resp;
        // $this->url =  "https://www2.r8.telcel.com";


        //https://www2.r8.telcel.com/CatalogoDAT/index.jsp?session=acox17274-YEBdphSzQUlSphz&priv=A
		$opcs = [
			"method" => "GET",
			// "url" => "/CatalogoDAT/pages/consultaDAT.xhtml",
            "url"=>'/CatalogoDAT/pages/consultaDAT.xhtml',
			"scrapping" => true
		];
		$doc = $this->sendBrowser($opcs);

        $opcs = [
			"method" => "POST",
			// "headers" => $this->headers('r8canales'),
            "url"=> '/CatalogoDAT/loginx.xhtml',
			"array" => [
                'j_idt6:j_idt15'=>'',
                'j_idt6' => 'j_idt6',
				"j_idt6:user_name_id" => $this->usuario,
				"j_idt6:passwd_id" => $this->contasena,
                'javax.faces.ViewState'=>$this->viewState($doc)
			],
			"scrapping" => true
		];
        $doc = $this->sendBrowser($opcs);   

        $opcs = [
            "method" => "BOTON",
            "methodoption" => "Consulta",
            "documento" => $doc,
            "scrapping" => "canales"
        ];
        $doc = $this->sendBrowser($opcs);        

        dd($this->parseTable($doc->html()));
        dd($opcs,$this->resp,$doc->html());     

		$opcs = [
			"method" => "BOTON",
			"methodoption" => "Entrar",
			"array" => [
				"user_name_id" => $this->usuario,
				"passwd_id" => $this->contasena,
                // "faces.ViewState"=>'',
                // 'javax.faces.ViewState:0'=>$this->viewState($doc)
			],
			"documento" => $doc,
			"scrapping" => true
		];
		$doc = $this->sendBrowser($opcs);   

        $opcs = [
			"method" => "BOTON",
			"methodoption" => "Entrar",
			"array" => [
				"user_name_id" => $this->usuario,
				"passwd_id" => $this->contasena,
                // "faces.ViewState"=>'',
                // 'javax.faces.ViewState:0'=>$this->viewState($doc)
			],
			"documento" => $doc,
			"scrapping" => true
		];
		$doc = $this->sendBrowser($opcs);           
        
        dd($this->resp,$doc->html());     
    }    


	private function validaSesion()
	{
		//$this->url = "https://www2.r8.telcel.com"; // Cuando se manda validasesion, la url de TAF contiene el www2, por lo que se cambia, ya hay loguin, se están pidiendo métodos.
        
		if (!$this->setCookie()) return false;
        
		$opcs = [
			"method" => "GET",
			"url" => "/intsegutils/?sol=2&priv=A",
		];
		$doc = $this->sendBrowser($opcs);

		if (strstr($this->browser->getResponse()->getContent(), "Ha alcanzado su")) {
			$this->setError(1,"Cuenta bloqueada por intentos excedidos. Solicitar un reset a la cuenta: $this->usuario.");
			unlink($this->cookie);
			return false;
		}
		// Esta autovalida la sesión, proque lo hace el sendBrowser ya automático.
		return true;
	}
}
