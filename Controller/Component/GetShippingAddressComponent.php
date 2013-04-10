<?php
/**
 * GetShippingAddressComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class GetShippingAddressComponent extends Component {
	
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
		$GetShippingAddressFields = array(
										'Key' => ''		// Required.  The payment PayKey that identifies the account holder for whom you want to obtain the selected shipping address.  This can only be obtained through the Paykey, not a Preapproval Key
										);

		$PayPalRequestData = array('GetShippingAddressFields' => $GetShippingAddressFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->GetShippingAddress($PayPalRequestData);

		return $PayPalResult;
	}
}
?>