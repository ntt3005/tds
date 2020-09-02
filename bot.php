<?php
error_reporting(0);
session_start();
//color
$res="\033[0m";
$red="\033[0;31m";
$green="\033[0;32m";
$yellow="\033[0;33m";
$white= "\033[0;37m";  
$banner="\r
\033[0;33m                
       -------- TOOl TRAODOISUB.COM MOBILE V1.0 --------  
      ---|Có thể tải tool tại website traodoisub.com|----   
    ======================================================             
              Copyright © 2020 By TRAODOISUB.COM           
\n";
//config
{
@system('clear');
echo $banner;
sleep(1);
$listnv = [];
echo $white."Tài Khoản: $yellow";
$_SESSION["username"]=trim(fgets(STDIN));
echo $white."Mật Khẩu: $yellow";
$_SESSION['password']=trim(fgets(STDIN));
echo $white."Cookie FB: $yellow";
$cookie=trim(fgets(STDIN));
echo"$res";
$ch=curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://traodoisub.com/scr/login.php');
curl_setopt($ch, CURLOPT_COOKIEJAR, "TDS.txt");
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Linux; Android 10; SM-J600G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Mobile Safari/537.36');
$login =array('username' => $_SESSION['username'],'password' => $_SESSION['password'],'submit' => ' Đăng Nhập');
curl_setopt($ch, CURLOPT_POST,count($login));
curl_setopt($ch, CURLOPT_POSTFIELDS,$login);
curl_setopt($ch, CURLOPT_COOKIEFILE, "TDS.txt");
$source=curl_exec($ch);
curl_close($ch);
if ($source != 1 && $source != ''){
	@system('clear');
	echo $green."Đăng nhập thành công!\n";
	$user = $_SESSION["username"];	
	echo $yellow."[CÀI ĐẶT CHẾ ĐỘ NHIỆM VỤ]\n";
	echo $white."Nhiệm vụ like (y/n): $yellow";
	if (trim(fgets(STDIN)) == 'y'){
		array_push($listnv,'like');
	}
	echo $white."Nhiệm vụ sub (y/n): $yellow";
	if (trim(fgets(STDIN)) == 'y'){
		array_push($listnv,'sub');
	}
	echo $white."Nhiệm vụ cmt (y/n): $yellow";
	if (trim(fgets(STDIN)) == 'y'){
		array_push($listnv,'cmt');
	}
	echo $white."Nhiệm vụ page (y/n): $yellow";
	if (trim(fgets(STDIN)) == 'y'){
		array_push($listnv,'page');
	}
	echo $white."Nhiệm vụ cảm xúc (y/n): $yellow";
	if (trim(fgets(STDIN)) == 'y'){
		array_push($listnv,'cx');
	}
	if (count($listnv) == 0){exit($red."Vui lòng chọn ít nhất 1 loại nhiệm vụ!");}
	echo $white."Delay giữa các nhiệm vụ (Min 10 Giây): $yellow";
	$_SESSION['delay']=trim(fgets(STDIN));
	if($_SESSION['delay'] < 10)
	{exit($red."Tối Thiểu 10 Giây\n");}
	echo $white."Delay vòng chống block (Min 20 giây): $yellow";
	$_SESSION['j']=trim(fgets(STDIN));
	if($_SESSION['j'] < 20)
	{exit($red."Tối Thiểu 15 giây\n");}
	echo $white."Số Lần Chạy: $yellow";
	$_SESSION['i']=trim(fgets(STDIN));
	if($_SESSION['i'] < 1)
	{exit($red."Tối Thiểu 1 Lần\n");}
}else{
	exit($red."Đăng nhập thất bại, kiểm tra lại tài khoản mật khẩu!");
}
#get_token
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://m.facebook.com/composer/ocelot/async_loader/?publisher=feed');
$head[] = "Connection: keep-alive";
$head[] = "Keep-Alive: 300";
$head[] = "authority: m.facebook.com";
$head[] = "ccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
$head[] = "accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5";
$head[] = "cache-control: max-age=0";
$head[] = "upgrade-insecure-requests: 1";
$head[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
$head[] = "sec-fetch-site: none";
$head[] = "sec-fetch-mode: navigate";
$head[] = "sec-fetch-user: ?1";
$head[] = "sec-fetch-dest: document";
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36');
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
$access = curl_exec($ch);
curl_close($ch);
if (explode('\",\"useLocalFilePreview',explode('accessToken\":\"', $access)[1])[0]){
$access_token = explode('\",\"useLocalFilePreview',explode('accessToken\":\"', $access)[1])[0];
if(json_decode(file_get_contents('https://graph.facebook.com/me/?access_token='.$access_token))->{'id'}){
	$idfb = json_decode(file_get_contents('https://graph.facebook.com/me/?access_token='.$access_token))->{'id'};	
}else{
	exit($red."Cookie die!!");
}
$h = datnick($user,$idfb);
$xu = file_get_contents('https://traodoisub.com/scr/test3.php?user='.$user);
if ($h == '1'){
		$i=1;
		while ($i <= $_SESSION['i']){
			$rand = $listnv[array_rand($listnv,1)];
			if ($rand == 'like'){
				$list = getnv('like',$user);
				$check = count($list);
				if ($check == 0){echo $red."Hết nhiệm vụ!\n"; $i++; continue;}
				echo $yellow."Tìm thấy ".$check." nhiệm vụ!\n";
				foreach ($list  as $id) {
					like($access_token,$id,$cookie);
					$s = nhantien('like',$id);
					if ($s == 2){$xu = $xu + 300; echo $white."[LIKE]|$yellow ID:".$id." -> $white Thành Công$yellow |+300 xu|".$white.$xu;}
					else{echo $red."[LIKE] | Thất Bại ID ".$id.$yellow;}
					echo "\n";
					sleep($_SESSION['delay']);
				}
			}else if($rand == 'sub'){
				$list = getnv('follow',$user);
				$check = count($list);
				if ($check == 0){echo $red."Hết nhiệm vụ!\n"; $i++; continue;}
				echo $yellow."Tìm thấy ".$check." nhiệm vụ!\n";
				foreach ($list  as $id) {
					follow($access_token,$id,$cookie);
					$s = nhantien('sub',$id);
					if ($s == 2){$xu = $xu + 600;echo $white."[FOLLOW]|$yellow ID:".$id." -> $white Thành Công$yellow |+600 xu|".$white.$xu;}
					else{echo $red."[FOLLOW] | Thất Bại ID ".$id.$yellow;}
					echo "\n";
					sleep($_SESSION['delay']);
				}
			}else if($rand == 'page'){
				$list = getnv('likepage',$user);
				$check = count($list);
				if ($check == 0){echo $red."Hết nhiệm vụ!\n"; $i++; continue;}
				echo $yellow."Tìm thấy ".$check." nhiệm vụ!\n";
				foreach ($list  as $id) {
					page($id,$cookie);
					$s = nhantien('page',$id);
					if ($s == 2){$xu = $xu + 600; echo $white."[PAGE]|$yellow ID:".$id." -> $white Thành Công$yellow |+600 xu|".$white.$xu;}
					else{echo $red."[PAGE] | Thất Bại ID ".$id.$yellow;}
					echo "\n";
					sleep($_SESSION['delay']);
				}
			}else if($rand == 'cx'){
				$list = getnv('camxuc',$user);
				$check = count($list);
				if ($check == 0){echo $red."Hết nhiệm vụ!\n"; $i++; continue;}
				echo $yellow."Tìm thấy ".$check." nhiệm vụ!\n";
				foreach ($list  as $id => $key) {
					$id = $key->{'id'};
					$type = $key->{'type'};
					camxuc($id,$type,$cookie);
					$s = nhantiencx($type,$id);
					if ($s == 2){$xu = $xu + 400; echo $white."[$type]|$yellow ID:".$id." -> $white Thành Công$yellow |+400 xu|".$white.$xu;}
					else{echo $red."[$type] | Thất Bại ID ".$id.$yellow;}
					echo "\n";
					sleep($_SESSION['delay']);
				}
			}
			else{
				$list = getnv('cmt',$user);
				$check = count($list);
				if ($check == 0){echo $red."Hết nhiệm vụ!\n"; $i++; continue;}
				echo $yellow."Tìm thấy ".$check." nhiệm vụ!\n";
				foreach ($list  as $id => $key) {
					$uid = $key->{'id'};
					$msg = $key->{'nd'};
					cmt($access_token,$uid,$cookie,$msg);
					$s = nhantien('cmt',$uid);
					if ($s == 2){$xu = $xu + 800; echo $white."[CMT]|$yellow ID:".$uid." -> $white Thành Công$yellow |+800 xu|".$white.$xu;}
					else{echo $red."[CMT] | Thất Bại ID ".$id.$yellow;}
					echo "\n";
					sleep($_SESSION['delay']);
				}
			}
		$i++;
		echo $red."Delay ".$_SESSION['j']." giây:";
		for ($x = 0; $x <= $_SESSION['j']; $x++) {
		  echo $green."|";
		  sleep(1);
		}
		echo "\n";
		}
}else{exit($red."Cấu hình thất bại, vui lòng thêm id: $id vào cấu hình");}
}else{exit($red."Cookie die!!");}
}
function follow($access_token,$id,$cookie){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/'.$id.'/subscribers');
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "authority: m.facebook.com";
	$head[] = "ccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5";
	$head[] = "cache-control: max-age=0";
	$head[] = "upgrade-insecure-requests: 1";
	$head[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
	$head[] = "sec-fetch-site: none";
	$head[] = "sec-fetch-mode: navigate";
	$head[] = "sec-fetch-user: ?1";
	$head[] = "sec-fetch-dest: document";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36');
	curl_setopt($ch, CURLOPT_ENCODING, '');
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	$data = array('access_token' => $access_token);
	curl_setopt($ch, CURLOPT_POST,count($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	$access = curl_exec($ch);
	curl_close($ch);
	return $access;
}
function like($access_token,$id,$cookie){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/'.$id.'/likes');
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "authority: m.facebook.com";
	$head[] = "ccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5";
	$head[] = "cache-control: max-age=0";
	$head[] = "upgrade-insecure-requests: 1";
	$head[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
	$head[] = "sec-fetch-site: none";
	$head[] = "sec-fetch-mode: navigate";
	$head[] = "sec-fetch-user: ?1";
	$head[] = "sec-fetch-dest: document";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36');
	curl_setopt($ch, CURLOPT_ENCODING, '');
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	$data = array('access_token' => $access_token);
	curl_setopt($ch, CURLOPT_POST,count($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	$access = curl_exec($ch);
	curl_close($ch);
	return $access;
}
function cmt($access_token,$id,$cookie,$msg){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/'.$id.'/comments');
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "authority: m.facebook.com";
	$head[] = "ccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5";
	$head[] = "cache-control: max-age=0";
	$head[] = "upgrade-insecure-requests: 1";
	$head[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
	$head[] = "sec-fetch-site: none";
	$head[] = "sec-fetch-mode: navigate";
	$head[] = "sec-fetch-user: ?1";
	$head[] = "sec-fetch-dest: document";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.135 Safari/537.36');
	curl_setopt($ch, CURLOPT_ENCODING, '');
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
	$data = array('message' => $msg,'access_token' => $access_token);
	curl_setopt($ch, CURLOPT_POST,count($data));
	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
	$access = curl_exec($ch);
	curl_close($ch);
	return $access;
}
function page($id,$cookie){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://mbasic.facebook.com/'.$id);
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');
	curl_setopt($ch, CURLOPT_ENCODING, '');
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect
	:'));
	$page = curl_exec($ch);
	if (explode('&amp;refid=',explode('pageSuggestionsOnLiking=1&amp;gfid=',$page)[1])[0]){
		$get = explode('&amp;refid=',explode('pageSuggestionsOnLiking=1&amp;gfid=',$page)[1])[0];
		$link = 'https://mbasic.facebook.com/a/profile.php?fan&id='.$id.'&origin=page_profile&pageSuggestionsOnLiking=1&gfid='.$get.'&refid=17';
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($ch);
	}	
	curl_close($ch);

}
function camxuc($id,$type,$cookie){
	$ch = curl_init();
	if(strpos($id,'_')){
		$uid = explode('_',$id, 2);
		$id2 = 'story.php?story_fbid='.$uid[1].'&id='.$uid[0];
	}else{
		$id2 = $id;
	}
	curl_setopt($ch, CURLOPT_URL, 'https://mbasic.facebook.com/'.$id2);
	$head[] = "Connection: keep-alive";
	$head[] = "Keep-Alive: 300";
	$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$head[] = "Accept-Language: en-us,en;q=0.5";
	curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');
	curl_setopt($ch, CURLOPT_ENCODING, '');
	curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect
	:'));
	$page = curl_exec($ch);
	if ($id2 != $id && explode('&amp;origin_uri=',explode('amp;ft_id=',$page,2)[1],2)[0]){
		$get = explode('&amp;origin_uri=',explode('amp;ft_id=',$page,2)[1],2)[0];
	}else{
		$get = $id2;
	}
	$link = 'https://mbasic.facebook.com/reactions/picker/?is_permalink=1&ft_id='.$get;
	curl_setopt($ch, CURLOPT_URL, $link);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$cx = curl_exec($ch);
	$haha = explode('<a href="',$cx);
	if ($type == 'LOVE'){
		$haha2 = explode('" style="display:block"',$haha[2])[0];
	}else if ($type == 'WOW'){
		$haha2 = explode('" style="display:block"',$haha[5])[0];
	}else if ($type == 'HAHA'){
		$haha2 = explode('" style="display:block"',$haha[4])[0];
	}else if ($type == 'SAD'){
		$haha2 = explode('" style="display:block"',$haha[6])[0];
	}else{
		$haha2 = explode('" style="display:block"',$haha[7])[0];
	}
	$link2 = html_entity_decode($haha2);	

	curl_setopt($ch, CURLOPT_URL, 'https://mbasic.facebook.com'.$link2);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_exec($ch);
	curl_close($ch);
}
function getnv($loai,$user){
	$list = file_get_contents('https://traodoisub.com/scr/api_job.php?chucnang='.$loai.'&user='.$user);
	return json_decode($list);
}
function datnick($user,$id){
	$xxx = file_get_contents('https://traodoisub.com/scr/api_dat.php?user='.$user.'&idfb='.$id);
	return $xxx;
}
function nhantien($loai,$id){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://traodoisub.com/scr/nhantien'.$loai.'.php');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$tdsxu=array('id' => $id);
	curl_setopt($ch, CURLOPT_POST,count($tdsxu));
	curl_setopt($ch, CURLOPT_POSTFIELDS,$tdsxu);
	curl_setopt($ch, CURLOPT_COOKIEFILE, "TDS.txt");
	$xu=curl_exec($ch);
	curl_close($ch);
	return $xu;
}
function nhantiencx($loai,$id){
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://traodoisub.com/scr/nhantiencx.php');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$tdsxu=array('id' => $id, 'loaicx' => $loai);
	curl_setopt($ch, CURLOPT_POST,count($tdsxu));
	curl_setopt($ch, CURLOPT_POSTFIELDS,$tdsxu);
	curl_setopt($ch, CURLOPT_COOKIEFILE, "TDS.txt");
	$xu=curl_exec($ch);
	curl_close($ch);
	return $xu;
}

?>