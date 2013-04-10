<?php
/**
 * ConvertCurrencyComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class ConvertCurrencyComponent extends Component {
	
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
		$BaseAmountList = array();
		$BaseAmountData = array(
								'Code' => '', 						// Currency code.
								'Amount' => ''						// Amount to be converted.
								);
		array_push($BaseAmountList, $BaseAmountData);

		$ConvertToCurrencyList = array('USD', 'AUD', 'CAD');			// Currency Codes

		$PayPalRequestData = array(
								'BaseAmountList' => $BaseAmountList, 
								'ConvertToCurrencyList' => $ConvertToCurrencyList
								);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->ConvertCurrency($PayPalRequestData);

		return $PayPalResult;
	}
}
?>