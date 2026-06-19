<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MailService
{
    protected $client;
    protected $apiKey;
    protected $senderName;
    protected $senderEmail;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.brevo.com/v3/',
            'timeout'  => 10.0,
        ]);

        $this->apiKey       = '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';
        $this->senderName   = 'PROFXSPORTSCLUB';
        $this->senderEmail  = 'info@profxmedia.com';
    }
   
    /**
     * Send email via Brevo
     *
     * @param string $toEmail
     * @param string $subject
     * @param array $headers (ignored by Brevo)
     * @param string|null $templateFile
     * @param array $data
     * @return array
     */
    // public function sendEmail($toEmail, $subject, $headers = [], $templateFile = null, $data = [])
    // {
    //     $templateFile = $templateFile ?: 'emails.raw'; // default template
    //     $htmlContent = view($templateFile, $data)->render();

    //     $payload = [
    //         'sender' => [
    //             'name'  => $this->senderName,
    //             'email' => $this->senderEmail,
    //         ],
    //         'to' => [
    //             ['email' => $toEmail],
    //         ],
    //         'subject'     => $subject,
    //         'htmlContent' => $htmlContent,
    //     ];

    //     try {
    //         $response = $this->client->post('smtp/email', [
    //             'headers' => [
    //                 'api-key'      => $this->apiKey,
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'json' => $payload,
    //         ]);

    //         return json_decode($response->getBody(), true);
    //     } catch (\Exception $e) {
    //         Log::error('Brevo API Error: ' . $e->getMessage());
    //         return [
    //             'error'   => true,
    //             'message' => 'Failed to send email: ' . $e->getMessage(),
    //         ];
    //     }
    // }

        public function sendEmail($toEmail, $subject, $headers = [], $templateFile = null, $data = [])
    {
        $templateFile = $templateFile ?: 'emails.raw'; // default template
        $htmlContent = view($templateFile, $data)->render();

        $payload = [
            'sender' => [
                'name'  => $this->senderName,
                'email' => $this->senderEmail,
            ],
            'to' => [
                ['email' => $toEmail],
            ],
            'subject'     => $subject,
            'htmlContent' => $htmlContent,
        ];

        try {
            $response = $this->client->post('smtp/email', [
                'headers' => [
                    'api-key'      => $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Brevo API Error: ' . $e->getMessage());
            return [
                'error'   => true,
                'message' => 'Failed to send email: ' . $e->getMessage(),
            ];
        }
    }
}


// <?php

// namespace App\Services;

// use GuzzleHttp\Client;
// use Illuminate\Support\Facades\Log;

// class MailService
// {
//     protected $client;
//     protected $apiKey;
//     protected $apiSecret;
//     protected $senderName;
//     protected $senderEmail;

//     public function __construct()
//     {
//         $this->client = new Client([
//             'base_uri' => 'https://api.mailjet.com/v3.1/',
//             'timeout'  => 10.0,
//         ]);

//         // 🔹 Replace with your Mailjet API keys
//         $this->apiKey      = '9f759e1a17fe32931ae9fc663a442e77';
//         $this->apiSecret   = '100880e2736750f309421f1fffc71e06';
//         $this->senderName  = 'PROFXSPORTSCLUB';
//         $this->senderEmail = 'noreply@profxleague.com';
//     }

//     /**
//      * Send email via Mailjet
//      *
//      * @param string $toEmail
//      * @param string $subject
//      * @param array $headers
//      * @param string|null $templateFile
//      * @param array $data
//      * @return array
//      */
//     public function sendEmail($toEmail, $subject, $headers = [], $templateFile = null, $data = [])
//     {
//         $templateFile = $templateFile ?: 'emails.raw'; // fallback template
//         $htmlContent  = view($templateFile, $data)->render();

//         $payload = [
//             'Messages' => [
//                 [
//                     'From' => [
//                         'Email' => $this->senderEmail,
//                         'Name'  => $this->senderName,
//                     ],
//                     'To' => [
//                         ['Email' => $toEmail],
//                     ],
//                     'Subject' => $subject,
//                     'HTMLPart' => $htmlContent,
//                 ]
//             ]
//         ];

//         try {
//             $response = $this->client->post('send', [
//                 'auth' => [$this->apiKey, $this->apiSecret], // Mailjet uses Basic Auth
//                 'headers' => [
//                     'Content-Type' => 'application/json',
//                 ],
//                 'json' => $payload,
//             ]);

//             return json_decode($response->getBody(), true);
//         } catch (\Exception $e) {
//             Log::error('Mailjet API Error: ' . $e->getMessage());
//             return [
//                 'error'   => true,
//                 'message' => 'Failed to send email: ' . $e->getMessage(),
//             ];
//         }
//     }
// }






