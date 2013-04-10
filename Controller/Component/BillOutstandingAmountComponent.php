<?php
/**
 * BillOutstandingAmountComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class BillOutstandingAmountComponent extends Component {
	
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
		$BOAFields = array(
						   'profileid' => '', 				// Required.  Recurring payments profile ID returned from CreateRecurringPaymentsProfile.
						   'amt' => '', 					// The amount to bill.  Must be less than or equal to the current oustanding balance.  Default is to collect entire amount.
						   'note' => ''						// Note about the reason for the non-scheduled payment.  EC profiles will show this message in the email notification to the buyer and can be seen in the details page by both buyer and seller.
						   );
				   
		$PayPalRequestData = array('BOAFields'=>$BOAFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->BillOutstandingAmount($PayPalRequestData);

		return $PayPalResult;
	}
}
?>