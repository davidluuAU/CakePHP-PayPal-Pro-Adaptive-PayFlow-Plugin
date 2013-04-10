<?php
/**
 * SetFundingSourceConfirmedComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class SetFundingSourceConfirmedComponent extends Component {
	
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
		$SetFundingSourceConfirmedFields = array(
												'AccountID' => '', 													// The ID number of the PayPal account for which a bank account is added.  You must specify either AccountID or EmailAddress for this request.
												'EmailAddress' => '', 												// The email address of the PayPal account holder.  You must specify either AccountID or EmailAddress.
												'FundingSourceKey' => ''											// The funding source key reeturned in the AddBankAccount or AddPaymentCard response.
												);

		$PayPalRequestData = array('SetFundingSourceConfirmedFields' => $SetFundingSourceConfirmedFields);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->SetFundingSourceConfirmed($PayPalRequestData);

		return $PayPalResult;
	}
}
?>