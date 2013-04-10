<?php
/**
 * BMButtonSearchComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class BMButtonSearchComponent extends Component {
	
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
		$BMButtonSearchFields = array
								(
								'startdate' => '', 			// Required.  Starting date for the search.  UTC/GMT format: 2009-08-24T05:38:48Z
								'enddate' => ''				// Ending date for the search.  UTC/GMT format: 2010-05-01T05:38:48Z  
								);
				
		$PayPalRequestData = array('BMButtonSearchFields'=>$BMButtonSearchFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->BMButtonSearch($PayPalRequestData);

		return $PayPalResult;
	}
}
?>