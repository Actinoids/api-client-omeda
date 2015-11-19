<?php

namespace Actinoids\ApiClient\Omeda\Resources;

use Actinoids\ApiClient\Common\AbstractResource;

/**
 * Omeda Customer API resource.
 *
 * @author Jacob Bare <jacob.bare@gmail.com>
 */
class CustomerResource extends AbstractResource
{
    /**
     * Performs a Customer Lookup by ID
     * https://wiki.omeda.com/wiki/en/Customer_Lookup_Service_By_CustomerId
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function lookupById($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/*';
        return $this->getRoot()->send($endpoint);
    }
}
