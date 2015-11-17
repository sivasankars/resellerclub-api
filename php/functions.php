<?php
class ResellerClubAPI {
	
	// Configuration Of Reseller Club API
	public $api_user_id = "xxxxxx";
	public $api_key = "yyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy";
	
	// List of TDL's - TLDs for which the domain name availability needs to be checked
	public $tlds_list = array("com", "net", "in", "biz", "org", "asia");
	
	//Variable Declaration
	public $domainname;

	//Constructor
	public function __construct()
    {
		if(isset($_POST['domain'])){
		$this->domainname = preg_replace('/[\s-]+/', '-', substr(trim($_POST['domain']), 0, 253) );
		}
	}
	
	//Get Domain Availability ResellerClub API
	public function DomainAvailability()
	{	
	$tld = "";
	foreach($this->tlds_list as $arrayitem)	{ $tld.= '&tlds=' . $arrayitem;	}
	$url = 'https://test.httpapi.com/api/domains/available.json?auth-userid=' . $this->api_user_id . '&api-key=' . $this->api_key . '&domain-name=' . $this->domainname . $tld . '&suggest-alternative=true';
	
	if ($data) $url = sprintf("%s?%s", $url, http_build_query($data));
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$apidata = curl_exec($curl);
	
	$apidata_json = json_decode($apidata, TRUE);
	return $apidata_json;
	}
	public function FormValidation()
	{
		if (isset($_POST['check']) && preg_match('/^[a-z0-9\-]+$/i', $this->domainname)&& isset($_POST['domain']) != "" && $this->tlds_list) { return true; }
	    else { return false; }
	
	}
	}
	$api = new ResellerClubAPI;