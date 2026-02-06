<?php 
namespace App\Services;

use Google\Client;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;

class GmailService
{
    public function send($to, $subject, $html)
    {
        $client = new Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->refreshToken(config('services.google.refresh_token'));

        $gmail = new Gmail($client);

        $rawMessage = "From: ".config('mail.from.address')."\r\n";
        $rawMessage .= "To: $to\r\n";
        $rawMessage .= "Subject: $subject\r\n";
        $rawMessage .= "Content-Type: text/html; charset=utf-8\r\n\r\n";
        $rawMessage .= $html;

        $encoded = base64_encode($rawMessage);
        $encoded = str_replace(['+', '/', '='], ['-', '_', ''], $encoded);

        $message = new Message();
        $message->setRaw($encoded);

        return $gmail->users_messages->send('me', $message);
    }
}

?>