<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints;

use OpenSearch\Common\Exceptions\RuntimeException;
use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class CreatePit
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class CreatePit extends AbstractEndpoint
{

    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index/_search/point_in_time";
        }
        throw new RuntimeException('Missing parameter for the endpoint create_pit');
    }

    public function getParamWhitelist(): array
    {
        return [
            'allow_partial_pit_creation',
            'keep_alive',
            'preference',
            'routing',
            'expand_wildcards',
            'pretty',
            'human',
            'error_trace',
            'source',
            'filter_path'
        ];
    }

    public function getMethod(): string
    {
        return 'POST';
    }
}
