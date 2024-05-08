<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Notifications;

use OpenSearch\Common\Exceptions\RuntimeException;
use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class UpdateConfig
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class UpdateConfig extends AbstractEndpoint
{
    protected $config_id;

    public function getURI(): string
    {
        $config_id = $this->config_id ?? null;

        if (isset($config_id)) {
            return "/_plugins/_notifications/configs/$config_id";
        }
        throw new RuntimeException('Missing parameter for the endpoint notifications.update_config');
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
        return 'PUT';
    }

    public function setBody($body): UpdateConfig
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setConfigId($config_id): UpdateConfig
    {
        if (isset($config_id) !== true) {
            return $this;
        }
        $this->config_id = $config_id;

        return $this;
    }
}