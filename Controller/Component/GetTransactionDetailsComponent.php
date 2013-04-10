<?php
/**
 * GetTransactionDetailsComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class GetTransactionDetailsComponent extends Component {
	
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
		$GTDFields = array(
							'transactionid' => ''							// PayPal transaction ID of the order you want to get details for.
						);
				
		$PayPalRequestData = array('GTDFields'=>$GTDFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->GetTransactionDetails($PayPalRequestData);

		return $PayPalResult;
	}
}
?>