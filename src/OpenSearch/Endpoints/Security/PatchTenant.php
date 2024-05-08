<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Security;

use OpenSearch\Common\Exceptions\RuntimeException;
use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class PatchTenant
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class PatchTenant extends AbstractEndpoint
{
    protected $tenant;

    public function getURI(): string
    {
        if (isset($this->tenant) !== true) {
            throw new RuntimeException(
                'tenant is required for patch_tenant'
            );
        }
        $tenant = $this->tenant;

        return "/_plugins/_security/api/tenants/$tenant";
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
        return 'PATCH';
    }

    public function setBody($body): PatchTenant
    {
        if (isset($body) !== true) {
            return $this;
        }
        $this->body = $body;

        return $this;
    }

    public function setTenant($tenant): PatchTenant
    {
        if (isset($tenant) !== true) {
            return $this;
        }
        $this->tenant = $tenant;

        return $this;
    }
}