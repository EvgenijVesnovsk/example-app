<?php

namespace App\Services;

use App\Exceptions\OneCServiceException;
use Symfony\Component\HttpFoundation\Response;

class OneCService
{
    /**
     * @throws OneCServiceException
     */
    public function addCommentToEdition(string $comment): bool
    {
        $code = 'ДобавлениеКомментарияТираж';
        $container = '<?xml version="1.0"?><Параметры Комментарий="' . $comment . '">';

        $result = $this->sendRequest($code, $container);

        if ($result->return->Code === '000') {
            throw new OneCServiceException($result->return->Message, Response::HTTP_NOT_IMPLEMENTED);
        }

        return $result->return->Code === '001';
    }

    /**
     * @throws OneCServiceException
     */
    public function sendRequest(string $code, string $requestContainer, string $rdc = "eksmo")
    {
        $params = [
            'Code' => $code,
            'Container' => $requestContainer
        ];

        try {
            $soapClient = new SoapClient(config('webservices.' . $rdc), [
                'cache_wsdl' => WSDL_CACHE_NONE,
                'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP
            ]);

            $response = $soapClient->UniOperation($params);
        } catch (\Exception $e) {
            throw new OneCServiceException($e->getMessage(), Response::HTTP_NOT_IMPLEMENTED);
        }

        return $response;
    }
}
