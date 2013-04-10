<?php
/**
 * RequestPermissionsComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class RequestPermissionsComponent extends Component {
	
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
		$Scope = array(
						'EXPRESS_CHECKOUT', 
						'DIRECT_PAYMENT', 
						'SETTLEMENT_CONSOLIDATION', 
						'SETTLEMENT_REPORTING', 
						'AUTH_CAPTURE', 
						'MOBILE_CHECKOUT', 
						'BILLING_AGREEMENT', 
						'REFERENCE_TRANSACTION', 
						'AIR_TRAVEL', 
						'MASS_PAY', 
						'TRANSACTION_DETAILS',
						'TRANSACTION_SEARCH',
						'RECURRING_PAYMENTS',
						'ACCOUNT_BALANCE',
						'ENCRYPTED_WEBSITE_PAYMENTS',
						'REFUND',
						'NON_REFERENCED_CREDIT',
						'BUTTON_MANAGER',
						'MANAGE_PENDING_TRANSACTION_STATUS',
						'RECURRING_PAYMENT_REPORT',
						'EXTENDED_PRO_PROCESSING_REPORT',
						'EXCEPTION_PROCESSING_REPORT',
						'ACCOUNT_MANAGEMENT_PERMISSIONS',
						'ACCESS_BASIC_PERSONAL_DATA',
						'ACCESS_ADVANCED_PERSONAL_DATA'
						);

		$RequestPermissionsFields = array(
										'Scope' => $Scope, 				// Required.   
										'Callback' => ''			// Required.  Your callback function that specifies actions to take after the account holder grants or denies the request.
										);
								
		$PayPalRequestData = array('RequestPermissionsFields');

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->RequestPermissions($PayPalRequestData);

		return $PayPalResult;
	}
}
?>