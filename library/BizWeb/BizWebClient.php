<?php
namespace BizWeb;
use Core\Logger;
use Exception;
use SeuDo\Common\RedisCache;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12/12/2015
 * Time: 9:59 AM
 */

class BizWebClient{
    const BIZWEB_APPKEY_SETTING = 'BIZWEB_APPKEY',
        BIZWEB_SECRET_SETTING = 'BIZWEB_SECRET';

    public $shop_domain;
    private $token;
    private $api_key;
    private $secret;
    private $last_response_headers = null;

    static $countCallRequest = 0;
    /**
     * Khởi tạo client
     * @param $shop_domain
     * @param $token
     * @param null $key
     * @param null $secret
     * @author kiennx
     */
    public function __construct($shop_domain, $token, $key = null, $secret=null) {
        $this->name = "BizWebClient";
        $this->shop_domain = $shop_domain;// teen shop dang ki tren website
        $this->token = $token; // chia khóa

        if (empty($key))
        {
            $key = \Setting::getSetting(BizWebClient::BIZWEB_APPKEY_SETTING);
        }
        if (empty($secret)) {
            $secret = \Setting::getSetting(BizWebClient::BIZWEB_SECRET_SETTING);
        }

        $this->api_key = $key;// key api để giao tiếp
        $this->secret = $secret; // có thể ko cần nữa
    }

    public function getAuthorizeUrl($scope, $redirect_url=''){
        $url = "https://{$this->shop_domain}.bizwebvietnam.net/admin/oauth/authorize?client_id={$this->api_key}&scope=" . urlencode($scope);
        if ($redirect_url != '')
        {
            $url .= "&redirect_uri=" . urlencode($redirect_url);
        }
        $url .= "&response_type=code";
        return $url;
    }

    public function getAccessToken($code, $redirect_url=''){
        $url = "https://{$this->shop_domain}.bizwebvietnam.net/admin/oauth/access_token";
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

    /**
     * @param $token
     */
    public function setAccessToken($token){
        $this->token = $token;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function callsMade()
    {
        return $this->shopApiCallLimitParam(0);
    }

    /**
     * @return int
     * @throws Exception
     */
    public function callLimit()
    {
        return $this->shopApiCallLimitParam(1);
    }

    /**
     * @param $response_headers
     * @return int
     */
    public function callsLeft($response_headers)
    {
        return $this->callLimit() - $this->callsMade();
    }

    /**
     * nếu hàm này được gọi quá 100 lần trong 1 thời gian thì sẽ mặc định là bỏ qua và giá trị
     * trong đó bằn false , nếu chưa đến 100 thì giá trị được gán bằng false , nhưng giá trị chỉ tồn tại trong 1p
     * @param $method
     * @param $path
     * @param array $params
     * @return array|mixed
     * @throws BizWebClientException
     * @throws BizWebException
     */
    public function call($method, $path, $params=array())
    {
       self::$countCallRequest ++; // mỗi lần gọi đến thì tăng một giá trị cho biến

        $baseurl = "https://{$this->shop_domain}/";
        $url = $baseurl.ltrim($path, '/');
        $query = in_array($method, array('GET','DELETE')) ? $params : array();
        $payload = in_array($method, array('POST','PUT')) ? json_encode($params) : array();
        $request_headers = in_array($method, array('POST','PUT')) ? array("Content-Type: application/json; charset=utf-8", 'Expect:') : array();
        $request_headers[] = 'X-Bizweb-Access-Token: ' . $this->token;

        $rawResponse = $this->curlHttpApiRequest($method, $url, $query, $payload, $request_headers);

        $response = json_decode($rawResponse, true);

        $logger = Logger::factory('bizweb');
        $logger->addDebug('Call Bizweb API', ['params' => $params, 'response' => $rawResponse]);

        return (is_array($response) and (count($response) > 0)) ? array_shift($response) : $response;
    }

    /**
      * @param $method
     * @param $url
     * @param string $query
     * @param string $payload
     * @param array $request_headers
     * @return mixed
     * @throws BizWebException
     */
    private function curlHttpApiRequest($method, $url, $query='', $payload='', $request_headers=array())
    {
        $url = $this->curlAppendQuery($url, $query);
        $ch = curl_init($url);
        $this->curlSetopts($ch, $method, $payload, $request_headers);
        $response = curl_exec($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($errno) throw new BizWebException($error, $errno);
        list($message_headers, $message_body) = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);
        $this->last_response_headers = $this->curlParseHeaders($message_headers);

        return $message_body;
    }

    private function curlSetopts($ch, $method, $payload, $request_headers)
    {
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'ide-bizweb-client');
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
    /**
     * @param $url
     * @param $query
     * @return string
     */
    private function curlAppendQuery($url, $query)
    {
        if (empty($query)) return $url;
        if (is_array($query)) return "$url?".http_build_query($query);
        else return "$url?$query";
    }

    /**
     * @param $message_headers
     * @return array
     */
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

    #region -- Support controller quy trình cài app --
    #endregion
}

class BizWebException extends Exception { }

class BizWebClientException extends Exception{

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