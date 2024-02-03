<?php

namespace App\Services;

use App\Models\Telcel\Canal;
use App\Models\Telcel\CanalVendedor;
use App\Services\SendBrowser;
use App\Services\Utilidades;
use DateTime;
use DOMDocument;
use DOMXPath;
use Exception;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;


class Telcel
{
    use SendBrowser, Utilidades;




    public $url = "https://www.r8.telcel.com";

    public $resp = ['code' => '', 'status' => 0, 'msg' => '', 'data' => []];

    public $cookie = "cookies/r8telcel.txt";
    public $usuario, $contrasena,$clave, $session;

    public function __construct()
    {
        // $this->browser = new HttpBrowser(HttpClient::create());
        $this->browser = new HttpBrowser(HttpClient::create(['timeout' => 300, 'verify_host' => false, 'verify_peer' => false]));

        // Todo: el constructor, debería recibir siempre el canal
        $this->getPasswd(Canal::first());
    }

    public function getPasswd(Canal $canal)
    {
        //TODO: Obtiene el usuario y password de acuerdo al usuario logueado.
        $this->usuario  = $canal->acox ?? 'acox17274';
        $this->contrasena = $canal->contrasena ?? 'acox99170';
        $this->clave = $canal->clave ?? 'RPHAESC';
        $this->cookie = 'r8_telcel_' . $this->usuario . '.txt';
    }



    
    public function login()
    {
        $this->browser = new HttpBrowser(HttpClient::create(['timeout' => 60, 'verify_host' => false, 'verify_peer' => false]));

        $opcs = [
            "method" => "GET",
            "url" => "/intranetv3/ingreso",
            "scrapping" => 'login:first'
        ];
        $doc = $this->sendBrowser($opcs);

        $opcs = [
            "method" => "BOTON",
            "methodoption" => "Entrar",
            "array" => [
                'j_username' => $this->usuario,
                'j_password' => $this->contrasena,
            ],
            "documento" => $doc,
            "scrapping" => 'login:entrar'
        ];
        $doc = $this->sendBrowser($opcs);

        if (strpos($doc->html(), 'La cuenta esta bloqueada 60 minutos') !== false) {
            $this->setError(1, 'La cuenta esta bloqueada 60 minutos, debe aplicar reinicio.');
        }
        if (strpos($doc->html(), 'Usuario o passw') !== false) {
            $this->setError(1, 'Usuario o password incorrectos');
        }

        // ** Password Expirado
        if (strstr($doc->html(), "Password expirado")) {
            $this->passExpirado($doc);
            $this->setError(0, 'Se cambió la contraseña.');
            // $this->setError(1, 'Password expirado');
        }


        try {
            // Si existe algún error en la página login.
            $this->setError(1, 'Login: ' . $doc->filterXPath('//div/font[@color="#FF6600"]')->text());
        } catch (Exception $e) {
            // Si no hay error, se guarda todo. Se obtiene la sessión y los demás frames.
            $frames =  $doc->filterXpath('//frame')->extract(array('name', 'src'));
            $this->saveCookies($this->usuario);
        }

        return true;
        return $this->resp;
    }

    public function getCanales()
    {
        if (!$this->validaSesion()) return $this->resp;
        $opcs = [
            "method" => "GET",
            "url" => '/CatalogoDAT/pages/consultaDAT.xhtml',
            "scrapping" => 'getCanales'
        ];
        $doc = $this->sendBrowser($opcs);


        $opcs = [
            "method" => "POST",
            "url" => '/CatalogoDAT/loginx.xhtml',
            "array" => [
                'j_idt6:j_idt15' => '',
                'j_idt6' => 'j_idt6',
                "j_idt6:user_name_id" => $this->usuario,
                "j_idt6:passwd_id" => $this->contrasena,
                'javax.faces.ViewState' => $this->viewState($doc)
            ],

            "scrapping" => false
        ];
        $doc = $this->sendBrowser($opcs);

        $opcs = [
            "method" => "BOTON",
            "methodoption" => "Consulta",
            "documento" => $doc,
            "scrapping" => false
        ];
        $doc = $this->sendBrowser($opcs);
        $this->setError(0, "Canales obtenidos correctamente.", $this->parseTable($doc->html()));
        return $this->resp;
    }

