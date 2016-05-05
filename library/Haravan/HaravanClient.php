<?php
namespace Haravan;

use Core\Logger;
use Flywheel\Exception;

class HaravanClient {
    const HARAVAN_APPKEY_SETTING = 'HARAVAN_APPKEY',
        HARAVAN_SECRET_SETTING = 'HARAVAN_SECRET';

	public $shop_domain;
	private $token;
	private $api_key;
	private $secret;
	private $last_response_headers = null;
    static $countCallRequest = 0;

	public function __construct($shop_domain, $token, $api_key = null, $secret = null) {

        $this->name = "HaravanClient";
        $this->shop_domain = $shop_domain;// teen shop dang ki tren website
        $this->token = $token; // chia khóa

        if (empty($api_key))
        {
            $api_key = \Setting::getSetting(HaravanClient::HARAVAN_APPKEY_SETTING);
        }
        if (empty($secret)) {
            $secret = \Setting::getSetting(HaravanClient::HARAVAN_SECRET_SETTING);
        }

        $this->api_key = $api_key;
        $this->secret = $secret;
	}

	// Get the URL required to request authorization
	public function getAuthorizeUrl($scope, $redirect_url='') {
		$url = "https://{$this->shop_domain}/admin/oauth/authorize?client_id={$this->api_key}&scope=" . urlencode($scope);
		if ($redirect_url != '')
		{
			$url .= "&redirect_uri=" . urlencode($redirect_url);
		}
        $url .= "&response_type=code";
		return $url;
	}
	
	// Once the User has authorized the app, call this with the code to get the access token
    // Once the User has authorized the app, call this with the code to get the access token
    public function getAccessToken($code, $redirect_url='') {
        // POST to https://SHOP_NAME.myharavan.com/admin/oauth/access_token
        $url = "https://{$this->shop_domain}/admin/oauth/access_token";
        $payload = "client_id={$this->api_key}&client_secret={$this->secret}&code=$code";
        if ($redirect_url != '')
        {
            $payload .= "&redirect_uri=" . urlencode($redirect_url);
        }
        $payload .= '&grant_type=authorization_code';

        $response = $this->curlHttpApiRequest('POST', $url, '', $payload, array());
        $response = json_decode($response, true);
        if (isset($response['access_token'])) return $response['access_token'];
        return '';
    }

	public function setAccessToken($token)
	{
		$this->token = $token;
	}
	
	public function callsMade()
	{
		return $this->shopApiCallLimitParam(0);
	}

	public function callLimit()
	{
		return $this->shopApiCallLimitParam(1);
	}

	public function callsLeft($response_headers)
	{
		return $this->callLimit() - $this->callsMade();
	}

    /**
     * phương thức call
     * @param $method
     * @param $path
     * @param array $params
     * @return array|mixed
     * @throws HaravanApiException
     * @throws HaravanCurlException
     */
	public function call($method, $path, $params=array())
	{
        self::$countCallRequest ++;
		$baseurl = "https://{$this->shop_domain}/";

        #$baseurl = "https://itemd-shop.myharavan.com/";
	
		$url = $baseurl.ltrim($path, '/');
		$query = in_array($method, array('GET','DELETE')) ? $params : array();
		$payload = in_array($method, array('POST','PUT')) ? json_encode($params) : array();
		$request_headers = in_array($method, array('POST','PUT')) ? array("Content-Type: application/json; charset=utf-8", 'Expect:') : array();

		// add auth headers
		$request_headers[] = 'Authorization: Bearer ' . $this->token;

		$rawResponse = $this->curlHttpApiRequest($method, $url, $query, $payload, $request_headers);
		$response = json_decode($rawResponse, true);

        $logger = Logger::factory('haravan');
        $logger->addDebug('Call Haravan API', ['params' => $params, 'response' => $rawResponse]);

		if (isset($response['errors']) or ($this->last_response_headers['http_status_code'] >= 400))
			throw new HaravanApiException($method, $path, $params, $this->last_response_headers, $response);

		return (is_array($response) and (count($response) > 0)) ? array_shift($response) : $response;
	}

	public function validateSignature($query)
	{
		if(!is_array($query) || empty($query['signature']) || !is_string($query['signature']))
			return false;
            
        $calculated_signature = "";
        if($query['code']) $calculated_signature .= 'code=' . $query['code'];
        $calculated_signature .= 'shop=' . $query['shop'] . 'timestamp=' . $query['timestamp'];
        $signature = bin2hex(hash_hmac('sha256', $calculated_signature, $this->secret, true));

		return $query['signature'] == $signature;
	}

	private function curlHttpApiRequest($method, $url, $query='', $payload='', $request_headers=array())
	{
		$url = $this->curlAppendQuery($url, $query);
		$ch = curl_init($url);
		$this->curlSetopts($ch, $method, $payload, $request_headers);
		$response = curl_exec($ch);
		$errno = curl_errno($ch);
		$error = curl_error($ch);
		curl_close($ch);

		if ($errno) throw new HaravanCurlException($error, $errno);
		list($message_headers, $message_body) = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);
		$this->last_response_headers = $this->curlParseHeaders($message_headers);

		return $message_body;
	}

	private function curlAppendQuery($url, $query)
	{
		if (empty($query)) return $url;
		if (is_array($query)) return "$url?".http_build_query($query);
		else return "$url?$query";
	}

	private function curlSetopts($ch, $method, $payload, $request_headers)
	{
        #curl_setopt($ch, CURLOPT_PROXY, "127.0.0.1:8888");

		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_USERAGENT, 'ohHaravan-php-api-client');
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, $method);
		if (!empty($request_headers)) curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		
		if ($method != 'GET' && !empty($payload))
		{
			if (is_array($payload)) $payload = http_build_query($payload);
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $payload);
		}
	}

	private function curlParseHeaders($message_headers)
	{
		$header_lines = preg_split("/\r\n|\n|\r/", $message_headers);
		$headers = array();
		list(, $headers['http_status_code'], $headers['http_status_message']) = explode(' ', trim(array_shift($header_lines)), 3);
		foreach ($header_lines as $header_line)
		{
			list($name, $value) = explode(':', $header_line, 2);
			$name = strtolower($name);
			$headers[$name] = trim($value);
		}

		return $headers;
	}
	
	private function shopApiCallLimitParam($index)
	{
		if ($this->last_response_headers == null)
		{
			throw new Exception('Cannot be called before an API call.');
		}
		$params = explode('/', $this->last_response_headers['http_x_haravan_shop_api_call_limit']);
		return (int) $params[$index];
	}	
}

class HaravanCurlException extends Exception { }

class HaravanApiException extends Exception
{
	protected $method;
	protected $path;
	protected $params;
	protected $response_headers;
	protected $response;
	
	function __construct($method, $path, $params, $response_headers, $response)
	{
		$this->method = $method;
		$this->path = $path;
		$this->params = $params;
		$this->response_headers = $response_headers;
		$this->response = $response;

        if (is_array($response) && array_key_exists('errors', $response)) {
            $message = $response['errors'];
        }
        else {
            $message = $response_headers['http_status_message'];
        }
		
		parent::__construct($message, $response_headers['http_status_code']);
	}

	function getMethod() { return $this->method; }
	function getPath() { return $this->path; }
	function getParams() { return $this->params; }
	function getResponseHeaders() { return $this->response_headers; }
	function getResponse() { return $this->response; }
}
?>
