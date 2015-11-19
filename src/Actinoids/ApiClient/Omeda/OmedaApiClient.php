<?php

namespace Actinoids\ApiClient\Omeda;

use Actinoids\ApiClient\Common\AbstractResourceClient;
use Actinoids\ApiClient\Common\ApiClientException;
use GuzzleHttp\Client;

/**
 * Omeda and Omail API client. 
 *
 * @author Jacob Bare <jacob.bare@gmail.com>
 */
class OmedaApiClient extends AbstractResourceClient
{
    /**
     * An array of request methods that this API supports.
     *
     * @var array
     */
    protected $supportedMethods = ['GET', 'POST', 'PUT', 'DELETE'];

    /**
     * An array of request methods that this API deems as 'modifying.'
     *
     * @var array
     */
    protected $modifyingMethods = ['POST', 'PUT', 'DELETE'];

    /**
     * An array of required configuration options.
     *
     * @var array
     */
    protected $requiredConfigOptions = ['host', 'client', 'brand', 'appid', 'inputid'];

    /**
     * {@inheritDoc}
     */
    protected function initClient()
    {
        $this->client = new Client([
            'base_url'  => $this->getBaseUrl(),
            'defaults'  => [
                'headers'   => ['X-Omeda-Appid' => $this->getAppId()],
            ],
        ]);
        $this->setResources();
        return $this;
    }

    protected function setResources()
    {
        $namespace = __NAMESPACE__.'\\Resources';
        $resources = [
            'customer'  => 'CustomerResource',
        ];
        foreach ($resources as $key => $class) {
            $fqcn = sprintf('%s\\%s', $namespace, $class);
            $this->addResource(new $fqcn($key, $this));
        }
        return $this;
    }

    /**
     * Gets the API hostname.
     *
     * @return  string
     */
    public function getHost()
    {
        return trim($this->getConfig()->get('host'), '/');
    }

    /**
     * Gets the client/customer
     *
     * @return string
     */
    public function getClient()
    {
        return $this->getConfig()->get('client');
    }

    /**
     * Gets the brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->getConfig()->get('brand');
    }

    /**
     * Gets the App ID for reading
     *
     * @return string
     */
    public function getAppId()
    {
        return $this->getConfig()->get('appid');
    }

    /**
     * Gets the Input ID for writing
     *
     * @return string
     */
    public function getInputId()
    {
        return $this->getConfig()->get('inputid');
    }

    /**
     * Gets base URL for the API.
     *
     * @return  string
     */
    public function getBaseUrl()
    {
        return sprintf('https://%s', $this->getHost());
    }

    /**
     * Gets the API endpoint.
     *
     * @param   string  $endpoint    The API endpoint.
     * @param   bool    $clientCall  Whether this is an API that applies to the entire customer/client.
     * @return  string  The request URI
     */
    public function getEndpoint($endpoint = null, $clientCall = false)
    {
        $formatted  = '/webservices/rest';
        $formatted .= (true === $clientCall) ? sprintf('/client/%s', $this->getClient()) : sprintf('/brand/%s', $this->getBrand());
        if (null !== $endpoint) {
            $formatted .= rtrim($endpoint, '/');
        }
        return $formatted;
    }

    /**
     * Handles a request by creating a Request object and sending it to the Kernel.
     *
     * @param   string  $endpoint       The API endpoint.
     * @param   mixed   $content        The request body content to use.
     * @param   string  $method         The request method.
     * @param   bool    $clientCall     Whether this is an API that applies to the entire customer/client.
     * @return  Symfony\Component\HttpFoundation\Response
     */
    public function send($endpoint, $content = null, $method = 'GET', $clientCall = false)
    {
        $request    = $this->createRequest($endpoint, $content, $method, $clientCall);
        $response   = $this->sendRequest($request);
        return $response->json();
    }

    /**
     * Creates a new request object based on API method parameters.
     *
     * @param   string  $endpoint       The API endpoint.
     * @param   mixed   $content        The request body content to use.
     * @param   string  $method         The request method.
     * @param   bool    $clientCall     Whether this is an API that applies to the entire customer/client.
     * @return  \GuzzleHttp\Message\Request
     * @throws  ApiClientException      If a non-supported request method is passed.
     */
    protected function createRequest($endpoint, $content = null, $method = 'GET', $clientCall = false)
    {
        $method = strtoupper($method);
        if (!in_array($method, $this->supportedMethods)) {
            // Request method not allowed by the API
            throw ApiClientException::invalidRequestMethod($method, $this->supportedMethods);
        }

        $options = [];
        if (in_array($method, ['POST', 'PUT'])) {
            // Handle the request body content
            if (is_scalar($content)) {
                $content = (String) $content;
            } elseif (is_array($content)) {
                $content = @json_encode($content);
            }
            $options['body'] = $content;
            $options['headers'] = [
                'X-Omeda-Inputid'   => $this->getInputId(),
                'Content-Type'      => 'application/json',
            ];
        }
        return $this->client->createRequest($method, $this->getEndpoint($endpoint, $clientCall), $options);
    }
}
