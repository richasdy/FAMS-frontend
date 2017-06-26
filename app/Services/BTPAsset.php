<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class BTPAsset
{
    protected $url;
    protected $appKey;
    protected $client;
    /**
     * Sikd constructor.
     */
    public function __construct(Client $client)
    {
        //$this->url = config('services.tw.base_url');
        $this->url = 'http://128.199.115.183:8002/api/';
        $this->appKey = config('services.tw.app_key');
        $this->clientId = config('services.tw.client_id');
        $this->clientSecret = config('services.tw.client_secret');
        $this->client = $client;
    }

    public function getAccessToken($username, $password)
    {
        $params = [
          'username' => $username,
          'password' => $password
        ];
        $tokenResult = $this->post('oauth2/token', $params);
        return $tokenResult;
    }

    private function generateApiUrl($url)
    {
        return $this->url . $url;
    }

    private function proceedException($e, $apiUrl)
    {
        $message = 'Unknown Error';
        $code = '000';
        if ($e instanceof TransferException) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $message = $response->getReasonPhrase();
                $code = $response->getStatusCode();
            }
        }
        Log::alert('ERROR API ==> ' . $message . ' at ' . $apiUrl);
        return new SimpleAPIResponse($code, $message . ' at ' . $apiUrl . '.');
    }

    private function parseResponse($response)
    {
        $body = $response->getBody();
        $code = $response->getStatusCode(); // 200
        $reason = $response->getReasonPhrase(); // OK
        if ($code == 200 && $reason == 'OK') {
            $result = \GuzzleHttp\json_decode($body);
            return new SimpleAPIResponse($code, $result);
        } elseif ($code == 401) {
            \Auth::logout();
            session()->flush();
            return new SimpleAPIResponse(401, 'Unauthorized');
        } else {
            return new SimpleAPIResponse(400, 'Bad API Result.');
        }
    }

    public function post($url, $params = []){
      $apiUrl = $this->generateApiUrl($url);
      $accessToken = session('api_token');
      $headers = [
          'headers' => [
              'Authorization' => 'Bearer ' . $accessToken
          ],
          'form_params'=> $params
      ];
      try {
          $response = $this->client->request('POST', $apiUrl, $headers);
          $parsedResponse = $this->parseResponse($response);
      } catch (\Exception $e) {
          $parsedResponse = $this->proceedException($e, $apiUrl);
      }
      return $parsedResponse;
    }

    public function get($url, $params = []){
      $apiUrl = $this->generateApiUrl($url);
      //$apiUrl = "http://192.168.1.8:8871/api-tourismwave/api/ref/city";
      if($params){
        $apiUrl = $apiUrl.'?'.http_build_query($params);
      }
      Log::alert('API URL ==> ' . $apiUrl);
      $accessToken = session('api_token');
      $headers = [
          'headers' => [
              'Authorization' => 'Bearer ' . $accessToken
          ],
      ];
      try {
          $request = new Request('GET', $apiUrl, $headers);
          $response = $this->client->send($request);
          $parsedResponse = $this->parseResponse($response);
      } catch (\Exception $e) {
          $parsedResponse = $this->proceedException($e, $apiUrl);
      }
      return $parsedResponse;
    }
}