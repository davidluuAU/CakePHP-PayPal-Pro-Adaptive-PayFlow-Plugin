<?php
/**
 * PaymentDetailsComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class PaymentDetailsComponent extends Component {
	
	// $PaymentDetailsFields = array(
	// 							'PayKey' => '', 							// The pay key that identifies the payment for which you want to retrieve details.  
	// 							'TransactionID' => '', 						// The PayPal transaction ID associated with the payment.  
	// 							'TrackingID' => ''							// The tracking ID that was specified for this payment in the PayRequest message.  127 char max.
	// 							);
	
	public function execute($PaymentDetailsFields) {
							
		$configuration = new Paypal_Config();

		// Create PayPal object.
		$PayPalConfig = array(
							  'Sandbox' => $configuration->sandbox,
							  'DeveloperAccountEmail' => $configuration->developer_account_email,
							  'ApplicationID' => $configuration->application_id,
							  'DeviceID' => $configuration->device_id,
							  'IPAddress' => $_SERVER['REMOTE_ADDR'],
							  'APIUsername' => $configuration->api_username,
							  'APIPassword' => $configuration->api_password,
							  'APISignature' => $configuration->api_signature,
							  'APISubject' => $configuration->api_subject
							);							
							
		$PayPal = new PayPal_Adaptive($PayPalConfig);

		// Prepare request arrays
		// $PaymentDetailsFields = array(
		// 							'PayKey' => '', 							// The pay key that identifies the payment for which you want to retrieve details.  
		// 							'TransactionID' => '', 						// The PayPal transaction ID associated with the payment.  
		// 							'TrackingID' => ''							// The tracking ID that was specified for this payment in the PayRequest message.  127 char max.
		// 							);
							
		$PayPalRequestData = array('PaymentDetailsFields' => $PaymentDetailsFields);


		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->PaymentDetails($PayPalRequestData);

		return $PayPalResult;
	}
}
?>