    public function setQuestion(Canal $canal)
    {
        $this->getPasswd($canal);

        if (!$this->validaSesion()) return $this->resp;

        $opcs = [
            "method" => "GET",
            "url" => "/intsegutils/?sol=2&priv=A",
            "scrapping" => true
        ];
        $doc = $this->sendBrowser($opcs);


        $preguntas = ["LOGIN AUTOMÁTICO", 'SISTEMAS AUTOMATICOS', 'TELCEL AUTOMÁTICOS', 'SISTEMA DE AUTOGESTIÓN', 'TELCEL AUTOGESTIONABLE', 'LOGIN AUTOGESTIONABLE', 'AUTOMATICOS', ' SISTEMAS SISTEMAS SISTEMAS', 'LOGIN LOGIN LOGIN', 'TELCEL TELCEL TELCEL'];
        $preg = rand(0, count($preguntas) - 1);

        $opcs = [
            "method" => "BOTON",
            "methodoption" => "Guardar",
            "array" => [
                "txtPreg" => $preguntas[$preg],
                "txtResp" => "gruposadeco",
                "txtSub" => 'Guardar'
            ],
            "documento" => $doc,
            "scrapping" => true
        ];
        $doc = $this->sendBrowser($opcs);
        $this->setError(0, "Se estableció la pregunta secreta.");
        return $this->resp;
    }

    public function getVendedores(Canal $canal)
    {

        $this->getPasswd($canal);
        if (!$this->validaSesion()) return $this->resp;

        $opcs = [
            "method" => "GET",
            "url" => "/useradmin/index.jsp?session=&priv=A",
        ];
        $doc = $this->sendBrowser($opcs);

        $info = $this->readPage($doc, $canal); // Obtiene la información de la página.


        $this->setError(0, 'Se obtuvieron los vendedores', $info);
        return $this->resp;
        // return ; // Elimina los elementos nulos del array

    }

    public function resetAcox(Canal $canal)
    {
        $this->getPasswd($canal);

        $opcs = [
            "method" => "GET",
            "url" => "/intpsutils/index.jsp",
        ];
        $doc = $this->sendBrowser($opcs);

        $opcs = [
            "method" => "BOTON",
            "methodoption" => "Continuar",
            "array" => [
                "txtLogin" => $this->usuario,
                "txtTipo" => "acox",
                "txtAstAlta" => ''
            ],
            "documento" => $doc,
        ];
        $doc = $this->sendBrowser($opcs);

        $opcs = [
            "method" => "BOTON",
            "methodoption" => "Continuar",
            "array" => [
                "txtUsr" => $this->usuario,
                "txtTipo" => "acox",
                "txtResp" => 'gruposadeco'
            ],
            "documento" => $doc,
        ];
        $doc = $this->sendBrowser($opcs);

        try {
            $this->resp["data"]["anterior"] = $this->contrasena;
            $this->contrasena = $doc->filterXPath('//span[@class="clsPwd"]')->text(); // Cambió el pass.
            $this->resp["data"]["temporal"] = $this->contrasena;
            // $doc->filterXPath('//span[@class="clsResult"]')->text()

        } catch (\Exception $e) {
            $this->setError(99, 'Reset acox:' . $e->getMessage());
        }
        $this->login();
        return $this->resp;
    }

