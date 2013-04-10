<?php
/**
 * GetAdvancedPersonalDataComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class GetAdvancedPersonalDataComponent extends Component {
	
	public function execute() {

		// Create PayPal object.
		$PayPalConfig = array(
							  'Sandbox' => $this->sandbox,
							  'DeveloperAccountEmail' => $this->developer_account_email,
							  'ApplicationID' => $this->application_id,
							  'DeviceID' => $this->device_id,
							  'IPAddress' => $_SERVER['REMOTE_ADDR'],
							  'APIUsername' => $this->api_username,
							  'APIPassword' => $this->api_password,
							  'APISignature' => $this->api_signature,
							  'APISubject' => $this->api_subject
							);

		$PayPal = new PayPal_Adaptive($PayPalConfig);

		// Prepare request arrays
		$AttributeList = array(
								'http://axschema.org/birthDate',
								'http://axschema.org/contact/postalCode/home',
								'http://schema.openid.net/contact/street1',
								'http://schema.openid.net/contact/street2',
								'http://axschema.org/contact/city/home',
								'http://axschema.org/contact/state/home',
								'http://axschema.org/contact/phone/default'
							);
					
		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->GetAdvancedPersonalData($AttributeList);

		return $PayPalResult;
	}
}
?>