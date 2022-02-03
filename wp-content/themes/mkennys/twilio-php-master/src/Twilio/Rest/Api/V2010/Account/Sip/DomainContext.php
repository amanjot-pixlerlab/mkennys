<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Sip;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Rest\Api\V2010\Account\Sip\Domain\AuthTypesList;
use Twilio\Rest\Api\V2010\Account\Sip\Domain\CredentialListMappingList;
use Twilio\Rest\Api\V2010\Account\Sip\Domain\IpAccessControlListMappingList;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * @property IpAccessControlListMappingList $ipAccessControlListMappings
 * @property CredentialListMappingList $credentialListMappings
 * @property AuthTypesList $auth
 * @method \Twilio\Rest\Api\V2010\Account\Sip\Domain\IpAccessControlListMappingContext ipAccessControlListMappings(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\Sip\Domain\CredentialListMappingContext credentialListMappings(string $sid)
 */
class DomainContext extends InstanceContext {
    protected $_ipAccessControlListMappings;
    protected $_credentialListMappings;
    protected $_auth;

    /**
     * Initialize the DomainContext
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created the resource
     *                           to fetch
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $accountSid, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['accountSid' => $accountSid, 'sid' => $sid, ];

        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/SIP/Domains/' . \rawurlencode($sid) . '.json';
    }

    /**
     * Fetch a DomainInstance
     *
     * @return DomainInstance Fetched DomainInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): DomainInstance {
        $params = Values::of([]);

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new DomainInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['sid']
        );
    }

    /**
     * Update the DomainInstance
     *
     * @param array|Options $options Optional Arguments
     * @return DomainInstance Updated DomainInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): DomainInstance {
        $options = new Values($options);

        $data = Values::of([
            'FriendlyName' => $options['friendlyName'],
            'VoiceFallbackMethod' => $options['voiceFallbackMethod'],
            'VoiceFallbackUrl' => $options['voiceFallbackUrl'],
            'VoiceMethod' => $options['voiceMethod'],
            'VoiceStatusCallbackMethod' => $options['voiceStatusCallbackMethod'],
            'VoiceStatusCallbackUrl' => $options['voiceStatusCallbackUrl'],
            'VoiceUrl' => $options['voiceUrl'],
            'SipRegistration' => Serialize::booleanToString($options['sipRegistration']),
            'DomainName' => $options['domainName'],
        ]);

        $payload = $this->version->update(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new DomainInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['sid']
        );
    }

    /**
     * Deletes the DomainInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Access the ipAccessControlListMappings
     */
    protected function getIpAccessControlListMappings(): IpAccessControlListMappingList {
        if (!$this->_ipAccessControlListMappings) {
            $this->_ipAccessControlListMappings = new IpAccessControlListMappingList(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['sid']
            );
        }

        return $this->_ipAccessControlListMappings;
    }

    /**
     * Access the credentialListMappings
     */
    protected function getCredentialListMappings(): CredentialListMappingList {
        if (!$this->_credentialListMappings) {
            $this->_credentialListMappings = new CredentialListMappingList(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['sid']
            );
        }

        return $this->_credentialListMappings;
    }

    /**
     * Access the auth
     */
    protected function getAuth(): AuthTypesList {
        if (!$this->_auth) {
            $this->_auth = new AuthTypesList(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['sid']
            );
        }

        return $this->_auth;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get(string $name): ListResource {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments): InstanceContext {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.DomainContext ' . \implode(' ', $context) . ']';
    }
}