<?php
/**
 * RefundComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class RefundComponent extends Component {
	
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
		$RefundFields = array(
							  'CurrencyCode' => '', 											// Required.  Must specify code used for original payment.  You do not need to specify if you use a payKey to refund a completed transaction.
							  'PayKey' => '',  													// Required.  The key used to create the payment that you want to refund.
							  'TransactionID' => '', 											// Required.  The PayPal transaction ID associated with the payment that you want to refund.
							  'TrackingID' => ''												// Required.  The tracking ID associated with the payment that you want to refund.
							  );

		$Receivers = array();
		$Receiver = array(
						  'Email' => '',									// A receiver's email address. 
						  'Amount' => '', 									// Amount to be debited to the receiver's account.
						  'Primary' => '', 									// Set to true to indicate a chained payment.  Only one receiver can be a primary receiver.  Omit this field, or set to false for simple and parallel payments.
						  'InvoiceID' => '', 								// The invoice number for the payment.  This field is only used in Pay API operation.
						  'PaymentType' => ''								// The transaction subtype for the payment.  Allowable values are: GOODS, SERVICE
						  );

		array_push($Receivers, $Receiver);

		$PayPalRequestData = array(
							 'RefundFields' => $RefundFields, 
							 'Receivers' => $Receivers
							 );


		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->Refund($PayPalRequestData);

		return $PayPalResult;
	}
}
?>