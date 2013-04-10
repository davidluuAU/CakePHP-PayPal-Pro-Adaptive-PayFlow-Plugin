<?php
/**
 * ManageRecurringPaymentsProfileStatusComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class ManageRecurringPaymentsProfileStatusComponent extends Component {
	
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
		$MRPPSFields = array(
							'profileid' => '', 				// Required. Recurring payments profile ID returned from CreateRecurring...
							'action' => '', 				// Required. The action to be performed.  Mest be: Cancel, Suspend, Reactivate
							'note' => ''					// The reason for the change in status.  For express checkout the message will be included in email to buyers.  Can also be seen in both accounts in the status history.
							);
					
		$PayPalRequestData = array('MRPPSFields'=>$MRPPSFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->ManageRecurringPaymentsProfileStatus($PayPalRequestData);

		return $PayPalResult;
	}


}