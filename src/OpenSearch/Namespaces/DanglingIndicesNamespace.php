<?php

declare(strict_types = 1);

namespace OpenSearch\Namespaces;

use OpenSearch\Namespaces\AbstractNamespace;

/**
 * Class DanglingIndicesNamespace
 *
 * NOTE: this file is autogenerated using util/GenerateEndpoints.php
 */
class DanglingIndicesNamespace extends AbstractNamespace
{

    /**
     * Deletes the specified dangling index.
     *
     * $params['index_uuid']              = (string) The UUID of the dangling index
     * $params['accept_data_loss']        = (boolean) Must be set to true in order to delete the dangling index
     * $params['timeout']                 = (string) Explicit operation timeout
     * $params['master_timeout']          = (string) Specify timeout for connection to master
     * $params['cluster_manager_timeout'] = (string) Operation timeout for connection to cluster-manager node.
     * $params['pretty']                  = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']                   = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace']             = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']                  = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path']             = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function deleteDanglingIndex(array $params = [])
    {
        $index_uuid = $this->extractArgument($params, 'index_uuid');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('DanglingIndices\DeleteDanglingIndex');
        $endpoint->setParams($params);
        $endpoint->setIndexUuid($index_uuid);

        return $this->performRequest($endpoint);
    }
    /**
     * Imports the specified dangling index.
     *
     * $params['index_uuid']              = (string) The UUID of the dangling index
     * $params['accept_data_loss']        = (boolean) Must be set to true in order to import the dangling index
     * $params['timeout']                 = (string) Explicit operation timeout
     * $params['master_timeout']          = (string) Specify timeout for connection to master
     * $params['cluster_manager_timeout'] = (string) Operation timeout for connection to cluster-manager node.
     * $params['pretty']                  = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']                   = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace']             = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']                  = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path']             = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function importDanglingIndex(array $params = [])
    {
        $index_uuid = $this->extractArgument($params, 'index_uuid');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('DanglingIndices\ImportDanglingIndex');
        $endpoint->setParams($params);
        $endpoint->setIndexUuid($index_uuid);

        return $this->performRequest($endpoint);
    }
    /**
     * Returns all dangling indices.
     *
     * $params['pretty']      = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']       = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace'] = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']      = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path'] = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function listDanglingIndices(array $params = [])
    {

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('DanglingIndices\ListDanglingIndices');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
}
