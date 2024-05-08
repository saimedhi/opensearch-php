<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Cluster;

use OpenSearch\Common\Exceptions\RuntimeException;
use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class PutDecommissionAwareness
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class PutDecommissionAwareness extends AbstractEndpoint
{
    protected $awareness_attribute_name;
    protected $awareness_attribute_value;

    public function getURI(): string
    {
        $awareness_attribute_name = $this->awareness_attribute_name ?? null;
        $awareness_attribute_value = $this->awareness_attribute_value ?? null;

        if (isset($awareness_attribute_name) && isset($awareness_attribute_value)) {
            return "/_cluster/decommission/awareness/$awareness_attribute_name/$awareness_attribute_value";
        }
        throw new RuntimeException('Missing parameter for the endpoint cluster.put_decommission_awareness');
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

    public function setAwarenessAttributeName($awareness_attribute_name): PutDecommissionAwareness
    {
        if (isset($awareness_attribute_name) !== true) {
            return $this;
        }
        $this->awareness_attribute_name = $awareness_attribute_name;

        return $this;
    }

    public function setAwarenessAttributeValue($awareness_attribute_value): PutDecommissionAwareness
    {
        if (isset($awareness_attribute_value) !== true) {
            return $this;
        }
        $this->awareness_attribute_value = $awareness_attribute_value;

        return $this;
    }
}
