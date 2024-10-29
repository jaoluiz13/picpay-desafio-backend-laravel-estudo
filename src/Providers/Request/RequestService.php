<?php

namespace Src\Providers\Request;

use Illuminate\Support\Facades\Http;
use Exception;

class RequestService
{
    public static function request(string $url, string  $endPoint, string $method, array $body)
    {
        try {
            switch ($method) {
                case 'GET':
                    $response = Http::get($url . $endPoint);
                    break;
                case 'POST':
                    $response = Http::post($url . $endPoint, $body);
                    break;
                case 'PUT':
                    $response = Http::put($url . $endPoint, $body);
                    break;
                case 'DELETE':
                    $response = Http::delete($url . $endPoint, $body);
                    break;
                default:
                    throw new Exception('Invalid method');
                    break;
            }

            return $response->json();
        } catch (\Exception $e) {
            return response()->json(['erro' => 'Falha ao se conectar ao serviço externo.'], 500);
        }
    }
}
