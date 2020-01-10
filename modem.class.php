<?php

Namespace Manoaratefy\NetworkTools;

use Carbon\CarbonInterval;

class Modem{
    private $host, $username, $password, $SesInfo, $TokInfo, $password_type, $RequestVerificationTokenone, $RequestVerificationTokentwo;

    public function __construct($host = '192.168.8.1', $username = 'admin', $password) {
		$this->host = $host;
		$this->username = $username;
        $this->password = $password;

        $ch = curl_init('http://'.$this->host.'/api/webserver/SesTokInfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        $this->SesInfo = $response->SesInfo;
        $this->TokInfo = $response->TokInfo;
    }
    
    public function online($timeout = 1) {
		$sys = $this->getSystem();
		switch ($sys) {
			case "win":
				$cmd = "ping -n 1 -w ".($timeout * 100)." ".$this->host;
				break;
			case "mac":
				$cmd = "ping -c 1 -t ".$timeout." ".$this->host." 2> /dev/null";
				break;
			case "lnx":
				$cmd = "sudo ping -c 1 -W ".$timeout." ".$this->host." 2> /dev/null";
				break;
			default:
				return false;
		}
		$res = exec($cmd, $out, $ret);

		if ($ret == 0) {
			$ch = curl_init('http://'.$this->host.'/html/index.html');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$res = curl_exec($ch);
			curl_close($ch);

			return (strstr($res, 'hilink')) ? true : false;
		}

		return false;
    }

    public function SoftwareVersion(){
        $ch = curl_init('http://'.$this->host.'/api/device/basic_information');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->SoftwareVersion;
    }

    public function WebUIVersion(){
        $ch = curl_init('http://'.$this->host.'/api/device/basic_information');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->WebUIVersion;
    }

    public function CurrentConnectTime(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/traffic-statistics');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        $connectTime = CarbonInterval::seconds($response->CurrentConnectTime)->cascade();

        return $connectTime;
    }

    public function CurrentUpload(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/traffic-statistics');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->CurrentUpload;
    }

    public function CurrentDownload(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/traffic-statistics');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->CurrentDownload;
    }

    public function CurrentUploadRate(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/traffic-statistics');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->CurrentUploadRate;
    }

    public function CurrentDownloadRate(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/traffic-statistics');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->CurrentDownloadRate;
    }

    public function TotalUpload(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/traffic-statistics');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->TotalUpload;
    }

    public function TotalDownload(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/traffic-statistics');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->TotalDownload;
    }

    public function TotalConnectTime(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/traffic-statistics');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        $connectTime = CarbonInterval::seconds($response->TotalConnectTime)->cascade();

        return $connectTime;
    }

    public function PLMNFull(){
        $ch = curl_init('http://'.$this->host.'/api/net/current-plmn');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->FullName;
    }

    public function PLMNShort(){
        $ch = curl_init('http://'.$this->host.'/api/net/current-plmn');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->ShortName;
    }

    public function PLMNNumeric(){
        $ch = curl_init('http://'.$this->host.'/api/net/current-plmn');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->Numeric;
    }

    public function SignalStrength(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/status');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->SignalIcon;
    }

    public function GSMNetwork(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/status');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);

        switch ($response->CurrentNetworkType){
			case "3": return "2G";
			case "4": return "3G";
			case "7": return "3G+";
            case "19": return '4G';
            default: return $response->CurrentNetworkType;
        }
    }

    public function PrimaryDns(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/status');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->PrimaryDns;
    }

    public function SecondaryDns(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/status');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->SecondaryDns;
    }

    public function PrimaryIPv6Dns(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/status');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->PrimaryIPv6Dns;
    }

    public function SecondaryIPv6Dns(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/status');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->SecondaryIPv6Dns;
    }

    public function CurrentWifiUser(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/status');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->CurrentWifiUser;
    }

    public function TotalWifiUser(){
        $ch = curl_init('http://'.$this->host.'/api/monitoring/status');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->TotalWifiUser;
    }

    private function islogged(){
        $ch = curl_init('http://'.$this->host.'/api/user/state-login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        $this->password_type = $response->password_type;
        return ($response->State == '-1') ? false : true;
    }

    private function login(){
        if($this->password_type == '4') {
            $password = base64_encode(hash('sha256', $this->username .
            base64_encode(hash('sha256', $this->password)) .
                                             $this->TokInfo));
        } else {
            $password = base64_encode($this->password);
        }

		$req = new \SimpleXMLElement('<request></request>');
		$req->addChild('Username', $this->username);
		$req->addChild('Password', $password);
		$req->addChild('password_type', $this->password_type);

        $ch = curl_init('http://'.$this->host.'/api/user/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->TokInfo,
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req->asXML());
        curl_setopt($ch, CURLOPT_HEADER, 1);

        $res = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($res, 0, $header_size);
        $body = substr($res, $header_size);

        curl_close($ch);

        $result = preg_grep('/^__RequestVerificationTokenone:\s*([^;]*)/mi', explode("\n", $header));
        foreach($result as $item){
            $this->RequestVerificationTokenone = explode(':', $item)[1];
        }

        $result = preg_grep('/^__RequestVerificationTokentwo:\s*([^;]*)/mi', explode("\n", $header));
        foreach($result as $item){
            $this->RequestVerificationTokentwo = explode(':', $item)[1];
        }

        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $header, $matches);
        foreach($matches[1] as $item){
            $this->SesInfo = $item;
        }

        $response = new \SimpleXMLElement($body);

        return ($response == 'OK') ? true : false;
    }

    public function smscount(){
        if(!$this->islogged()) $this->login();

        $ch = curl_init('http://'.$this->host.'/api/sms/sms-count');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->gettoken(),
            'X-Requested-With: XMLHttpRequest',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->LocalInbox;
    }

    // type : 1 = inbox, 2 = sent
    public function smsread($page = 1, $type = 1){
        if(!$this->islogged()) $this->login();

		$req = new \SimpleXMLElement('<request></request>');
		$req->addChild('PageIndex', $page);
		$req->addChild('ReadCount', 1);
		$req->addChild('BoxType', $type);
		$req->addChild('SortType', 0);
		$req->addChild('Ascending', 0);
        $req->addChild('UnreadPreferred', 0);

        $ch = curl_init('http://'.$this->host.'/api/sms/sms-list');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->gettoken(),
            'X-Requested-With: XMLHttpRequest',
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req->asXML());
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return $response->Messages->Message;
    }

