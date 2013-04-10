<?php
/**
 * GetBasicPersonalDataComponent
 *
 * @author David Luu
 * @link http://github.com/whatsthegoss
 */

// Include required library files.
App::import('Vendor', 'Paypal.Paypal_Config');
App::import('Vendor', 'Paypal.Paypal');

class GetBasicPersonalDataComponent extends Component {
	
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
		$AttributeList = array(
								'http://axschema.org/namePerson/first',
								'http://axschema.org/namePerson/last',
								'http://axschema.org/contact/email',
								'http://axschema.org/contact/fullname',
								'http://openid.net/schema/company/name',
								'http://axschema.org/contact/country/home',
								'https://www.paypal.com/webapps/auth/schema/payerID'
							);
					
		// Pass data into class for processing with PayPal and load the response array into $PayPalResult
		$PayPalResult = $PayPal->GetBasicPersonalData($AttributeList);

		return $PayPalResult;
	}
}
?>