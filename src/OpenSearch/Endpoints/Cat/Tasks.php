<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Cat;

use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class Tasks
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class Tasks extends AbstractEndpoint
{

    public function getURI(): string
    {

        return "/_cat/tasks";
    }

    public function getParamWhitelist(): array
    {
        return [
            'format',
            'nodes',
            'actions',
            'detailed',
            'parent_task_id',
            'h',
            'help',
            's',
            'time',
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
