<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Oauthfacebook {
	public $ConsumerKey = "";
	public $ConsumerSecret = "";
	public $CallbackUrl = "";
	public $Token = "";

	private $AuthorizeUrl = "https://graph.facebook.com/oauth/authorize";
	private $AccessTokenUrl = "https://graph.facebook.com/oauth/access_token";
	
	public function AuthorizationLinkGet() {
		return $this->AuthorizeUrl."?client_id=".$this->ConsumerKey."&redirect_uri=".$this->CallbackUrl."&scope=publish_stream,offline_access,manage_pages";
	}
	
	public function AccessTokenGet($authToken) {
		$accessTokenUrl = $this->AccessTokenUrl."?client_id=".$this->ConsumerKey."&redirect_uri=".$this->CallbackUrl."&client_secret=".$this->ConsumerSecret."&code=".$authToken;

		$response = $this->WebRequest("get", $accessTokenUrl, "");

		parse_str($response, $data);
		
		if ($data["access_token"])
			$this->Token = $data["access_token"];
	}
	
	public function ExchangeAccessTokenGet($authToken) {
		$accessTokenUrl = $this->AccessTokenUrl."?client_id=".$this->ConsumerKey."&client_secret=".$this->ConsumerSecret."&grant_type=fb_exchange_token&fb_exchange_token=".$authToken;

		$response = $this->WebRequest("get", $accessTokenUrl, "");
		
		parse_str($response, $data);
		
		if ($data["access_token"])
			$this->Token = $data["access_token"];
	}
	
	public function WebRequest($method, $url, $postData) {
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
		if ($method == "post") {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		$data = curl_exec($ch);		
		curl_close($ch);
		return $data;
	}
}
?>