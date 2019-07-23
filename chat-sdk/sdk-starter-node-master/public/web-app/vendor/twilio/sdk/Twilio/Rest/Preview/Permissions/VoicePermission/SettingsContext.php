<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Permissions\VoicePermission;

use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class SettingsContext extends InstanceContext {
    /**
     * Initialize the SettingsContext
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @return \Twilio\Rest\Preview\Permissions\VoicePermission\SettingsContext 
     */
    public function __construct(Version $version) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array();

        $this->uri = '/VoicePermissions/Settings';
    }

    /**
     * Fetch a SettingsInstance
     * 
     * @return SettingsInstance Fetched SettingsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new SettingsInstance($this->version, $payload);
    }

    /**
     * Update the SettingsInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return SettingsInstance Updated SettingsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = array()) {
        $options = new Values($options);

        $data = Values::of(array('Inheritance' => Serialize::booleanToString($options['inheritance']), ));

        $payload = $this->version->update(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new SettingsInstance($this->version, $payload);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Preview.Permissions.SettingsContext ' . implode(' ', $context) . ']';
    }
}