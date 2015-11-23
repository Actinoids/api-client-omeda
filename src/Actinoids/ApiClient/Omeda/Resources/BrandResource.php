<?php

namespace Actinoids\ApiClient\Omeda\Resources;

use Actinoids\ApiClient\Common\AbstractResource;

/**
 * Omeda Brand API resource.
 *
 * @author Jacob Bare <jacob.bare@gmail.com>
 */
class BrandResource extends AbstractResource
{
    /**
     * Brand Comprehensive Lookup Service.
     *
     * This API provides capabilities to retrieve information about a single brand,
     * including its defined products, demographics, deployment types, and other cross referencing information.
     * This service is useful for building your own data mapping service when reading or writing
     * from/to other Omeda services.
     *
     * https://jira.omeda.com/wiki/en/Brand_Comprehensive_Lookup_Service
     *
     * @return  array
     */
    public function comprehensiveLookup()
    {
        $endpoint = '/comp/*';
        return $this->getRoot()->send($endpoint);
    }
}
