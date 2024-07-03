<?php

/**
 * SPDX-License-Identifier: Apache-2.0
 *
 * The OpenSearch Contributors require contributions made to
 * this file be licensed under the Apache-2.0 license or a
 * compatible open source license.
 *
 * Modifications Copyright OpenSearch Contributors. See
 * GitHub history for details.
 */

namespace OpenSearch\Namespaces;

use OpenSearch\Endpoints\AbstractEndpoint;

class SecurityNamespace extends AbstractNamespace
{
    /**
     * $params['action_group']       = (string) The name of the action group to create
     * $params['allowed_actions']    = (array) list of allowed actions
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function createActionGroup(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\CreateActionGroup');
        $endpoint->setBody([
            'allowed_actions' => $this->extractArgument($params, 'allowed_actions'),
        ]);
        $endpoint->setActionGroup($this->extractArgument($params, 'action_group'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['role']                 = (string) The name of the role to create
     * $params['cluster_permissions']  = (array)
     * $params['index_permissions']    = (array)
     * $params['tenant_permissions']   = (array)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function createRole(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\CreateRole');
        $endpoint->setBody(array_filter([
            'cluster_permissions' => $this->extractArgument($params, 'cluster_permissions'),
            'index_permissions' => $this->extractArgument($params, 'index_permissions'),
            'tenant_permissions' => $this->extractArgument($params, 'tenant_permissions'),
        ]));
        $endpoint->setRole($this->extractArgument($params, 'role'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['role']           = (string) The name of the role mapping to create
     * $params['backend_roles']  = (array)
     * $params['hosts']          = (array)
     * $params['users']          = (array)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function createRoleMapping(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\CreateRoleMapping');
        $endpoint->setBody(array_filter([
            'backend_roles' => $this->extractArgument($params, 'backend_roles'),
            'hosts' => $this->extractArgument($params, 'hosts'),
            'users' => $this->extractArgument($params, 'users'),
        ]));
        $endpoint->setRole($this->extractArgument($params, 'role'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['tenant']        = (string) The name of the tenant to create
     * $params['description']  = (string)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function createTenant(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\CreateTenant');
        $endpoint->setBody([
            'description' => $this->extractArgument($params, 'description'),
        ]);
        $endpoint->setTenant($this->extractArgument($params, 'tenant'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['username']                    = (string) The username to give the created user
     * $params['password']                   = (string)
     * $params['opendistro_security_roles']  = (array)
     * $params['backend_roles']              = (array)
     * $params['attributes']                 = (array)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function createUser(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\CreateUser');
        $endpoint->setBody(array_filter([
            'password' => $this->extractArgument($params, 'password'),
            'opendistro_security_roles' => $this->extractArgument($params, 'opendistro_security_roles'),
            'backend_roles' => $this->extractArgument($params, 'backend_roles'),
            'attributes' => $this->extractArgument($params, 'attributes'),
        ]));
        $endpoint->setUsername($this->extractArgument($params, 'username'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['action_group']  = (string) The name of the action group to delete
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function deleteActionGroup(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\DeleteActionGroup');
        $endpoint->setActionGroup($this->extractArgument($params, 'action_group'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['role']  = (string) The name of the role to delete
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function deleteRole(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\DeleteRole');
        $endpoint->setRole($this->extractArgument($params, 'role'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['role']  = (string) The name of the role mapping to delete
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function deleteRoleMapping(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\DeleteRoleMapping');
        $endpoint->setRole($this->extractArgument($params, 'role'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['tenant']  = (string) The name of the tenant to delete
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function deleteTenant(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\DeleteTenant');
        $endpoint->setTenant($this->extractArgument($params, 'tenant'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['username']  = (string) The username of the user to delete
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function deleteUser(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\DeleteUser');
        $endpoint->setUsername($this->extractArgument($params, 'username'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * @param array $params Associative array of parameters
     * @return array
     */
    public function flushCache(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\FlushCache');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['action_group'] = (string) The name of the action group to fetch, omit to fetch all (optional)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function getActionGroups(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\GetActionGroups');
        $endpoint->setActionGroup($this->extractArgument($params, 'action_group'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * @param array $params Associative array of parameters
     * @return array
     */
    public function getCertificates(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\GetCertificates');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['cluster_name'] = (string) The name of the cluster to get distinguished names for, omit to fetch all (optional)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function getDistinguishedNames(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\GetDistinguishedNames');
        $endpoint->setClusterName($this->extractArgument($params, 'cluster_name'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['role'] = (string) The name of the role to get mappings for, omit to fetch all (optional)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function getRoleMappings(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\GetRoleMappings');
        $endpoint->setRole($this->extractArgument($params, 'role'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['role'] = (string) The name of the role fetch, omit to fetch all (optional)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function getRoles(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\GetRoles');
        $endpoint->setRole($this->extractArgument($params, 'role'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['tenant'] = (string) The name of the tenant to fetch, omit to fetch all (optional)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function getTenants(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\GetTenants');
        $endpoint->setTenant($this->extractArgument($params, 'tenant'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['username'] = (string) The username of the user to fetch, omit to fetch all (optional)
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function getUsers(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\GetUsers');
        $endpoint->setUsername($this->extractArgument($params, 'username'));
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * @param array $params Associative array of parameters
     * @return array
     */
    public function health(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\Health');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['action_group'] = (string) The name of the action group to update, omit to patch multiple (optional)
     * $params['ops']          = (array) List of operations to execute
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function patchActionGroups(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\PatchActionGroups');
        $endpoint->setActionGroup($this->extractArgument($params, 'action_group'));
        $endpoint->setBody($this->extractArgument($params, 'ops') ?? []);
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['role'] = (string) The name of the role mappings to update, omit to patch multiple (optional)
     * $params['ops']  = (array) List of operations to execute
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function patchRoleMappings(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\PatchRoleMappings');
        $endpoint->setRole($this->extractArgument($params, 'role'));
        $endpoint->setBody($this->extractArgument($params, 'ops') ?? []);
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['role'] = (string) The name of the role to update, omit to patch multiple (optional)
     * $params['ops']  = (array) List of operations to execute
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function patchRoles(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\PatchRoles');
        $endpoint->setRole($this->extractArgument($params, 'role'));
        $endpoint->setBody($this->extractArgument($params, 'ops') ?? []);
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['tenant'] = (string) The name of the tenant to update, omit to patch multiple (optional)
     * $params['ops']    = (array) List of operations to execute
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function patchTenants(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\PatchTenants');
        $endpoint->setTenant($this->extractArgument($params, 'tenant'));
        $endpoint->setBody($this->extractArgument($params, 'ops') ?? []);
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['username'] = (string) The username of the user to update, omit to patch multiple (optional)
     * $params['ops']      = (array) List of operations to execute
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function patchUsers(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\PatchUsers');
        $endpoint->setUsername($this->extractArgument($params, 'username'));
        $endpoint->setBody($this->extractArgument($params, 'ops') ?? []);
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * $params['dynamic'] = (array) array of config options
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function updateConfig(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\UpdateConfig');
        $endpoint->setBody([
            'dynamic' => $this->extractArgument($params, 'dynamic'),
        ]);
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Deletes all distinguished names in the specified cluster or node allow list. Only accessible to super-admins and with rest-api permissions when enabled.
     *
     * $params['cluster_name'] = (string)  (Required)
     * $params['pretty']       = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']        = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace']  = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']       = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path']  = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function deleteDistinguishedName(array $params = [])
    {
        $cluster_name = $this->extractArgument($params, 'cluster_name');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\DeleteDistinguishedName');
        $endpoint->setParams($params);
        $endpoint->setClusterName($cluster_name);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns account details for the current user.
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
    public function getAccountDetails(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\GetAccountDetails');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }

    /**
     * Returns the current Security plugin configuration in JSON format.
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
    public function getConfiguration(array $params = [])
    {
        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\GetConfiguration');
        $endpoint->setParams($params);

        return $this->performRequest($endpoint);
    }
    /**
     * A PATCH call is used to update the existing configuration using the REST API. Only accessible by admins and users with rest api access and only when put or patch is enabled.
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
    public function patchConfiguration(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\PatchConfiguration');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Adds or updates the specified distinguished names in the cluster or node allow list. Only accessible to super-admins and with rest-api permissions when enabled.
     *
     * $params['cluster_name'] = (string)  (Required)
     * $params['pretty']       = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']        = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace']  = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']       = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path']  = (any) Comma-separated list of filters used to reduce the response.
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function updateDistinguishedName(array $params = [])
    {
        $cluster_name = $this->extractArgument($params, 'cluster_name');
        $body = $this->extractArgument($params, 'body');

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\UpdateDistinguishedName');
        $endpoint->setParams($params);
        $endpoint->setClusterName($cluster_name);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }

    /**
     * Proxy function to deleteDistinguishedNames() to prevent BC break.
     * This API will be removed in a future version. Use 'deleteDistinguishedName' API instead.
     */
    public function deleteDistinguishedNames(array $params = [])
    {
        return $this->deleteDistinguishedName($params);
    }

    /**
     * Proxy function to getAccount() to prevent BC break.
     * This API will be removed in a future version. Use 'getAccountDetails' API instead.
     */
    public function getAccount(array $params = [])
    {
        return $this->getAccountDetails($params);
    }

    /**
     * Proxy function to getConfig() to prevent BC break.
     * This API will be removed in a future version. Use 'getConfiguration' API instead.
     */

    public function getConfig(array $params = [])
    {
        return $this->getConfiguration($params);
    }

    /**
     * Proxy function to patchConfig() to prevent BC break.
     * This API will be removed in a future version. Use 'patchConfiguration' API instead.
     */
    public function patchConfig(array $params = [])
    {
        $ops = $this->extractArgument($params, 'ops');
        if ($ops !== null) {
            $params['body'] = $ops;
        }
        return $this->patchConfiguration($params);
    }

    /**
     * Proxy function to updateDistinguishedNames() to prevent BC break.
     * This API will be removed in a future version. Use 'updateDistinguishedName' API instead.
     */
    public function updateDistinguishedNames(array $params = [])
    {
        return $this->updateDistinguishedName($params);
    }

    /**
     * Changes the password for the current user.
     *
     * $params['pretty']      = (boolean) Whether to pretty format the returned JSON response.
     * $params['human']       = (boolean) Whether to return human readable values for statistics.
     * $params['error_trace'] = (boolean) Whether to include the stack trace of returned errors.
     * $params['source']      = (string) The URL-encoded request definition. Useful for libraries that do not accept a request body for non-POST requests.
     * $params['filter_path'] = (any) Comma-separated list of filters used to reduce the response.
     * $params['current_password']   = (string) The current password
     * $params['password']           = (string) New password
     *
     * @param array $params Associative array of parameters
     * @return array
     */
    public function changePassword(array $params = [])
    {
        $body = $this->extractArgument($params, 'body');
        if ($body === null) {
            $body = [
                'current_password' => $this->extractArgument($params, 'current_password'),
                'password' => $this->extractArgument($params, 'password'),
            ];
        }

        $endpointBuilder = $this->endpoints;
        $endpoint = $endpointBuilder('Security\ChangePassword');
        $endpoint->setParams($params);
        $endpoint->setBody($body);

        return $this->performRequest($endpoint);
    }
}
