<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints;

use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeletePit
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class DeletePit extends AbstractEndpoint
{

    public function getURI(): string
    {

        return "/_search/point_in_time";
    }

    public function getParamWhitelist(): array
    {
        return [
            'pretty',
            'human',
            'error_trace',
            'source',
            'filter_path'
        ];
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function setBody($body): DeletePit
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }
}