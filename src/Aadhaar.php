<?php

namespace Qafeen\Aadhaar;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Aadhaar
{
    const DEMOGRAPHIC_URL = 'http://139.59.30.133:9090/auth/raw/';

    const OTP_URL = 'http://139.59.30.133:9090/otp/';

    protected $client;

    protected $config;

    protected $request;

    public function __construct(Client $client, Request $request)
    {
        $this->client = $client;

        $this->request = $request;

        $this->config = config('aadhaar') ?: require __DIR__.'/../config.php';
    }

    public function isValid()
    {
        $options = [
            'aadhaar-id' => $this->request['aadhaarId'],
            'location'   => [
                'type'    => 'pincode',
                'pincode' => $this->request['pincode'],
            ],
            'modality'         => $this->config['modality'],
            'certificate-type' => $this->config['certificate-type'],
            'demographics'     => [
                'name' => [
                    'matching-strategy' => 'partial',
                    'name-value'        => $this->request['name'],
                    'matching-value'    => 20,
                ],
            ],
        ];

        return $this->send(static::DEMOGRAPHIC_URL, $options);
    }

    public function generateOtp()
    {
        $options = [
            'aadhaar-id'       => $this->request['aadhaarId'],
            'device-id'        => '',
            'certificate-type' => $this->config['certificate-type'],
            'channel'          => 'SMS',
            'location'         => [
                'type'      => '',
                'latitude'  => '',
                'longitude' => '',
                'altitude'  => '',
                'pincode'   => '',
            ],
        ];

        return $this->send(static::OTP_URL, $options);
    }

    public function verifyOtp()
    {
        $options = [
            'aadhaar-id'       => $this->request['aadhaarId'],
            'modality'         => $this->config['modality'],
            'otp'              => $this->request['otp'],
            'certificate-type' => $this->config['certificate-type'],
            'device-id'        => '',
            'location'         => [
                'type'    => 'pincode',
                'pincode' => $this->getUser($this->request['aadhaarId'])->pincode,
            ],
        ];

        return $this->send(static::DEMOGRAPHIC_URL, $options);
    }

    protected function send($url, array $options)
    {
        $response = json_decode($this->client
            ->request('POST', $url, [
                'json' => $options,
            ])
            ->getBody()
            ->getContents(), true);

        return $response['success'] ? $response['aadhaar-reference-code'] : false;
    }

    public function getUser($aadhaarId)
    {
        return User::select('pincode')->whereAadhaarId($aadhaarId)->first();
    }
}
