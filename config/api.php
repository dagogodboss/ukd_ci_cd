<?php
$paystack = [
    'baseUrl' => 'https://api.paystack.co/',
    'privateKey'=>'sk_test_31737395cbfd2350eca352e1e7aa67d6baf8bb7a'
];
return [
    // API token name 
    'name' => 'LOAN_MANAGER',
    'paystack' => [
        'bank_url'=> $paystack['baseUrl'].'bank',
        'verifyTransaction' => $paystack['baseUrl'].'transaction/verify/',
        'bin_url' => $paystack['baseUrl'].'decision/bin/',
        'account_number' => config('api.paystack.bank_url').'resolve',
        'bvn_url' => config('api.paystack.bank_url').'resolve_bvn/',
        'header' => [
            'auth' => 'Authorization'.'=>'. 'Bearer'.$paystack['privateKey'],
        ],
        'public_key' => 'pk_test_f202379ab28560c102ba8239ff8c8663264427c0',
        'secret_key' => 'sk_test_31737395cbfd2350eca352e1e7aa67d6baf8bb7a',
    ]
];