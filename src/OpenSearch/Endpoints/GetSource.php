<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints;

use OpenSearch\Common\Exceptions\RuntimeException;
use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetSource
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class GetSource extends AbstractEndpoint
{

    public function getURI(): string
    {
        $id = $this->id ?? null;
        $index = $this->index ?? null;

        if (isset($index) && isset($id)) {
            return "/$index/_source/$id";
        }
        throw new RuntimeException('Missing parameter for the endpoint get_source');
    }

    public function getParamWhitelist(): array
    {
        return [
            'preference',
            'realtime',
            'refresh',
            'routing',
            '_source',
            '_source_excludes',
            '_source_includes',
            'version',
            'version_type',
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
