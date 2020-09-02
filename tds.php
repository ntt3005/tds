<?php session_start();
$lock='08072000';
//color
$res="\033[0m";
$red="\033[0;31m";
$green="\033[0;32m";
$yellow="\033[0;33m";
$banner="\r
   -------- Tool TDS free không mua bán dưới mọi hình thức --------
                     Tool của: Trần Quang Duy            
                     YOUTUBE : Quang Duy Official
                     
         ___________CHÀO MỪNG BẠN ĐẾN VỚI TOOL TDS ___________ \n
\n";



//config
{echo $green."ĐĂNG NHẬP THÀNH CÔNG\n$res";
sleep(1);
@system('clear');
echo $green."UsernameTDS: $yellow";
$_SESSION["username"]=trim(fgets(STDIN));
echo $green."Password TDS: $yellow";
$_SESSION['password']=trim(fgets(STDIN));
echo $green."Cookie Facebook: $yellow";
$cookie=trim(fgets(STDIN));
echo"$res";
$key=array('key' => 'dcfcd07e645d245babe887e5e2daa016');
$ua='Mozilla/5.0 (Linux; Android 9; SM-A205F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.106 Mobile Safari/537.36';
//login tds
$ch=curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://traodoisub.com/scr/login.php');
curl_setopt($ch, CURLOPT_COOKIEJAR, "TDS.txt");
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
$login =array('username' => $_SESSION['username'],'password' => $_SESSION['password'],'submit' => ' Đăng Nhập');
curl_setopt($ch, CURLOPT_POST,count($login));
curl_setopt($ch, CURLOPT_POSTFIELDS,$login);
curl_setopt($ch, CURLOPT_COOKIEFILE, "TDS.txt");
$source=curl_exec($ch);
$not1=explode('{"', $source);
$not=explode('"', $not1[1]);
curl_close($ch);

if($not[0]=='success'){
@system('clear');
echo $banner;
echo $green."ĐĂNG NHẬP THÀNH CÔNG.\n$res";
echo" Nhập Time delay (Tối Thiểu 10 Giây): ";
$_SESSION['delay']=trim(fgets(STDIN));
if($_SESSION['delay'] < 10)
{exit($red."Tối Thiểu 10 Giây\n");}
echo' Số Lần Chạy: ';
$_SESSION['i']=trim(fgets(STDIN));
if($_SESSION['i'] < 1)
{exit($red."Tối Thiểu 1 Lần\n");}
}
else{exit($red."ĐĂNG NHẬP THẤT BẠI.\n $res");}
//login fb
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://mbasic.facebook.com/');
$head[] = "Connection: keep-alive";
$head[] = "Keep-Alive: 300";
$head[] = "ccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
$head[] = "Accept-Language: en-us,en;q=0.5";
curl_setopt($ch, CURLOPT_USERAGENT, 'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14');
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_COOKIE, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect
:'));
curl_exec($ch);
curl_close($ch);
// get id
$i=0;
while ($i <= $_SESSION['i'] - 1){
$i++;
sleep(5);
$ch=curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://traodoisub.com/scr/loadsub.php');
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
curl_setopt($ch, CURLOPT_POST, count($key));
curl_setopt($ch, CURLOPT_POSTFIELDS, $key);
curl_setopt($ch, CURLOPT_COOKIEFILE, 'TDS.txt');
$tid=curl_exec($ch);
$id1=explode('id="', $tid);
$id=explode('"', $id1[4]);
curl_close($ch);
//follow fb
sleep(1);
$linkid='https://mbasic.facebook.com/profile.php?id='.$id[0];
$ch = @curl_init();
curl_setopt($ch, CURLOPT_URL, $linkid);
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
preg_match('#href="/a/subscribe.php?(.+?)"#is', $page, $_link);
$link= html_entity_decode('https://mbasic.facebook.com/a/subscribe.php'.$_link[1]);
curl_setopt($ch, CURLOPT_URL, $link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_exec($ch);
curl_close($ch);
//addxu
sleep(2);
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://traodoisub.com/scr/nhantiensub.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
$tdsxu=array('id' => $id[0]);
curl_setopt($ch, CURLOPT_POST,count($tdsxu));
curl_setopt($ch, CURLOPT_POSTFIELDS,$tdsxu);
curl_setopt($ch, CURLOPT_COOKIEFILE, "TDS.txt");
$xu=curl_exec($ch);
curl_close($ch);
if($xu=='1'){echo"[$green".$i."$res]$red Bạn Chưa Follow ID Này.$res";}
if($xu=='2'){echo "[$green".$i."$res] ID:".$id[0]." |$green Thành Công$res | +600 XU";}
echo "\n";
sleep($_SESSION['delay'] -9);}
}

?>