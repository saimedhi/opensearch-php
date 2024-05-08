<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Cat;

use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class SegmentReplication
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class SegmentReplication extends AbstractEndpoint
{

    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/_cat/segment_replication/$index";
        }
        return "/_cat/segment_replication";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'h',
            'help',
            's',
            'v',
            'allow_no_indices',
            'expand_wildcards',
            'ignore_throttled',
            'ignore_unavailable',
            'active_only',
            'completed_only',
            'bytes',
            'detailed',
            'shards',
            'index',
            'time',
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
}