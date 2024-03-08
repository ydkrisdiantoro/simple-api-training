<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class sendWaNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct($message = 'test')
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $client = new Client();

        try {
            $response = $client->post('https://api.fonnte.com/send', [
                'headers' => [
                    'Authorization' => 'A_4USZB1uBeUY-vqch9m', // Change TOKEN to your actual token
                ],
                'form_params' => [
                    'target' => '62895411186213',
                    'message' => $this->message,
                    'countryCode' => '62', // optional
                ],
            ]);

            // return $response->getBody();
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // 
        }
    }
}
