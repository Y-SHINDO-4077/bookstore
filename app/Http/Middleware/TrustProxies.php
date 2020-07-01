<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string
     */
    //protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    //protected $headers = Request::HEADER_X_FORWARDED_ALL;
    
    /**
     * このアプリケーションで信用するプロキシ
     *
     * @var array
     */
    //protected $proxies = [
    //    '192.168.1.1',
    //    '192.168.1.2',
    //];
    protected $proxies = '**'; //常時httpsへ 2020.05.23
    

    /**
     * 現在のプロキシヘッダのマップ
     *
     * @var array
     */
     const HEADER_FORWARDED = 0b00001; // When using RFC 7239
const HEADER_X_FORWARDED_FOR = 0b00010;
const HEADER_X_FORWARDED_HOST = 0b00100;
const HEADER_X_FORWARDED_PROTO = 0b01000;
const HEADER_X_FORWARDED_PORT = 0b10000;
const HEADER_X_FORWARDED_ALL = 0b11110; // All "X-Forwarded-*" headers
const HEADER_X_FORWARDED_AWS_ELB = 0b11010; // AWS ELB doesn't send X-Forwarded-Host
//     protected $headers = [
        

// Request::HEADER_FORWARDED => 'FORWARDED',
//         Request::HEADER_X_FORWARDED_FOR => 'X_FORWARDED_FOR',
//         Request::HEADER_X_FORWARDED_HOST => 'X_FORWARDED_HOST',
//         Request::HEADER_X_FORWARDED_PORT => 'X_FORWARDED_PORT',
//         Request::HEADER_X_FORWARDED_PROTO => 'X_FORWARDED_PROTO',
//     ];
    
   
}
