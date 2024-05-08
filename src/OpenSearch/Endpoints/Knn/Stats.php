<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Knn;

use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class Stats
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class Stats extends AbstractEndpoint
{
    protected $node_id;
    protected $stat;

    public function getURI(): string
    {
        $node_id = $this->node_id ?? null;
        $stat = $this->stat ?? null;

        if (isset($node_id) && isset($stat)) {
            return "/_plugins/_knn/$node_id/stats/$stat";
        }
        if (isset($node_id)) {
            return "/_plugins/_knn/$node_id/stats";
        }
        if (isset($stat)) {
            return "/_plugins/_knn/stats/$stat";
        }
        return "/_plugins/_knn/stats";
    }

    public function getParamWhitelist(): array
    {
        return [
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

    public function setNodeId($node_id): Stats
    {
        if (isset($node_id) !== true) {
            return $this;
        }
        $this->node_id = $node_id;

        return $this;
    }

    public function setStat($stat): Stats
    {
        if (isset($stat) !== true) {
            return $this;
        }
        $this->stat = $stat;

        return $this;
    }
}