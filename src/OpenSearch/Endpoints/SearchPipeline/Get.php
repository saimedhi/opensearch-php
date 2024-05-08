<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\SearchPipeline;

use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class Get
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class Get extends AbstractEndpoint
{

    public function getURI(): string
    {
        $id = $this->id ?? null;

        if (isset($id)) {
            return "/_search/pipeline/$id";
        }
        return "/_search/pipeline";
    }

    public function getParamWhitelist(): array
    {
        return [
            'cluster_manager_timeout',
            'pretty',
            'human',
            'error_trace',
            'source',
            'filter_path'
        ];
    }

    public function getMethod(): string
    {
        return 'GET';
    }
}