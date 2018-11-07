<?php

namespace Adtech\Core\App\Middleware;

use Closure;
use GuzzleHttp\Client;

class BearerVerify
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        $client = new Client([
            'headers'  => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json'
            ]]);

        $res = $client->request('GET', 'http://eid.vnedutech.vn/api/bearer');
        $data = json_decode($res->getBody(),true);
        if($data['success'] == true){
            return $next($request);
        } else {
            return response(json_encode($data), 403);
        }
    }
}
