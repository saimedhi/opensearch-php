<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Indices;

use OpenSearch\Common\Exceptions\RuntimeException;
use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class Exists
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class Exists extends AbstractEndpoint
{

    public function getURI(): string
    {
        $index = $this->index ?? null;

        if (isset($index)) {
            return "/$index";
        }
        throw new RuntimeException('Missing parameter for the endpoint indices.exists');
    }

    public function getParamWhitelist(): array
    {
        return [
            'local',
            'ignore_unavailable',
            'allow_no_indices',
            'expand_wildcards',
            'flat_settings',
            'include_defaults',
            'pretty',
            'human',
            'error_trace',
            'source',
            'filter_path'
        ];
    }

    public function getMethod(): string
    {
        return 'HEAD';
    }
}
