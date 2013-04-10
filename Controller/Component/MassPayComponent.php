<?php
/**
 * MassPayComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class MassPayComponent extends Component {
	
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
		$MPFields = array(
							'emailsubject' => '', 						// The subject line of the email that PayPal sends when the transaction is completed.  Same for all recipients.  255 char max.
							'currencycode' => '', 						// Three-letter currency code.
							'receivertype' => '' 						// Indicates how you identify the recipients of payments in this call to MassPay.  Must be EmailAddress or UserID
						);

		// Typically, you'll loop through some sort of records to build your MPItems array. 
		// Here I simply include 3 items individually.  

		$Item1 = array(
							'l_email' => '', 							// Required.  Email address of recipient.  You must specify either L_EMAIL or L_RECEIVERID but you must not mix the two.
							'l_receiverid' => '', 						// Required.  ReceiverID of recipient.  Must specify this or email address, but not both.
							'l_amt' => '', 								// Required.  Payment amount.
							'l_uniqueid' => '', 						// Transaction-specific ID number for tracking in an accounting system.
							'l_note' => '' 								// Custom note for each recipient.
					);
			
		$Item2 = array(
							'l_email' => '', 							// Required.  Email address of recipient.  You must specify either L_EMAIL or L_RECEIVERID but you must not mix the two.
							'l_receiverid' => '', 						// Required.  ReceiverID of recipient.  Must specify this or email address, but not both.
							'l_amt' => '', 								// Required.  Payment amount.
							'l_uniqueid' => '', 						// Transaction-specific ID number for tracking in an accounting system.
							'l_note' => '' 								// Custom note for each recipient.
					);
			
		$Item3 = array(
							'l_email' => '', 							// Required.  Email address of recipient.  You must specify either L_EMAIL or L_RECEIVERID but you must not mix the two.
							'l_receiverid' => '', 						// Required.  ReceiverID of recipient.  Must specify this or email address, but not both.
							'l_amt' => '', 								// Required.  Payment amount.
							'l_uniqueid' => '', 						// Transaction-specific ID number for tracking in an accounting system.
							'l_note' => '' 								// Custom note for each recipient.
					);
									
		$MPItems = array($Item1, $Item2, $Item3);  // etc

		$PayPalRequestData = array('MPFields'=>$MPFields, 'MPItems' => $MPFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->MassPay($PayPalRequestData);

		return $PayPalResult;
	}
}
?>