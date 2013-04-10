<?php
/**
 * CancelInvoiceComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class CancelInvoiceComponent extends Component {
	
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
		$CancelInvoiceFields = array(
									'InvoiceID' => '', 			// ID of the invoice.
									'Subject' => '', 			// Subject of the cancelation notification.
									'NoteForPayer' => '', 		// Note to send the payer within the cancelation notification.
									'SendCopyToMerchant' => ''	// Indicates whether to send a copy of the cancelation notification to the merchant.  Values are:  true/false
									);

		$PayPalRequestData = array('CancelInvoiceFields' => $CancelInvoiceFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->CancelInvoice($PayPalRequestData);

		return $PayPalResult;
	}
}
?>