<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mailing;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class ChatApp extends Controller
{
    private string $baseUrl = 'https://api.chatapp.online/v1/';
    private int $appID = 42712;

    function __construct()
    {
        $this->middleware('auth')->except('handleCallback');
    }

    /**
     * @param Request $request
     * @throws GuzzleException
     */
    public function handleCallback(Request $request): void
    {
        $response = $request->all();

        $type = $response['meta']['type'] ?? null;

        if ($type === 'messageStatus') {
            Mailing::byChatappId($response['data'][0]['id'])->update(['status' => $response['data'][0]['type']]);
        }
    }

    /**
     * Отправка сообщения в WhatsApp
     *
     * @param string $number - телефонный номер в формате 79991234567
     * @param string $message - текст сообщения
     * @param string|null $accessToken - токен для авторизации
     * @return mixed
     * @throws GuzzleException
     */
    public function sendMessage(string $number, string $message, string $accessToken = null): mixed
    {
        $data = ['text' => $message, 'firstName' => 'Test', 'lastName' => 'xnf4o', 'tracking' => 'test',];
        return $this->post("licenses/$this->appID/messengers/grWhatsApp/chats/$number/messages/text", $data, $accessToken);
    }

    /**
     * Враппер для POST запросов
     *
     * @param string $endpoint - uri
     * @param array $data - данные для отправки
     * @param string|null $accessToken - токен для авторизации
     * @return mixed
     * @throws GuzzleException
     */
    private function post(string $endpoint, array $data = [], string $accessToken = null): mixed
    {
        $client = new Client(['base_uri' => $this->baseUrl]);
        try {
            $response = $client->request('POST', $endpoint, ['headers' => ['Content-Type' => 'application/json', 'Authorization' => $accessToken], 'json' => $data]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }
        return json_decode($response->getBody()->getContents());
    }

    /**
     * Создание токена для авторизации
     *
     * @param string $email - email пользователя
     * @param string $password - пароль пользователя
     * @return mixed
     * @throws GuzzleException
     */
    public function makeToken(string $email, string $password): mixed
    {
        $data = ['email' => $email, 'password' => $password, 'appId' => env('CHATAPP_APPID'),];
        return $this->post('tokens', $data);
    }

    /**
     * Обновление токена для авторизации
     *
     * @param string $refreshToken - токен для обновления
     * @return mixed
     * @throws GuzzleException
     */
    public function refreshToken(string $refreshToken): mixed
    {
        $data = ['refreshToken' => $refreshToken,];
        return $this->post('tokens/refresh', $data);
    }

    /**
     * Проверка токена для авторизации
     *
     * @param string $accessToken - токен для проверки
     * @return mixed
     * @unused
     * @throws GuzzleException
     */
    public function checkToken(string $accessToken): mixed
    {
        return $this->get('tokens/check', $accessToken);
    }

    /**
     * Враппер для GET запросов
     *
     * @param string $endpoint - uri
     * @param string|null $accessToken - токен для авторизации
     * @return mixed
     * @throws GuzzleException
     */
    private function get(string $endpoint, string $accessToken = null): mixed
    {
        $client = new Client(['base_uri' => $this->baseUrl]);
        $response = $client->request('GET', $endpoint, ['headers' => ['Content-Type' => 'application/json', 'Authorization' => $accessToken]]);
        return json_decode($response->getBody()->getContents());
    }

}
