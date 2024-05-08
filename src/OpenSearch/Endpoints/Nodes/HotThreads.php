<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Nodes;

use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class HotThreads
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class HotThreads extends AbstractEndpoint
{
    protected $node_id;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;

        if (isset($node_id)) {
            return "/_cluster/nodes/$node_id/hot_threads";
        }
        return "/_nodes/hotthreads";
    }

    public function getParamWhitelist(): array
    {
        return [
            'interval',
            'snapshots',
            'threads',
            'ignore_idle_threads',
            'type',
            'timeout',
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

    public function setNodeId($node_id): HotThreads
    {
        if (isset($node_id) !== true) {
            return $this;
        }
        $this->node_id = $node_id;

        return $this;
    }
}
