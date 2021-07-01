<?php

class Earn{
  public $url="https://earning.company/earn_real_cash/";
  public $uries="kakatoji";
  public $master="kakatoji";
  public function __construct(){
      $this->api=[
        "sign"       => "user_signup.php",
        "inputReff"  => "refer_submit.php",
        "cekUser"    => "check_user.php",
        "homePage"   => "homepage_data_get.php",
        "daily"      => "daily_check_data_add.php",
        "spinAdd"    => "spin_imp_amount_add.php",
        "scrath"     => "scratch_imp_amount_add.php",
        "math"       => "math_imp_amount_add.php",
        "watch"      => "watch_imp_amount_add.php",
        "captcha"    => "captcha_imp_amount_add.php",
        "withd"      => "withdraw_data_store.php"
        ];
  }
  public function curl($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        if($post){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($httpheader){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        }
        if($proxy){
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            // curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            curl_close($ch);
            return array($header, $body);
        }
    }
  public function intRandom($size){
        $validCharacters = utf8_decode("0123456789");
        $validCharNumber = strlen($validCharacters);
        $int = '';
        while (strlen($int) < $size) {
            $index = mt_rand(0, $validCharNumber - 1);
            $int .= $validCharacters[$index];
        }
        return $int;
    }
  public function imeiRandom(){
        $code = $this->intRandom(14);
        $position = 0;
        $total = 0;
        while ($position < 14) {
            if ($position % 2 == 0) {
                $prod = 1;
            } else {
                $prod = 2;
            }
            $actualNum = $prod * $code[$position];
            if ($actualNum > 9) {
                $strNum = strval($actualNum);
                $total += $strNum[0] + $strNum[1];
            } else {
                $total += $actualNum;
            }
            $position++;
        }
        $last = 10 - ($total % 10);
        if ($last == 10) {
            $imei = $code . 0;
        } else {
            $imei = $code . $last;
        }
        return $imei;
    }
  public function head(){
    $h[]="Content-Type: application/x-www-form-urlencoded; charset=UTF-8";
    $h[]="User-Agent: Dalvik/2.1.0 (Linux; U; Android 7.0; Redmi Note 4 MIUI/V11.0.2.0.NCFMIXM)";
    $h[]="Host: earning.company";
    return $h;}
  public function sginup($mei,$user,$email,$api,$id){
    $url=$this->url.$this->api["sign"];
    $data=http_build_query(array("android_imie"=>$mei,"android_name"=>$user,"android_email"=>$email,"android_api"=>$api,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}
  public function reffer($reff,$api,$mail,$id){
    $url=$this->url.$this->api['inputReff'];
    $data=http_build_query(array("android_refer"=>$reff,"android_api"=>$api,"android_email"=>$mail,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}
  public function daily($api,$id){
    $url=$this->url.$this->api['daily'];
    $data=http_build_query(array("android_api"=>$api,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}
  public function cekUser($email,$api){
    $url=$this->url.$this->api['cekUser'];
    $data=http_build_query(array("android_email"=>$email,"android_api"=>$api));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}
  public function homePage($api,$id){
    $url=$this->url.$this->api['homePage'];
    $data=http_build_query(array("android_api"=>$api,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}
  public function spin($am,$api,$id){
    $url=$this->url.$this->api['spinAdd'];
    $data=http_build_query(array("android_amount"=>$am,"android_api"=>$api,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}
  public function scrath($am,$api,$id){
    $url=$this->url.$this->api['scrath'];
    $data=http_build_query(array("android_amount"=>$am,"android_api"=>$api,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}  
  public function match($api,$id){
    $url=$this->url.$this->api['math'];
    $data=http_build_query(array("android_api"=>$api,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}  
  public function watch($api,$id){
    $url=$this->url.$this->api['watch'];
    $data=http_build_query(array("android_api"=>$api,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}   
  public function captcha($api,$id){
    $url=$this->url.$this->api['captcha'];
    $data=http_build_query(array("android_api"=>$api,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}
  public function withDraw($user,$api,$paypal,$email,$mtd,$id){
    $url=$this->url.$this->api['withd'];
    $data=http_build_query(array("android_name"=>$user,"android_api"=>$api,"android_method_no"=>$paypal,"android_email"=>$email,"android_method"=>$mtd,"android_id"=>$id));
    return json_decode($this->curl($url,$data,$this->head())[1],1);}
  public function save($data,$data_post){
    if(!file_get_contents($data)){
      file_put_contents($data,"[]");}
    $json=json_decode(file_get_contents($data),1);
    $arr=array_merge($json,$data_post);
    file_put_contents($data,json_encode($arr,JSON_PRETTY_PRINT));} 
  public function col($str,$color){
   $warna=array('x'=>"\033[0m",'p'=>"\033[1;37m",'a'=>"\033[1;30m",'m'=>"\033[1;31m",'h'=>"\033[1;32m",'k'=>"\033[1;33m",'b'=>"\033[1;34m",'u'=>"\033[1;35m",'c'=>"\033[1;36m",'px'=>"\033[1;7m",'mp'=>"\033[1;41m",'hp'=>"\033[1;42m",'kp'=>"\033[1;43m",'bp'=>"\033[1;44m",'up'=>"\033[1;45m",'cp'=>"\033[1;46m",'pp'=>"\033[1;47m",'ap'=>"\033[1;100m",'pm'=>"\033[7;41m",);return $warna[$color].$str."\033[0m";}

  public function ban($msg=null)
{
  $bn="
  
\e[1;31m██╗  ██╗ █████╗ ██╗  ██╗ █████╗ ████████╗ ██████╗      ██╗██╗
██║ ██╔╝██╔══██╗██║ ██╔╝██╔══██╗╚══██╔══╝██╔═══██╗     ██║██║
█████╔╝ ███████║█████╔╝ ███████║   ██║   ██║ \e[1;37m  ██║     ██║██║
██╔═██╗ ██╔══██║██╔═██╗ ██╔══██║   ██║   ██║   ██║██   ██║██║
██║  ██╗██║  ██║██║  ██╗██║  ██║   ██║   ╚██████╔╝╚█████╔╝██║
╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝    ╚═════╝  ╚════╝ ╚═╝
   \e[0m\n";
   $_b=mb_convert_encoding('&#x2591;', 'UTF-8', 'HTML-ENTITIES');
  echo $bn;
  echo $this->col(strtoupper(" author:"),"mp")." ".$this->col(strtoupper("kakatoji"),"c")."\n";
  echo $this->col(strtoupper("youtube:"),"mp")." ".$this->col(strtoupper("bit.ly/2US5PFY"),"k")."\n";
  if($msg){
    echo $this->col(strtoupper(" script:"),"mp")." ".$this->col(strtoupper($msg),"u")."\n";}
  echo str_repeat($_b,61)."\n";
}
public function timer($data,$txt=null,$text1=null,$text2=null){
  $an=strtoupper($text1);$na=strtoupper($text2);
  $one=$this->col($text1,"px").$this->col($text2,"mp");
  $two=$this->col($text1,"hp").$this->col($text2,"kp");
  $tree=$this->col($text1,"bp").$this->col($text2,"up");
  $for=$this->col($text1,"cp").$this->col($text2,"px");
  $five=$this->col($text1,"mp").$this->col($text2,"ap");
  $wkt = gmdate('H:i:s', $data);
  if ($wkt[7]>0){
    for ($d2=$wkt[7]-1;$d2>-1;$d2--){
      echo "\r\033[1;32m» \033[0;36m$txt \033[0m".$wkt[0].$wkt[1].":".$wkt[3].$wkt[4].":".$wkt[6].$d2." \033[0;33m~>\033[0;35m";
       if ($d2 == 9 or $d2 == 4){echo $one;}
       if ($d2 == 8 or $d2 == 3){echo $two;}
       if ($d2 == 7 or $d2 == 2){echo $tree;}
       if ($d2 == 6 or $d2 == 1){echo $for;}
       if ($d2 == 5 or $d2 == 0){echo $five;}
       sleep(1);echo "\r                                                  \r";}
  }
  if ($wkt[6]>0){
    for ($d1=$wkt[6]-1;$d1>-1;$d1--){for ($d2=9;$d2>-1;$d2--){
      echo "\r\033[1;32m» \033[0;36m$txt \033[0m".$wkt[0].$wkt[1].":".$wkt[3].$wkt[4].":".$d1.$d2." \033[0;33m~>\033[0;35m";
      if ($d2 == 9 or $d2 == 4){echo $one;}
      if ($d2 == 8 or $d2 == 3){echo $two;}
      if ($d2 == 7 or $d2 == 2){echo $tree;}
      if ($d2 == 6 or $d2 == 1){echo $for;}
      if ($d2 == 5 or $d2 == 0){echo $five;}
      sleep(1);echo "\r                                                  \r";}}
  }
  if ($wkt[4] >0){
    for ($m2=$wkt[4]-1;$m2>-1;$m2--){for ($d1=5;$d1>-1;$d1--){for ($d2=9;$d2>-1;$d2--){
      echo "\r\033[1;32m» \033[0;36m$txt \033[0m".$wkt[0].$wkt[1].":".$wkt[3].$m2.":".$d1.$d2." \033[0;33m~>\033[0;35m";
      if ($d2 == 9 or $d2 == 4){echo $one;}
      if ($d2 == 8 or $d2 == 3){echo $two;}
      if ($d2 == 7 or $d2 == 2){echo $tree;}
      if ($d2 == 6 or $d2 == 1){echo $for;}
      if ($d2 == 5 or $d2 == 0){echo $five;}
      sleep(1);echo "\r                                                  \r";}}}
  }
  if ($wkt[3]>0){
    for ($m1=$wkt[3]-1;$m1>-1;$m1--){for ($m2=9;$m2>-1;$m2--){for ($d1=5;$d1>-1;$d1--){for ($d2=9;$d2>-1;$d2--){
      echo "\r\033[1;32m» \033[0;36m$txt \033[0m".$wkt[0].$wkt[1].":".$m1.$m2.":".$d1.$d2." \033[0;33m~>\033[0;35m";
      if ($d2 == 9 or $d2 == 4){echo $one;}
      if ($d2 == 8 or $d2 == 3){echo $two;}
      if ($d2 == 7 or $d2 == 2){echo $tree;}
      if ($d2 == 6 or $d2 == 1){echo $for;}
      if ($d2 == 5 or $d2 == 0){echo $five;}
     sleep(1);echo "\r                                                  \r";}}}}
  }
  if ($wkt[1]>0){
    for ($j=$wkt[1]-1;$j>-1;$j--){for ($m1=5;$m1>-1;$m1--){for ($m2=9;$m2>-1;$m2--){for ($d1=5;$d1>-1;$d1--){for ($d2=9;$d2>-1;$d2--){
      echo "\r\033[1;32m» \033[0;36m$txt \033[0m".$wkt[0].$j.":".$m1.$m2.":".$d1.$d2." \033[0;33m~>\033[0;35m";
      if ($d2 == 9 or $d2 == 4){echo $one;}
      if ($d2 == 8 or $d2 == 3){echo $two;}
      if ($d2 == 7 or $d2 == 2){echo $tree;}
      if ($d2 == 6 or $d2 == 1){echo $for;}
      if ($d2 == 5 or $d2 == 0){echo $five;}
      sleep(1);echo "\r                                                  \r";}}}}}
  }
 }
 public function menu($no,$txt){
   echo $this->col("[","p").$this->col($no,"h").$this->col("]","p")." ".$this->col(strtoupper($txt),"c")."\n";
 }
 public function name(){
    $url="https://randomuser.me/api/?format=json";
    $data=json_decode(file_get_contents($url),1);
    return $data;}
}
class kakatoji extends Earn{
  public function cekfile($data=null){
    if(!file_exists($data)){
      echo self::col(strtoupper(" ini contoh api 55555 anda juga bisa menginput secara acak"),"px")."\n";
      $u=readline(self::col(" Email: ","m"));
      $ap=readline(self::col(" Api: ","m"));
      $da=["email"=>$u,"android_api"=>$ap];
      self::save($data,$da);
      if(is_file($data)){
        echo self::col(strtoupper(" sukses save akun "),"h");
        self::timer(4,"sukses save Akun","jangan lupa","tetep sambil ngopi");
        system("clear");
      }
    }
  }
  public function _run(){
    $clear=shell_exec('clear');
    if(!file_exists("user.json")){
    self::ban("earn 2021");
    self::cekfile("user.json");}
    echo $clear;
    self::ban("earn 2021");
    $data=json_decode(file_get_contents("user.json"));
    self::menu(1," exsekusi your akun");
    self::menu(2," add new user");
    self::menu(3," menu withdrawl");
    $menu=readline(self::col(strtoupper("pilih:"),"mp") );
    switch ($menu) {
      case 1:
        //eksekusi akun utama
        while(true):
        $login=self::cekUser($data->email,$data->android_api);
        $Home=self::homePage($data->android_api,$login['android_id']);
        $spin=self::spin(10,$data->android_api,$login['android_id']);
        $scr=self::scrath(10,$data->android_api,$login['android_id']);
        $match=self::match($data->android_api,$login['android_id']);
        $watch=self::watch($data->android_api,$login['android_id']);
        $cap=self::captcha($data->android_api,$login['android_id']);
        #print_r($login);die();
        if($spin['error'] == true &&  $watch['error'] == true && $cap['error'] == true && $scr['error'] == true){
          echo self::col(strtoupper("updatae balance"),"up")." => ".self::col($Home['android_amount'],"c")." ~> ".self::col(strtoupper("claim all task"),"mp")."\n";
          self::timer(5,"prosess","selamat","pagi");
          continue;
        }
        endwhile;
        
        break;
      
      case 2:
        //auto refferall
        echo $clear;
        self::ban("earn 2021");
        self::menu(1,"auto reff");
        self::menu(2,"run akun reff");
        $menu=readline(self::col("pilih: ","m"));
      switch($menu){
       case 1;
        while(1):
        $log=self::cekUser($data->email,$data->android_api);
        $dash=self::homePage($data->android_api,$log['android_id']);
        if(!is_file('reff')){
          file_put_contents('reff',$log['android_id']);}
        $ime=substr(md5(self::imeiRandom()),-16);
        $idx=file('reff');
        $Api=rand(00000,99999);
       foreach (self::name() as $head => $body){
         $email[]=str_replace("@example.com","@gmail.com",$body[0]['email']);}
       $sigup=self::sginup($ime,strstr($email[0],"@",true),$email[0],$Api,$Api);
       if($sigup['error'] == true){
         echo self::col(strtoupper($sigup['message']."!!!!!!..."),"h")."\n";
         $ambil=["user-".rand(0000,9999)=>["email"=>$email[0],"android_api"=>$Api]];
         self::save("akunreff.json",$ambil);sleep(1);}
        //$reff=self::reffer($reff,$api,$mail,$id)
       $sxc=json_decode(file_get_contents("akunreff.json"),1);
       foreach ($sxc as $xmail => $wmail){
         $a_id[]=$wmail;
         $xck[]=self::cekUser($wmail['email'],$wmail['android_api']);}
       for($i=0;$i < count($xck);$i++){
           $fx=$xck[$i];
           $as=$a_id[$i];
           sleep(1);
           $re=self::reffer($idx[0],$as['android_api'],$as['email'],$fx['android_id']);
           if($re['error'] == true){
             echo self::col(strtoupper($re['message']),"h")."\n";
             self::timer(5,"prosess","proses","invit");
           }
       }
      self::timer(10,"wait time is it","tunggu","broooo");
      endwhile;
      break;
    case 2:
      $sxc=json_decode(file_get_contents("akunreff.json"),1);
      echo self::col("~> total akun reff ","up")."".self::col(count($sxc)." akun","mp")."\n";
      while(1):
      foreach ($sxc as $and => $me){
        $log=self::cekUser($me['email'],$me['android_api']);
        $home=self::homePage($me['android_api'],$log['android_id']);
        #print_r($home);die();
        $spin=self::spin(10,$me['android_api'],$log['android_id']);
        $scr=self::scrath(10,$me['android_api'],$log['android_id']);
        $match=self::match($me['android_api'],$log['android_id']);
        $watch=self::watch($me['android_api'],$log['android_id']);
        $cap=self::captcha($me['android_api'],$log['android_id']);
        if($spin['error'] == true &&  $watch['error'] == true && $cap['error'] == true && $scr['error'] == true){
          echo self::col(strtoupper("~> user"),"px")." ".self::col($home['android_username'],"cp")." ".self::col(strtoupper("updatae balance"),"up")." => ".self::col($home['android_amount'],"c")." ~> ".self::col(strtoupper("nice"),"mp")."\n";
          self::timer(5,"all akun reff","tuyuler","barbar");
          continue;
        }
      }
      endwhile;
      
      break;
      }
        
        break;
      
      case 3:
        //witdhrawal
        if(!is_file('email.json')){
          $em=readline(self::col("EMAIL_PAYPAL:","up"));
          $ds=["paypal"=>$em];
          self::save("email.json",$ds);}
        $py=json_decode(file_get_contents("email.json"));
        $log=self::cekUser($data->email,$data->android_api);
        $setData=http_build_query(array("android_api"=>$data->android_api,"android_id"=>$log['android_id']));
        $cekDataWd=json_decode(self::curl($this->url."withdrawpage_data_get.php",$setData,self::head())[1]);
        if($cekDataWd->android_amount === "4200"){
        $reqWithd=self::withDraw($log['android_name'],$data->android_api,$py->paypal,$log['android_email'],"4000_1",$log['android_id']);
        print_r($reqWithd);
        }else if($cekDataWd->android_amount === "11000"){
          $reqWithd=self::withDraw($log['android_name'],$data->android_api,$py->paypal,$log['android_email'],"11000_3",$log['android_id']);
          print_r($reqWithd);
        }else if($cekDataWd->android_amount === "18000"){
          $reqWithd=self::withDraw($log['android_name'],$data->android_api,$py->paypal,$log['android_email'],"18000_5",$log['android_id']);
          print_r($reqWithd);
        }else if($cekDataWd->android_amount === "33000"){
          $reqWithd=self::withDraw($log['android_name'],$data->android_api,$py->paypal,$log['android_email'],"33000_10",$log['android_id']);
          print_r($reqWithd);
        }else{
          echo self::col(strtoupper("ada kesalahan saat wd, tidak suport ip indo nesia\natau cek balance anda"),"m")."\n";
        }
        break;
    }
  }
 }

$obj=new kakatoji();
$obj->_run();
