<?php
/**
 * PreapprovalDetailsComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class PreapprovalDetailsComponent extends Component {
	
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
		$PreapprovalDetailsFields = array(
										  'GetBillingAddress' => '', 									// Opion to get the billing address in the response.  true or false.  Only available with Advanced permissions levels.
										  'PreapprovalKey' => '' 										// Required.  A preapproval key that identifies the preapproval for which you want to retrieve details.  Returned in the PreapprovalResponse
										  );

		$PayPalRequestData = array(
							 'PreapprovalDetailsFields' => $PreapprovalDetailsFields
							 );

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->PreapprovalDetails($PayPalRequestData);

		return $PayPalResult;
	}
}
?>