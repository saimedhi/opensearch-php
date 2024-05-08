<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Cluster;

use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class DeleteDecommissionAwareness
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class DeleteDecommissionAwareness extends AbstractEndpoint
{

    public function getURI(): string
    {

        return "/_cluster/decommission/awareness";
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
}
