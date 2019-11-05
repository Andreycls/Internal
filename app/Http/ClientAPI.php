<?php

namespace App\Http;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ClientAPI
{
    protected $apiClient, $access_token;

    public function __construct($apiClient)
    {
        $this->apiClient = $apiClient->requestv1();
        $this->access_token();
    }

    public function auhtorization()
    {
        $client = new Client();
        $url = $this->apiClient['url'] . '/token';
        
        $response = $client->post($url, [
            'allow_redirects' => false,
            'headers'   => [
                'Content-Type'  => 'application/json',
                'x-bri-key'     => $this->apiClient['xbri']
            ],
            'json'  => [
                'grant_type'    => 'authorization_code',
                'client_id'     => $this->apiClient['app_id'],
                'client_secret' => $this->apiClient['app_secret'],
                'code'          => $this->apiClient['auhtorization']
            ],
            'verify'    => false,
            'version'   => 'v1.1',
            'timeout'   => 300
        ]);

        $body = $response->getBody();
        $content =$body->getContents();
        
        $arr = json_decode($content,TRUE);
        
        return $arr;
    }

    public function transaction($start, $end)
    {
        if(empty($start)) $start = date('Ymd', strtotime(Carbon::now()));
        
        if(empty($end)) $end   = date('Ymd', strtotime(Carbon::now()));
        
        $client = new Client();
        $url  = $this->apiClient['url'] . '/briva/report/';
        $url .= $this->apiClient['institution_code'] . '/' . $this->apiClient['briva_number'] . '/';
        $url .=$start . '/' .$end;
        
        try {
            $response = $client->get($url, [
                'allow_redirects' => false,
                'headers'   => [
                    'Content-Type'  => 'application/json',
                    'x-bri-key'     => $this->apiClient['xbri'],
                    'Authorization' => 'Bearer ' . $this->access_token
                ],
                'verify'    => false,
                'version'   => 'v1.1',
                'timeout'   => 300
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $content =$body->getContents();

        }catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $content = $e->getResponse()->getBody()->getContents();
        }

        $arr = [
            'statusCode'    => $statusCode,
            'response'      => json_decode($content,TRUE)
        ];
        
        return $arr;
    }

    public function create(array $data)
    {
        $client = new Client();
        $url = $this->apiClient['url'] . '/briva';
        
        try {
            $response = $client->post($url, [
                'allow_redirects' => false,
                'headers'   => [
                    'Content-Type'  => 'application/json',
                    'x-bri-key'     => $this->apiClient['xbri'],
                    'Authorization' => 'Bearer ' . $this->access_token
                ],
                'json'  => $data,
                'verify'    => false,
                'version'   => 'v1.1',
                'timeout'   => 300
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $content =$body->getContents();

        }catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $content = $e->getResponse()->getBody()->getContents();
        }

        $arr = [
            'statusCode'    => $statusCode,
            'response'      => json_decode($content,TRUE)
        ];
        
        return $arr;
    }

    public function update(array $data)
    {
        $client = new Client();
        $url = $this->apiClient['url'] . '/briva';
        
        try {
            $response = $client->put($url, [
                'allow_redirects' => false,
                'headers'   => [
                    'Content-Type'  => 'application/json',
                    'x-bri-key'     => $this->apiClient['xbri'],
                    'Authorization' => 'Bearer ' . $this->access_token
                ],
                'json'  => $data,
                'verify'    => false,
                'version'   => 'v1.1',
                'timeout'   => 300
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $content =$body->getContents();

        }catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $content = $e->getResponse()->getBody()->getContents();
        }

        $arr = [
            'statusCode'    => $statusCode,
            'response'      => json_decode($content,TRUE)
        ];
        
        return $arr;
    }

    public function get($corpCode, $custCode)
    {
        $client = new Client();
        $url = $this->apiClient['url'] . '/briva' . '/';
        $url .= $this->apiClient['institution_code'] . '/' . $corpCode . '/' .$custCode;
        
        try {
            $response = $client->get($url, [
                'allow_redirects' => false,
                'headers'   => [
                    'Content-Type'  => 'application/json',
                    'x-bri-key'     => $this->apiClient['xbri'],
                    'Authorization' => 'Bearer ' . $this->access_token
                ],
                'verify'    => false,
                'version'   => 'v1.1',
                'timeout'   => 300
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $content =$body->getContents();

        }catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $content = $e->getResponse()->getBody()->getContents();
        }

        $arr = [
            'statusCode'    => $statusCode,
            'response'      => json_decode($content,TRUE)
        ];
        
        return $arr;
    }

    public function delete($corpCode, $custCode)
    {
        $client = new Client();
        $url = $this->apiClient['url'] . '/briva';
        
        $parameter = "institutionCode=".$this->apiClient['institution_code']."&brivaNo=".$corpCode."&custCode=".$custCode;
        
        try {
            $response = $client->delete($url, [
                'allow_redirects' => false,
                'headers'   => [
                    'Content-Type'  => 'application/json',
                    'x-bri-key'     => $this->apiClient['xbri'],
                    'Authorization' => 'Bearer ' . $this->access_token
                ],
                'body'      => $parameter,
                'verify'    => false,
                'version'   => 'v1.1',
                'timeout'   => 300
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $content =$body->getContents();

        }catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();
            $content = $e->getResponse()->getBody()->getContents();
        }

        $arr = [
            'statusCode'    => $statusCode,
            'response'      => json_decode($content,TRUE)
        ];
        
        return $arr;
    }

    public function access_token()
    {
        $access_token  = $this->apiClient['access_token'];
        $token = explode('|', $access_token);

        $access= $token[0];  $tokenExpired = $token[1];

        if(Carbon::now() >= $tokenExpired || is_null($access))
        {
            $authorization = $this->auhtorization();
            $this->access_token = $authorization['data']['access_token'];
            
            $access_with_time_expired = $this->access_token.'|'.Carbon::now()->addHour();

            setting()->set($this->apiClient['store_authorization'], $access_with_time_expired);
            setting()->save();
        }else {

            $this->access_token = $access;
        }
    }
}