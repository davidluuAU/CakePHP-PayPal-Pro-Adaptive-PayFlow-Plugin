<?php
/**
 * Pay
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class GetVerifiedStatusComponent extends Component {
	
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
		$GetVerifiedStatusFields = array(
										'EmailAddress' => '', 					// Required.  The email address of the PayPal account holder.
										'FirstName' => '', 						// The first name of the PayPal account holder.  Required if MatchCriteria is NAME
										'LastName' => '', 						// The last name of the PayPal account holder.  Required if MatchCriteria is NAME
										'MatchCriteria' => ''					// Required.  The criteria must be matched in addition to EmailAddress.  Currently, only NAME is supported.  Values:  NAME, NONE   To use NONE you have to be granted advanced permissions
										);

		$PayPalRequestData = array('GetVerifiedStatusFields' => $GetVerifiedStatusFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->GetVerifiedStatus($PayPalRequestData);

		return $PayPalResult;
	}
}
?>