<?php
/**
 * 	CakePHP PayPal Adaptive Payments Class
 *	An open source PHP library written to easily work with PayPal's API's
 *
 *  This library was created by David Luu and adapted from the work done by 
 *  Andrew K. Angell
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 * @author			David Luu
 * @updated			10.04.2013
 * @filesource
 */

class Paypal_Config {
	
	
	/** 
	 * Sandbox Mode - TRUE/FALSE
	 */
	public $sandbox = TRUE;
	public $domain = null;
	
	/**
	 * API Credentials
	 */
	public $api_version = '95.0';
	public $developer_account_email = 'dave@example.com';		// This is what you use to sign in to http://developer.paypal.com.  Only required for Adaptive Payments.
	
	public $application_id = null;	// Only required for Adaptive Payments.  You get your Live ID when your application is approved by PayPal.	
	public $api_username = null;
	public $api_password = null;
	public $api_signature = null;
	public $payflow_username = null;
	public $payflow_password = null;
	public $payflow_vendor = null;
	public $payflow_partner = null;
	
	/**
	 * Third Party User Values
	 * These can be setup here or within each caller directly when setting up the PayPal object.
	 */
	public $api_subject = '';	// If making calls on behalf a third party, their PayPal email address or account ID goes here.
	public $device_id = '';
	public $device_ip_address = null;
	
	public function Paypal_Config() {
		
		$this->domain = $this->sandbox ? 'http://localhost/' : 'http://www.example.com/';
		$this->application_id = $this->sandbox ? 'APP-80W284485P519543T' : '';	// Only required for Adaptive Payments.  You get your Live ID when your application is approved by PayPal.
		$this->api_username = $this->sandbox ? 'SANDBOX_API_USERNAME' : 'LIVE_API_USERNAME';
		$this->api_password = $this->sandbox ? 'SANDBOX_API_PASSWORD' : 'LIVE_API_PASSWORD';
		$this->api_signature = $this->sandbox ? 'SANDBOX_API_SIGNATURE' : 'LIVE_API_SIGNATURE';
		$this->payflow_username = $this->sandbox ? 'SANDBOX_USERNAME' : 'LIVE_USERNAME';
		$this->payflow_password = $this->sandbox ? 'SANDBOX_PASSWORD' : 'LIVE_PASSWORD';
		$this->payflow_vendor = $this->sandbox ? 'SANDBOX_VENDOR' : 'LIVE_VENDOR';
		$this->payflow_partner = $this->sandbox ? 'SANDBOX_PARTNER' : 'LIVE_PARTNER';
		
		$this->device_ip_address = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "";
		
		/**
		 * Timezone Setting
		 */
		date_default_timezone_set('America/Chicago');
	
		/**
		  * Enable Sessions
		  */
		if (!session_id()) 
			session_start();
	
	
		/**
		 * Enable error reporting if running in sandbox mode.
		 */
		if($this->sandbox)
		{
			error_reporting(E_ALL);
			ini_set('display_errors', '1');	
		}
	
	}
}

?>