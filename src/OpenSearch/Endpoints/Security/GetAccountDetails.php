<?php

declare(strict_types = 1);

namespace OpenSearch\Endpoints\Security;

use OpenSearch\Endpoints\AbstractEndpoint;

/**
 * Class GetAccountDetails
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 * and OpenSearch :version (:buildhash)
 */
class GetAccountDetails extends AbstractEndpoint
{

    public function getURI(): string
    {

        return "/_plugins/_security/api/account";
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
        return 'GET';
    }
}
