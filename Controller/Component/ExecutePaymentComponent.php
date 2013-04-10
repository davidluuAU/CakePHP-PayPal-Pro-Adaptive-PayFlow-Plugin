<?php
/**
 * ExecutePaymentComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class ExecutePaymentComponent extends Component {
	
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
		$ExecutePaymentFields = array(
									'PayKey' => '', 								// The pay key that identifies the payment to be executed.  This is the key returned in the PayResponse message.
									'FundingPlanID' => '' 							// The ID of the funding plan from which to make this payment.
									);
							
		$PayPalRequestData = array('ExecutePaymentFields' => $ExecutePaymentFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->ExecutePayment($PayPalRequestData);

		return $PayPalResult;
	}
}
?>