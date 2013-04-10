<?php
/**
 * GetBalanceComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class GetBalanceComponent extends Component {
	
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
		$GBFields = array('returnallcurrencies' => '');
		$PayPalRequestData = array('GBFields'=>$GBFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->GetBalance($PayPalRequestData);

		return $PayPalResult;
	}
}
?>