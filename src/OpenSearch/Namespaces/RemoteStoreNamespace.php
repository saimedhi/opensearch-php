<?php

declare(strict_types = 1);

namespace OpenSearch\Namespaces;

use OpenSearch\Namespaces\AbstractNamespace;

/**
 * Class RemoteStoreNamespace
 *
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 */
class RemoteStoreNamespace extends AbstractNamespace
{

    /**
     * Restores from remote store.
     *
     * $params['cluster_manager_timeout'] = (string) Operation timeout for connection to cluster-manager node.
     * $params['wait_for_completion']     = (boolean) Should this request wait until the operation has completed before returning. (Default = false)
     * $params['pretty']                  = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']                   = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace']             = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']                  = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path']             = (any) Comma-separated list of filters used to reduce the response.
     * $params['body']                    = (array) Comma-separated list of index IDs (Required)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function restore(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('RemoteStore\Restore');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}
