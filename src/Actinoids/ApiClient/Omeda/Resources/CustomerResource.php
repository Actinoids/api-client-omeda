<?php

namespace Actinoids\ApiClient\Omeda\Resources;

use \DateTime;
use Actinoids\ApiClient\Common\AbstractResource;

/**
 * Omeda Customer API resource.
 *
 * @author Jacob Bare <jacob.bare@gmail.com>
 */
class CustomerResource extends AbstractResource
{
    /**
     * Address Lookup Service.
     *
     * This service returns all available addresses stored for a given customer.
     * You would use this service to look up addresses using the Customer ID.
     *
     * https://jira.omeda.com/wiki/en/Address_Lookup_Service
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function addressLookup($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/address/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Behavior Lookup API
     *
     * The behavior lookup API call returns behavior information for a specified customer.
     *
     * https://jira.omeda.com/wiki/en/Customer_Behavior_API
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function behaviorLookup($customerId, $behaviorId = null, $productId = null)
    {
        $endpoint = '/customer/' . $customerId . '/behavior/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Behavior Lookup API by Behavior
     *
     * The behavior lookup API call returns behavior information for a specified customer and behavior.
     *
     * https://jira.omeda.com/wiki/en/Customer_Behavior_API
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @param   int     $behaviorId     The Omeda BehvaiorId to lookup.
     * @return  array
     */
    public function behaviorLookupByBehavior($customerId, $behaviorId)
    {
        $endpoint = '/customer/' . $customerId . '/behavior/' . $behaviorId . '/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Behavior Lookup API by Product
     *
     * The behavior lookup API call returns behavior information for a specified customer and product.
     *
     * https://jira.omeda.com/wiki/en/Customer_Behavior_API
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @param   int     $productId      The Omeda ProductId to lookup.
     * @return  array
     */
    public function behaviorLookupByProduct($customerId, $productId)
    {
        $endpoint = '/customer/' . $customerId . '/behavior/product/' . $productId . '/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Transaction Lookup Service.
     *
     * The Transaction Lookup service is used to check on the submission status of a particular customer POST submission.
     * Please note that the data submitted to the queue will not necessarily be kept available indefinitely.
     *
     * https://jira.omeda.com/wiki/en/Transaction_Lookup_Service
     *
     * @param   int     $transactionId  The transaction identifier, handed back by the customer save() POST submission.
     * @return  array
     */
    public function checkProcessingStatus($transactionId)
    {
        $endpoint = '/transaction/' . $transactionId . '/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Comprehensive Lookup Service.
     *
     * This API provides capabilities to retrieve the comprehensive information about a single customer.
     * You would use this service to look up a customer using the Customer Id.
     *
     * https://jira.omeda.com/wiki/en/Customer_Comprehensive_Lookup_Service
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function comprehensiveLookup($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/comp/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Demographic Lookup Service.
     *
     * This service returns all available customer demographics stored for a given customer.
     * You would use this service to look up customer demographics using the Customer ID.
     *
     * https://jira.omeda.com/wiki/en/Customer_Demographic_Lookup_Service
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function demographicLookup($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/demographic/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Email Address Lookup Service.
     *
     * This service returns all active email address information stored for a given customer.
     * You would use this service to look up emails using the Customer ID.
     *
     * https://jira.omeda.com/wiki/en/Email_Address_Lookup_Service
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function emailLookup($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/email/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer External ID API.
     *
     * This service returns all available External IDs stored for a given customer.
     * You would use this service to look up External Ids using the Customer ID.
     *
     * https://jira.omeda.com/wiki/en/Customer_External_ID_API
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function externalIdLookup($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/externalid/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Change Lookup Service.
     *
     * This service returns a list of Customer Ids for Customers that were changed within a given date range.
     * The date range cannot exceed 90 days.
     * A change is defined as any modification to a customer record via any process.
     *
     * https://jira.omeda.com/wiki/en/Customer_Change_Lookup_Service
     *
     * @param   DateTime    $startDate  The beginning of the date range (inclusive).
     * @param   DateTime    $endDate    The end of the date range (inclusive).
     * @return  array
     */
    public function lookupByChange(DateTime $startDate, DateTime $endDate)
    {
        $format = 'mdY_Hi';
        $endpoint = '/customer/change/startdate/' . $startDate->format($format) . '/enddate/' . $endDate->format($format) .'/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Lookup Service By Email.
     *
     * This API provides capabilities to retrieve a single customer record containing all available name, contact, and demographic
     * information about the customer. You would use this service to look up a customer using an Email Address.
     *
     * https://jira.omeda.com/wiki/en/Customer_Lookup_Service_By_Email
     *
     * @param   string  $email  The Email Address to lookup.
     * @return  array
     */
    public function lookupByEmail($email)
    {
        $endpoint = '/customer/email/' . $email . '/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Lookup Service By EncryptedCustomerId.
     *
     * This API provides capabilities to retrieve a single customer record containing all available name, contact, and demographic
     * information about the customer. You would use this service to look up a customer using the Encrypted Customer id.
     *
     * https://jira.omeda.com/wiki/en/Customer_Lookup_Service_By_EncryptedCustomerId
     *
     * @param   string  $encryptedId    The Omeda EncryptedCustomerId to lookup.
     * @return  array
     */
    public function lookupByEncryptedId($encryptedId)
    {
        $endpoint = '/customer/' . $encryptedId . '/encrypted/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Lookup Service By External ID.
     *
     * This API provides the capability to retrieve all available name, contact, and demographic
     * information about a single active customer record by Client's Customer ID or Omeda Legacy ID.
     *
     * https://jira.omeda.com/wiki/en/Customer_Lookup_Service_By_External_ID
     *
     * @param   string  $externalCustomerIdNamespace    The type of customer ID you would like to lookup. Please contact your Omeda Account Representative for what code to use here.
     * @param   mixed   $externalCustomerId             The client's customer ID or Omeda Legacy ID.
     * @return  array
     */
    public function lookupByExternalId($externalCustomerIdNamespace, $externalCustomerId)
    {
        $endpoint = '/customer/' . $externalCustomerIdNamespace . '/externalcustomeridnamespace/' . $externalCustomerId . '/externalcustomerid/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Lookup Service By CustomerId.
     *
     * This API provides the capability to retrieve all available name, contact, and demographic information
     * about a single customer record by the Customer ID.
     *
     * https://jira.omeda.com/wiki/en/Customer_Lookup_Service_By_CustomerId
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function lookupById($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Lookup Service By PostalAddressId.
     *
     * This API provides the capability to retrieve all available name, contact, and demographic
     * information about a single customer record by using the ID that is on their magazine mailing label.
     *
     * https://jira.omeda.com/wiki/en/Customer_Lookup_Service_By_PostalAddressId
     *
     * @param   string  $postalAddressId    The internal postal address id. This is typically what a magazine subscriber would find on their mailing label.
     * @return  array
     */
    public function lookupByPostalAddressId($postalAddressId)
    {
        $endpoint = '/customer/' . $postalAddressId . '/postaladdressid/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Merge History Service.
     *
     * This API provides capabilities to retrieve the merge history for the requested customer id.
     *
     * https://jira.omeda.com/wiki/en/Customer_Merge_History_Service
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function mergeHistory($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/mergehistory/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Phone Lookup Service.
     *
     * This service returns all available phone information stored for a customer.
     * You would use this service to look up a phone information using the Customer ID.
     *
     * https://jira.omeda.com/wiki/en/Phone_Lookup_Service
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function phoneLookup($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/phone/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Save Customer and Order API.
     *
     * This API provides the ability to post a complete set of customer identity, contact, and demographic
     * information along with order information for data processing (insert/update).
     * Note that this service deposits data into a queue, it does not process data immediately.
     * Back end processing of the data happens through a decoupled processing layer and depends on your own individual database configuration.
     *
     * https://jira.omeda.com/wiki/en/Save_Customer_and_Order_API
     *
     * @param   array   $customerElement    The customer element to save (create/update).
     * @return  array
     */
    public function save(array $customerElement)
    {
        $endpoint = '/storecustomerandorder/*';
        return $this->handleRequest($endpoint, $customerElement, 'POST');
    }

    /**
     * Customer Subscriptions Lookup Service.
     *
     * This service returns all available subscription information stored for a given customer.
     * Note, this includes both current subscription and deactivated subscriptions.
     * This service only returns Product types that create a Subscription.
     * Currently only Magazine (productType=1) and Newsletter (productType=2) type products create Customer Subscriptions.
     * Use the optLookup method in the Omail resource for opt in/out status for Email Deployment type products (productType=5).
     *
     * https://jira.omeda.com/wiki/en/Customer_Subscriptions_Lookup_Service
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @return  array
     */
    public function subscriptionLookup($customerId)
    {
        $endpoint = '/customer/' . $customerId . '/subscription/*';
        return $this->getRoot()->send($endpoint);
    }

    /**
     * Customer Subscription Lookup By Product.
     *
     * This service returns all subscription information stored for a given customer AND product.
     * Note, this includes both current subscription and deactivated subscriptions.
     * This service only returns Product types that create a Subscription.
     * Currently only Magazine (productType=1) and Newsletter (productType=2) type products create Customer Subscriptions.
     * Use the optLookup method in the Omail resource for opt in/out status for Email Deployment type products (productType=5).
     *
     * https://jira.omeda.com/wiki/en/Customer_Subscription_Lookup_By_Product
     *
     * @param   int     $customerId     The Omeda CustomerId to lookup.
     * @param   int     $productId      The Omeda ProductId.
     * @return  array
     */
    public function subscriptionLookupByProduct($customerId, $productId)
    {
        $endpoint = '/customer/' . $customerId . '/subscription/product/' . $productId . '/*';
        return $this->getRoot()->send($endpoint);
    }
}
