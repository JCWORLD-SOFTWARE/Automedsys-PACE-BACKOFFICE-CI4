<?php

namespace App\Libraries;

use CodeIgniter\HTTP\IncomingRequest;
use Config\Services;

class ApiResourceFilter
{
    private array $requestMap;
    private IncomingRequest $request;

    public function __construct(array $requestMap)
    {
        $this->requestMap = $requestMap;
        $this->request = Services::request();
    }

    public function getParams(): array
    {
        $params = [];

        foreach ($this->requestMap as $apiParamKey => $requestParamKey) {
            $params[$apiParamKey] = $this->request->getVar($requestParamKey);
        }

        return $params;
    }

    public function isFiltered(): bool
    {
        return strlen(implode("", array_values($this->getParams()))) > 0;
    }
}
