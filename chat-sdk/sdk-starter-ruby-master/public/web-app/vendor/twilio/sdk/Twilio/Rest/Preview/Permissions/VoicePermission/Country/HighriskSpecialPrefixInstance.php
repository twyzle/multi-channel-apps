<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Permissions\VoicePermission\Country;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 * 
 * @property string prefix
 */
class HighriskSpecialPrefixInstance extends InstanceResource {
    /**
     * Initialize the HighriskSpecialPrefixInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $parentIsoCode The ISO country code
     * @return \Twilio\Rest\Preview\Permissions\VoicePermission\Country\HighriskSpecialPrefixInstance 
     */
    public function __construct(Version $version, array $payload, $parentIsoCode) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array('prefix' => Values::array_get($payload, 'prefix'), );

        $this->solution = array('parentIsoCode' => $parentIsoCode, );
    }

    /**
     * Magic getter to access properties
     * 
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Preview.Permissions.HighriskSpecialPrefixInstance]';
    }
}