    public function resetRcox(Canal $canal, CanalVendedor $vendedor)
    {
        // Tiene que loguearse con el canal padre del vendedor.
        $this->getPasswd($canal);
        if (!$this->validaSesion()) return $this->resp;

        $opcs = [
            "method" => "GET",
            "url" => "/useradmin/index.jsp?session=" . $this->session . "&priv=A",
            "goutte" => "readpage"
        ];
        $doc = $this->sendBrowser($opcs);

        $info = $this->readPage($doc, $canal); // Obtiene la información de la página.
        $reseteo = -1;

        foreach ($info as $index => $row) {
            foreach ($row as $indexr => $value) {
                if ($value == $vendedor->logunico) $reseteo = $index;
            }
        }

        if ($reseteo >= 0) {

            $opcs = [
                "method" => "POST",
                "methodoption" => "name=idFrmVendedores",
                "url" => "/useradmin/faces/pages/AdminVendedores.xhtml",
                "array" => [
                    "partial.ajax" => true,
                    "faces.source" => "idTblVndrs:$reseteo:idResetPwdLnk",
                    "partial.execute" => "@all",
                    "partial.render" => "idConfResetPwd",
                    "idTblVndrs:$reseteo:idResetPwdLnk" => "idTblVndrs:$reseteo:idResetPwdLnk"
                ],
                "documento" => $doc,
                "goutte" => "resetrcox"
            ];
            $doc = $this->sendBrowser($opcs);

            $this->resp["data"]["anterior"] = $vendedor->contrasena;
            // Se carega el DOMDocument, porque es parcial.
            $dom = new DOMDocument();
            @$dom->loadHTML($doc->html());
            $xpath = new DOMXPath($dom);
            // Para cambiar el password, se necesita el usuario del vendedor y el password temporal.
            $this->usuario = $vendedor->logunico;
            $this->contrasena = $xpath->query('//span[@class="clsPwd"]')->item(0)->nodeValue;
            $this->resp["data"]["temporal"] = $this->contrasena;
            $this->login();
        }
        return $this->resp;
    }

    public function getActivaciones($tipo = 1, $fecha = "2024-01-01", $fecha2 = "2024-01-05")
    {
        /*
            $opcs =[
            "tipo"=>1, //tipofecha:  1. preactivo, 2. primera llamada, 3. activo, 4. rep venta
            "fecha"=> "01052023",
            "fecha2"=>"02052023",
            ];        
        */
        // dd($tipo,$fecha,$fecha2);
        $fecha = Date::createFromFormat('Y-m-d', $fecha)->format('dmY');
        $fecha2 = Date::createFromFormat('Y-m-d', $fecha2)->format('dmY');
        


        if (!$this->validaSesion()) return $this->resp;

        $opcs = [
            "method" => "GET",
            "url" => "/cgi-bin/contellot.pl?session=" . $this->session . "&priv=A",
            "goutte" => "activaciones"
        ];
        $doc = $this->sendBrowser($opcs);

        $opcs = [
            "method" => "BOTON",
            "methodoption" => "Consultar",
            "array" => [
                "inputDist" => $this->clave,
                "tipofecha" => $tipo,
                "fecha" => $fecha,
                "fecha2" => $fecha2
            ],
            "documento" => $doc,
            "goutte" => "activaciones"
        ];
		$doc = $this->sendBrowser($opcs);


        $registros = intval(preg_replace(array('/[^0-9]+/'), '', $doc->filterXpath('//center/font[contains(@face,"tahoma")]')->text()));

        try {
            $urlget = $doc->filterXpath('//a[contains(@href,".csv")]')->attr('href');
            $file = "activaciones_" . $fecha . "_al_" . $fecha2 . "_$this->usuario.csv";
        
            if ($urlget != '') {
                $contents = file_get_contents($this->url . $urlget);
                Storage::disk('local')->put($file, $contents);
            }
        
            $this->resp["data"] = ["Registros" => $registros, "file" => $file];
        } catch (Exception $e) {
            $this->resp["data"] = ["Registros" => 0];
        }
        
        return $this->resp;

		// $registros = intval(preg_replace(array('/[^0-9]+/'), '', $doc->filterXpath('//center/font[contains(@face,"tahoma")]')->text()));
		// try {
		// 	$urlget = $doc->filterXpath('//a[contains(@href,".csv")]')->attr('href');
		// 	$file = "temp/activaciones_" . $fecha . "_al_" . $fecha2 . "_$this->usuario.csv";
		// 	if ($urlget != '') fwrite(fopen($file, "w"), file_get_contents($this->url . $urlget));
		// 	$this->resp["data"] = ["Registros" => $registros, "file" => $file];
		// } catch (Exception $e) {
		// 	$this->resp["data"] = ["Registros" => 0];
		// }
		// return $this->resp;        

        // return $this->resp;
    }

