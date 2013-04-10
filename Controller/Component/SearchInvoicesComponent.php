<?php
/**
 * SearchInvoicesComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class SearchInvoicesComponent extends Component {
	
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
		$SearchInvoicesFields = array(
									'MerchantEmail' => '', 			// Required.  Email address of invoice creator.
									'Page' => '', 					// Required.  Page number of result set, starting with 1
									'PageSize' => ''				// Required.  Number of result pages, between 1 and 100
									);

		$Parameters = array(
							'Email' => '', 															// Email search string
							'RecipientName' => '', 													// Recipient search string
							'BusinessName' => '', 													// Company search string
							'InvoiceNumber' => '', 													// Invoice number search string
							'Status' => '', 														// Invoice status search
							'LowerAmount' => '', 													// Invoice amount search.  It specifies the smallest amount to be returned.  If you pass a value for this field, you must also pass a CurrencyCode value.
							'UpperAmount' => '', 													// Invoice amount search.  It specifies the largest amount to be returned.  If you pass a value for this field, you must also pass a CurrencyCode value.
							'CurrencyCode' => '', 													// Currency used for lower and upper amounts.  
							'Memo' => '', 															// Invoice memo search string
							'Origin' => '', 														// Indicates whether the invoice was created by the website or by an API call.  Values are:  Web, API
							'InvoiceDate' => array('StartDate' => '', 'EndDate' => ''), 			// Invoice date range filter
							'DueDate' => array('StartDate' => '', 'EndDate' => ''), 				// Invoice due Date range filter
							'PaymentDate' => array('StartDate' => '', 'EndDate' => ''), 			// Invoice payment date range filter.
							'CreationDate' => array('StartDate' => '', 'EndDate' => '')				// Invoice creation date range filter.
							);

		$PayPalRequestData = array(
								   'SearchInvoicesFields' => $SearchInvoicesFields, 
								   'Parameters' => $Parameters
								   );

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->SearchInvoices($PayPalRequestData);

		return $PayPalResult;
	}
}
?>