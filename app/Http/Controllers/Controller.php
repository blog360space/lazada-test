<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\HttpStatusCode;

/**
 * Class ApiController
 *
 * @package App\Http\Controllers
 *
 * @SWG\Swagger(
 *     basePath="/research/laravel5/laztest/public",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="0.8.24",
 *         title="Lazada test API",
 *         @SWG\Contact(name="HungTran", email="mhungou04@gmail.com"),
 *     )
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    
     /**
     * @param boolean $result
     * @param string|array $data
     * @param int $statusCode
     * @return \Phalcon\HTTP\ResponseInterface
     */
    protected function response(
        $data,
        $status = HttpStatusCode::OK
    )
    {
        // success
        if ($status == HttpStatusCode::OK) {
            $dataResponse = [
               
                'data' => $data
            ];
        }
        //false
        else {
            $dataResponse = [
              
                'message' => $data
            ];
        }
        
        $status = $status == 0 ? HttpStatusCode::SERVICE_UNAVAILABLE : $status;
        
        return response($dataResponse, $status, ['Content-Type' => 'application/json',
            'charset' => 'utf-8']);
    }
}
