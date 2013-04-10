<?php
/**
 * DoReauthorizationComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class DoReauthorizationComponent extends Component {
	
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
		$DRFields = array(
						'authorizationid' => '', 				// Required. The value of a previously authorized transaction ID returned by PayPal.
						'amt' => '', 							// Required. Must have two decimal places.  Decimal separator must be a period (.) and optional thousands separator must be a comma (,)
						'currencycode' => ''					// Three-character currency code.
						);
				
		$PayPalRequestData = array('DRFields'=>$DRFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->DoReauthorization($PayPalRequestData);

		return $PayPalResult;
	}
}
?>