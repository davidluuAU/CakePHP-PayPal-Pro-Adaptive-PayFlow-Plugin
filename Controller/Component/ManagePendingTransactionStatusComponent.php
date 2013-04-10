<?php
/**
 * ManagePendingTransactionStatusComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class ManagePendingTransactionStatusComponent extends Component {
	
	public function execute() {

		// Create PayPal object.
		$PayPalConfig = array(
							'Sandbox' => $this->sandbox,
							'APIUsername' => $this->api_username,
							'APIPassword' => $this->api_password,
							'APISignature' => $this->api_signature
							);

		$PayPal = new PayPal($PayPalConfig);

		// Prepare request arrays
		$MPTSFields = array
						(
						'transactionid' => '', 								// Required. Transaction ID of the payment transaction.
						'action' => ''										// Required.  The operation you want to perform on the pending transaction.  Options are: Accept, Deny 
						);
				
		$PayPalRequestData = array('MPTSFields'=>$MPTSFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->ManagePendingTransactionStatus($PayPalRequestData);

		return $PayPalResult;
	}


}