    //  ############################################################################################################
    //  ################################################## CONFIGURACION #############################################
    //  ############################################################################################################

    private function validaSesion()
    {
        //$this->url = "https://www2.r8.telcel.com"; // Cuando se manda validasesion, la url de TAF contiene el www2, por lo que se cambia, ya hay loguin, se están pidiendo métodos.

        if (!$this->setCookie()) return false;

        $opcs = [
            "method" => "GET",
            "url" => "/intsegutils/?sol=2&priv=A",
            "scrapping" => 'validasesion'
        ];
        $doc = $this->sendBrowser($opcs);



        if (strstr($this->browser->getResponse()->getContent(), "Ha alcanzado su")) {
            if (!$this->login()) {
                $this->setError(1, "Cuenta bloqueada por intentos excedidos. Solicitar un reset a la cuenta: $this->usuario.");
                unlink($this->cookie);
                return false;
            }
        }  //else $this->handleErrors($doc);

        return true;
    }

    //  ############################################################################################################
    //  ################################################## UTILITARIAS #############################################
    //  ############################################################################################################

    private function passExpirado($doc) // Esta función renueva y loguea para crear la cookie.
    {
        $documento = $doc;

        // $this->resp["data"]["passanterior"]=$this->contrasena;
        while (!strstr($documento->html(), "El password se actualiz") && !strstr($documento->html(), "Password actualizado")) {
            $letras = strstr($this->usuario, "acox") ? "acox" : "rcox";
            $nuevopas = $letras . rand(pow(10, 5 - 1), pow(10, 5) - 1);
            $opcs = [
                "method" => "BOTON",
                "methodoption" => "Renovar Password",
                "array" => [
                    "nvopassword" => $nuevopas,
                    "nvopassword2" => $nuevopas,
                ],
                "documento" => $doc,
                "goutte" => "cambiopasswd"
            ];
            try {

                $documento = $this->sendBrowser($opcs);
            } catch (\Exception $e) {
                $this->setError(99, 'Pass expirado: ' . $e->getMessage());
            }
        }

        @unlink($this->cookie); // se elimina la cookie para que no guarde registros.
        $this->contrasena = $nuevopas;

        //$this->client = new Client();
        $this->browser = new HttpBrowser(HttpClient::create(['timeout' => 60, 'verify_host' => false, 'verify_peer' => false]));
        $this->resp["data"]["nuevopass"] = $this->contrasena;
        $this->setError(0, 'Se cambió la contraseña: ' . $this->contrasena);

        return $this->contrasena;
    }

    public function arrayClean($values)
    {
        // Falta con multidimencionales.
        $array = array_values(array_filter($values, function ($value) {
            return ($value !== NULL && $value !== FALSE && $value !== ''); /* deja los 0's */
        }));
        return $array;
    }

    private function readPage($doc, $canal)
    {
        $nodos = $doc->filterXpath('//table[@role="grid"][3]/tbody/tr[@role="row"]')->each(function ($tr, $idxTr) use ($canal) {
            $imgs = strpos($tr->filterXPath('//img[contains(@id,"idTblVndrs")]')->attr('alt'), "debe cambiar") === false ? 1 : 0;
            $datos =  $tr->filterXpath('//td[@role="gridcell" and not(contains(.,"PrimeFaces"))]')->each(function ($td, $idxTd) {
                return $td->text();
            });
            array_push($datos, $canal->clave, $imgs);
            return $datos;
        });

        $titulos = ["login", "loginnico", "nombre", "fechaalta", "contraseaalta", "resetearpassword", "canal", "estatus"];

        $arrayMake = array_map(function ($row) use ($titulos) {
            if (count($row) > count($titulos)) {
                $row = $this->arrayClean($row);
                return array_combine($titulos, $row);
            }
        }, $nodos);
        $this->setError(0, 'Se obtuvieron los vendedores', array_filter($arrayMake));
        return $arrayMake;
    }
}
