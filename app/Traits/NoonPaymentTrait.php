<?php

namespace App\Traits;

use GuzzleHttp\Client;
trait NoonPaymentTrait
{
   

    public function initiate($reference, $amount, $name,$return_url)
    {
        $payment_api = 'https://api-test.noonpayments.com/payment/v1/order';
        $payment_client = new Client();
        $payment_body = json_encode([
            'apiOperation' => 'INITIATE',

            'order' => [
                'reference' => $reference,
                'amount' => number_format($amount, 2),
                'currency' =>'SAR',
                'name' => substr($name, 0, 50),
                'channel' => 'web',
                'category' => 'pay'
            ],

            'configuration' => [
                'tokenizeCc' => true,
                'returnUrl' => $return_url,
                'locale' => 'en'
            ]
        ]);
        $payment_parameter = [
            'headers' =>
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Key_'.'Test'.' '.'Y2hvaWNlcy5kZW1vX2FwcDo3MTliOTAwOWJmMzQ0MzFmOTA5Y2YzYzk3Y2JiNTczNw=='
                ],
            'body' => $payment_body,
        ];

        $payment_request = $payment_client->request('POST', $payment_api, $payment_parameter);
        return json_decode($payment_request->getBody()->getContents(), true);

    }

    public function getOrder($order_id){
        $payment_api = 'https://api-test.noonpayments.com/payment/v1/order/'.$order_id;
        $payment_client = new Client();
        $payment_parameter = [
            'headers' =>
                [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Key_'.'Test'.' '.'Y2hvaWNlcy5kZW1vX2FwcDo3MTliOTAwOWJmMzQ0MzFmOTA5Y2YzYzk3Y2JiNTczNw=='
                ],
            'body' => json_encode([]),
        ];

        $payment_request = $payment_client->request('GET', $payment_api, $payment_parameter);
        return json_decode($payment_request->getBody()->getContents(), true);

    }


}