<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Wireless;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 * 
 * @property string sid
 * @property string uniqueName
 * @property string accountSid
 * @property string ratePlanSid
 * @property string friendlyName
 * @property string iccid
 * @property string eId
 * @property string status
 * @property string commandsCallbackUrl
 * @property string commandsCallbackMethod
 * @property string smsFallbackMethod
 * @property string smsFallbackUrl
 * @property string smsMethod
 * @property string smsUrl
 * @property string voiceFallbackMethod
 * @property string voiceFallbackUrl
 * @property string voiceMethod
 * @property string voiceUrl
 * @property \DateTime dateCreated
 * @property \DateTime dateUpdated
 * @property string url
 * @property array links
 */
class SimInstance extends InstanceResource {
    protected $_usage = null;

    /**
     * Initialize the SimInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The sid
     * @return \Twilio\Rest\Preview\Wireless\SimInstance 
     */
    public function __construct(Version $version, array $payload, $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'sid' => Values::array_get($payload, 'sid'),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'ratePlanSid' => Values::array_get($payload, 'rate_plan_sid'),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'iccid' => Values::array_get($payload, 'iccid'),
            'eId' => Values::array_get($payload, 'e_id'),
            'status' => Values::array_get($payload, 'status'),
            'commandsCallbackUrl' => Values::array_get($payload, 'commands_callback_url'),
            'commandsCallbackMethod' => Values::array_get($payload, 'commands_callback_method'),
            'smsFallbackMethod' => Values::array_get($payload, 'sms_fallback_method'),
            'smsFallbackUrl' => Values::array_get($payload, 'sms_fallback_url'),
            'smsMethod' => Values::array_get($payload, 'sms_method'),
            'smsUrl' => Values::array_get($payload, 'sms_url'),
            'voiceFallbackMethod' => Values::array_get($payload, 'voice_fallback_method'),
            'voiceFallbackUrl' => Values::array_get($payload, 'voice_fallback_url'),
            'voiceMethod' => Values::array_get($payload, 'voice_method'),
            'voiceUrl' => Values::array_get($payload, 'voice_url'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'url' => Values::array_get($payload, 'url'),
            'links' => Values::array_get($payload, 'links'),
        );

        $this->solution = array('sid' => $sid ?: $this->properties['sid'], );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Preview\Wireless\SimContext Context for this SimInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new SimContext($this->version, $this->solution['sid']);
        }

        return $this->context;
    }

    /**
     * Fetch a SimInstance
     * 
     * @return SimInstance Fetched SimInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Update the SimInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return SimInstance Updated SimInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = array()) {
        return $this->proxy()->update($options);
    }

    /**
     * Access the usage
     * 
     * @return \Twilio\Rest\Preview\Wireless\Sim\UsageList 
     */
    protected function getUsage() {
        return $this->proxy()->usage;
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
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Preview.Wireless.SimInstance ' . implode(' ', $context) . ']';
    }
}