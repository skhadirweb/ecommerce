<?php


namespace App\Classes;


use Mailjet\Client;
use Mailjet\Resources;

class Mail
{
    private $api_key = "9cf93c828ba918234be55aa5b755f539";
    private $api_secret_key = "b9a0ef2d8628ca57029dbb0566689b54";

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_secret_key,true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "skhadirweb@gmail.com",
                        'Name' => "Ecommerce"
                    ],
                    'To' => [
                        [
                            'Email' => "$to_email",
                            'Name' => "$to_name"
                        ]
                    ],
                    'TemplateID' => 2283849,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content,
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}
