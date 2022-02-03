<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\DeployedDevices\Fleet;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Serialize;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class DeviceList extends ListResource {
    /**
     * Construct the DeviceList
     *
     * @param Version $version Version that contains the resource
     * @param string $fleetSid The unique identifier of the Fleet.
     */
    public function __construct(Version $version, string $fleetSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['fleetSid' => $fleetSid, ];

        $this->uri = '/Fleets/' . \rawurlencode($fleetSid) . '/Devices';
    }

    /**
     * Create a new DeviceInstance
     *
     * @param array|Options $options Optional Arguments
     * @return DeviceInstance Newly created DeviceInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []): DeviceInstance {
        $options = new Values($options);

        $data = Values::of([
            'UniqueName' => $options['uniqueName'],
            'FriendlyName' => $options['friendlyName'],
            'Identity' => $options['identity'],
            'DeploymentSid' => $options['deploymentSid'],
            'Enabled' => Serialize::booleanToString($options['enabled']),
        ]);

        $payload = $this->version->create(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new DeviceInstance($this->version, $payload, $this->solution['fleetSid']);
    }

    /**
     * Streams DeviceInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return Stream stream of results
     */
    public function stream(array $options = [], int $limit = null, $pageSize = null): Stream {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($options, $limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads DeviceInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return DeviceInstance[] Array of results
     */
    public function read(array $options = [], int $limit = null, $pageSize = null): array {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of DeviceInstance records from the API.
     * Request is executed immediately
     *
     * @param array|Options $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return DevicePage Page of DeviceInstance
     */
    public function page(array $options = [], $pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE): DevicePage {
        $options = new Values($options);
        $params = Values::of([
            'DeploymentSid' => $options['deploymentSid'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);

        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );

        return new DevicePage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of DeviceInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return DevicePage Page of DeviceInstance
     */
    public function getPage(string $targetUrl): DevicePage {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new DevicePage($this->version, $response, $this->solution);
    }

    /**
     * Constructs a DeviceContext
     *
     * @param string $sid A string that uniquely identifies the Device.
     */
    public function getContext(string $sid): DeviceContext {
        return new DeviceContext($this->version, $this->solution['fleetSid'], $sid);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Preview.DeployedDevices.DeviceList]';
    }
}