<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Cat;

use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class NodeAttrs
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class NodeAttrs extends AbstractEndpoint
{

    public function getURI(): string
    {

        return "/_cat/nodeattrs";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'local',
            'master_timeout',
            'cluster_manager_timeout',
            'h',
            'help',
            's',
            'v',
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