    public function smssend($number, $message){
        if(!$this->islogged()) $this->login();

		$req = new \SimpleXMLElement('<request></request>');
		$req->addChild('Index', -1);
		$req->addChild('Phones', '');
		$req->Phones->addChild('Phone', $number);
		$req->addChild('Sca', ' ');
		$req->addChild('Content', $message);
		$req->addChild('Length', strlen($message));
        $req->addChild('Reserved', 1);
        $req->addChild('Date', 1);

        $ch = curl_init('http://'.$this->host.'/api/sms/send-sms');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->gettoken(),
            'X-Requested-With: XMLHttpRequest',
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req->asXML());
        $res = curl_exec($ch);
        curl_close($ch);

        return ($response == 'OK') ? false : true;
    }

    public function smsdelete($index){
        if(!$this->islogged()) $this->login();

		$req = new \SimpleXMLElement('<request></request>');

		if (is_array($index)) {
			for ($i = 0; $i < count($index); $i++)
					$req->addChild('Index', $index[$i]);
		} else {
			$req->addChild('Index', $index);
		}

        $ch = curl_init('http://'.$this->host.'/api/sms/delete-sms');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            '__RequestVerificationToken: '.$this->gettoken(),
            'X-Requested-With: XMLHttpRequest',
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req->asXML());
        $res = curl_exec($ch);
        curl_close($ch);

        $response = new \SimpleXMLElement($res);
        return ($response == 'OK') ? false : true;
    }

    private function gettoken(){
        $ch = curl_init('http://'.$this->host.'/api/webserver/SesTokInfo');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $this->SesInfo);
        $res = curl_exec($ch);
        curl_close($ch);

        $token = new \SimpleXMLElement($res);
        return $token->TokInfo;
    }

	private function getSystem() {
		if (substr(__DIR__,0,1) == '/') {
			return (exec('uname') == 'Darwin') ? 'mac' : 'lnx';
		} else {
			return 'win';
		}
	}
}