<?php
/**
 * DoAuthorizationComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class DoAuthorizationComponent extends Component {
	
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
		$DAFields = array(
						'transactionid' => '', 					// Required.  The value of the order's transaction ID number returned by PayPal.  
						'amt' => '', 							// Required. Must have two decimal places.  Decimal separator must be a period (.) and optional thousands separator must be a comma (,)
						'transactionentity' => '', 				// Type of transaction to authorize.  The only allowable value is Order, which means that the transaction represents a customer order that can be fulfilled over 29 days.
						'currencycode' => '', 					// Three-character currency code.
					);
			
		$PayPalRequestData = array('DAFields'=>$DAFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->DoAuthorization($PayPalRequestData);

		return $PayPalResult;
	}
}
?>