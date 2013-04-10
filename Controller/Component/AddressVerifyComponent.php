<?php
/**
 * AddressVerifyComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class AddressVerifyComponent extends Component {
	
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
		$AVFields = array
						(
						'email' => '', 							// Required. Email address of PayPal member to verify.
						'street' => '', 						// Required. First line of the postal address to verify.  35 char max.
						'zip' => ''								// Required.  Postal code to verify.  
						);
				
		$PayPalRequestData = array('AVFields'=>$AVFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->AddressVerify($PayPalRequestData);

		return $PayPalResult;
	}
}
?>