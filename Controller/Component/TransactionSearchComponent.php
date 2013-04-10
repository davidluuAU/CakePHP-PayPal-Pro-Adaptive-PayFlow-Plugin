<?php
/**
 * TransactionSearchComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class TransactionSearchComponent extends Component {
	
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
		$TSFields = array(
							'startdate' => '', 							// Required.  The earliest transaction date you want returned.  Must be in UTC/GMT format.  2008-08-30T05:00:00.00Z
							'enddate' => '', 							// The latest transaction date you want to be included.
							'email' => '', 								// Search by the buyer's email address.
							'receiver' => '', 							// Search by the receiver's email address.  
							'receiptid' => '', 							// Search by the PayPal account optional receipt ID.
							'transactionid' => '', 						// Search by the PayPal transaction ID.
							'invnum' => '', 							// Search by your custom invoice or tracking number.
							'acct' => '', 								// Search by a credit card number, as set by you in your original transaction.  
							'auctionitemnumber' => '', 					// Search by auction item number.
							'transactionclass' => '', 					// Search by classification of transaction.  Possible values are: All, Sent, Received, MassPay, MoneyRequest, FundsAdded, FundsWithdrawn, Referral, Fee, Subscription, Dividend, Billpay, Refund, CurrencyConversions, BalanceTransfer, Reversal, Shipping, BalanceAffecting, ECheck
							'amt' => '', 								// Search by transaction amount.
							'currencycode' => '', 						// Search by currency code.
							'status' => '',  							// Search by transaction status.  Possible values: Pending, Processing, Success, Denied, Reversed
							'profileid' => ''							// Recurring Payments profile ID.  Currently undocumented but has tested to work.
						);
				
		$PayerName = array(
							'salutation' => '', 						// Search by payer's salutation.
							'firstname' => '', 							// Search by payer's first name.
							'middlename' => '', 						// Search by payer's middle name.
							'lastname' => '', 							// Search by payer's last name.
							'suffix' => ''	 							// Search by payer's suffix.
						);
				
		$PayPalRequestData = array(
								'TSFields' => $TSFields, 
								'PayerName' => $PayerName
								);

		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->TransactionSearch($PayPalRequestData);

		return $PayPalResult;
	}
}
?>