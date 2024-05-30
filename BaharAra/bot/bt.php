<meta charset="utf-8"/>
<?php
//-------------Files-------------------------------	
	include ('config.php');
	include ('jdf.php');
	include ('function.php');
//-------------Set date & time-------------------------------	
	date_default_timezone_set("Asia/Tehran");
	
	$day_number = jdate('j'); 
	$month_number = jdate('n'); 
	$year_number = jdate('Y'); 
	$time = jdate ('H:i:s');
	$saat = date ("H")*1; 
	$day = $year_number.'/'.$month_number.'/'.$day_number.' - '.$time;
	
//-------------Set teleg for PHP-------------------------------	
	
	$string 	= json_decode(file_get_contents('php://input'));
	$result 	= objectToArray($string);
	$user_id 	= $result['message']['from']['id'];
	$text 		= $result['message']['text'];
	$message_id	= $result['message']['message_id'];
	$user_n 	= $result['message']['from']['username'];
	$user_f 	= $result['message']['from']['first_name'];
	$user_l 	= $result['message']['from']['last_name'];
	$pr	= $result['message']['location']['live_period'];
	$acu	= $result['message']['location']['horizontal_accuracy'];
	$long	= $result['message']['location']['longitude'];
	$lat 	= $result['message']['location']['latitude'];
	$cnt 	= $result['message']['contact']['phone_number'];
	$pic_id_0       	= $result['message']['photo'][0]['file_id'];
	$pic_id_1	= $result['message']['photo'][1]['file_id'];
	$pic_id_2	= $result['message']['photo'][2]['file_id'];
	$pic_id_3	= $result['message']['photo'][3]['file_id'];
	$pic_id_4	= $result['message']['photo'][4]['file_id'];
	$doc_id	= $result['message']['document']['file_id'];
	$doc_name	= $result['message']['document']['file_name'];
	
	include('config.php');
$q="SELECT * FROM `settings` WHERE 1";
$r=mysqli_query($cn,$q);
$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
global $token,$Activate;
$token=$row['token'];
$endTime=$row['endTime'];

/*$Date = "2010-09-17";
echo date('Y-m-d', strtotime($Date. ' + 1 days'));*/

	$q="SELECT * FROM `users` WHERE `storeres`=1";
	$r=mysqli_query($cn,$q);
	$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
	global $anbardar,$anbarpers;
	$anbardar=$row['uid'];
	$anbarpers=$row['person'];
global $ellat;
$ellat=array(
    "1" => "جمع آوری موظفی",
    "2" => "جمع آوری مدیریتی",
    "3" => "انصراف پذیرنده",
    "4" => "عدم حضور پذیرنده",
    "5" => "عدم تحویل مدارک",
    "6" => "خرابی چاپگر",
    "7" => "خرابی صفحه کلید یا مگنت",
    "8" => "Tamperd/PedLock",
    "9" => "عدم ارتباط",
    "10" => "اشتباه در تخصیص",
    "11" => "سایر موارد",
    "12" => "خسارت",
);
	//keys------------------------------------------------------------
	$key_cancel=array(
		array('انصراف❌'),
	);
	$key_close=array(
	        array('شروع')
    );
	$key_pay=array(
	        array('♻️تمدید اشتراک')
    );
	$key_tamdid=array(
	        array('1 ماهه','3 ماهه'),
	        array('6 ماهه','12 ماهه'),
    );
	$key_cancelreject=array(
		array('انصراف از عودت کالا❌'),
	);
	$key_pazirande=array(
	        array('❌خیر','✅بله'),
	  array('📠تجهیزات فعال پذیرنده'),
        array('🔍خلاصه وضعیت','📋اطلاعات پایانه')
    );
	$key_export =array(
	  array('عودت تجهیزات'),
        array('انصراف❌'),
    );
	$key_group=array(
	        array('پشتیبان','اداری','انباردار'),
        array('انصراف❌'),
    );
	$key_update=array(
	        array('فایل جمع آوری','فایل شب گذشته'),
	        array('فایل رتبه بندی VIP','فایل درخواست ها'),
	        array('اطلاعات سیم کارت','فایل پذیرندگان VIP'),
	        array('انصراف❌','فایل تجهیزات'),
    );
	global $key_main1;
	$key_main1=array(
        array('دفترچه تلفن☎️','عودت تجهیزات به انبار🏭'),
	);
	global $key_main0;
    $key_main0=array(
        array('دفترچه تلفن☎️','عودت تجهیزات به انبار🏭'),
	);
global $key_main2;
$key_main2=array(
    array('عودت تجهیزات به انبار🏭'),
    array('آپدیت سامانه👨‍🏫','نمونه فایل ها💾'),
    array('دفترچه تلفن☎️','خروجی اکسل💹'),
    /*array('مدیریت اعضا👨‍🏫')*/
);

$key_settings=array(
    array('غیرفعال کردن ربات⛔️','فعال کردن ربات✅️'),
    array('انصراف❌'),
);
global $key_main3;
$key_main3 = array(
    array('عودت تجهیزات به انبار🏭','ارسال پیام✉️'),
    array('آپدیت سامانه👨‍🏫','نمونه فایل ها💾'),
    array('دفترچه تلفن☎️','خروجی اکسل💹'),
    array('مدیریت اعضا👨‍🏫','تنظیمات⚙️')
);
	$key_sec=array(
		array('❌رد','✅تایید'),
	);
	$key_adapt=array(
		array('ندارد➖','دارد✔️'),
		array('انصراف از عودت کالا❌'),
	);
	$key_yn=array(
		array('❌خیر','✅بله'),
	);
	$key_ynr=array(
		array('❌خیر','✅بله'),
		array('انصراف از عودت کالا❌'),
	);
    $key_odat_adad=array(
    array('1','2','3','4'),
    array('انصراف از عودت کالا❌'),
    );
    $key_odat_vip=array(
    array('1','2'),
    array('انصراف از عودت کالا❌'),
    );
	$key_salem=array(
		array('معیوب⚠️','سالم✅'),
		array('انصراف از عودت کالا❌'),
	);
	$key_adad=array(
		array('1','2','3','4','5'),
		array('6','7','8','9','10'),
	);
	$key_odat_pinpad=array(
        array('1','2','3','6','7'),
        array('8','9','11','12')
        );
	$key_odat=array(
	        array('پوز','مودم','پین پد'),
	        array('سیم کارت','پایه پوز'),
            array('انصراف از عودت کالا❌'),
    );
	$key_reson=array(
		array('1','2','3','4','5','6'),
		array('7','8','9','10','11','12'),
		array('انصراف از عودت کالا❌'),
	);
	$key_resonVip=array(
		array('3','5','6','7','8'),
		array('9','10','11','12'),
		array('انصراف از عودت کالا❌'),
	);
	$key_resonVip1=array(
        array('3','6','7','8'),
        array('9','10','11','12'),
        array('انصراف از عودت کالا❌'),
	);
	$key_adam=array(
		array('3','4','5','6','7'),
		array('8','9','10','11','12'),
		array('انصراف از عودت کالا❌'),
	);
	$key_adam1=array(
		array('3','5','6','7','8'),
		array('9','10','11','12'),
		array('انصراف از عودت کالا❌'),
	);
	$key_resonCollect=array(
		array('1','2','6','7'),
		array('8','10','11','12'),
		array('انصراف از عودت کالا❌'),
	);
	$key_fix=array(
	        array(),
    );
	function key_reson($key){
	    global $keyReson;
	    $keyReson=array(
	      array($key),
          array('انصراف از عودت کالا❌'),
        );
    }
$key_manage=array(
    array('♾ویرایش اعضا','➕افزودن عضو'),
    array('انصراف❌'),
);
$key_user_level=array(
    array('🤵پشتیبان','👨‍💻اداری'),
    array('مدیر سامانه👨‍🏫','🏭انباردار'),
    array('انصراف❌'),
);
$key_karbar_manage=array(
    array('📋خلاصه اطلاعات کاربر'),
    array('📍شهر','📱موبایل','🔖نام'),
    array('👨‍🏫دسترسی','❌حذف'),
    array('انصراف❌'),
);
$key_karbar=array(
    array('📋خلاصه اطلاعات کاربر'),
    array('❌حذف','📍شهر','📱موبایل','🔖نام'),
    array('انصراف❌'),
);
$key_user_active =array(
    array('⛔غیرفعال','✅فعال'),
    array('انصراف❌'),
);

	//functions-------------------------------------------------------
function updateID($table,$radif,$meghdar,$oid){
    include('config.php');
    $q="UPDATE `".$table."` SET `".$radif."`='".$meghdar."' WHERE `id`='".$oid."';";
    $r=mysqli_query($cn,$q);
}
	function ersal($user_id,$text,$reply_markup,$parseMode){
	$rp=json_encode($reply_markup);
	if(isset($parseMode)){
		$url= "https://api.telegram.org/bot".$GLOBALS['token']."/sendMessage?chat_id=".$user_id."&text=".$text."&parse_mode=HTML&reply_markup=".$rp."&disable_web_page_preview=true";	
	}
	else{
		$url= "https://api.telegram.org/bot".$GLOBALS['token']."/sendMessage?chat_id=".$user_id."&text=".$text."&reply_markup=".$rp."&disable_web_page_preview=true";		
	}
	$x = file_get_contents($url);
        $string 	= json_decode($x);
        $result 	= objectToArray($string);
        $message_id	= $result['message']['message_id'];
//        include ('config.php');
//        $q="UPDATE `users` SET `mid`=".$message_id." WHERE `uid`=".$user_id;
//        $r = mysqli_query($cn,$q);
	}
	
	function deleteMsg($user_id,$msg_id){
	$url= "https://api.telegram.org/bot".$GLOBALS['token']."/deleteMessage?chat_id=".$user_id."&message_id=".$msg_id;		
	file_get_contents($url);		
	}

	function editMsg($user_id,$msg_id,$text){
	$url= "https://api.telegram.org/bot".$GLOBALS['token']."/editMessageText?chat_id=".$user_id."&message_id=".$msg_id."&text=".$text;		
	file_get_contents($url);		
	}
	
	function ersalchannel($text){
	
	$url= "https://api.telegram.org/bot".$GLOBALS['token']."/sendMessage?chat_id=@waleto&text=$text";	
	file_get_contents($url);	
	}
	
	function ersalcontact($user_id,$picurl,$caption,$reply_markup){
	$rp=json_encode($reply_markup);
	
	$url="https://api.telegram.org/bot".$GLOBALS['token']."/sendContact?chat_id=".$user_id."&phone_number=".$picurl."&parse_mode=HTML&first_name=".$caption;	
	file_get_contents($url);
	}
	
	function ersalpicr($user_id,$picurl,$caption,$reply_markup){
	$rp=json_encode($reply_markup);
	$url="https://api.telegram.org/bot".$GLOBALS['token']."/sendPhoto?chat_id=".$user_id."&photo=".$picurl."&parse_mode=HTML&caption=".$caption."&reply_markup=".$rp;	
	file_get_contents($url);	
	}
	
	function ersalpic($user_id,$picurl,$caption){
	//$url="https://api.telegram.org/bot".$GLOBALS['token']."/sendPhoto?chat_id=".$user_id."&photo=".$picurl."&parse_mode=HTML&caption=".$caption;
	$url="https://api.telegram.org/bot".$GLOBALS['token']."/sendDocument?chat_id=".$user_id."&document=".$picurl."&parse_mode=HTML&caption=".$caption;
	file_get_contents($url);
	}
	
		function update($table,$radif,$meghdar,$oid){
		include('config.php');
		$q="UPDATE `".$table."` SET `".$radif."`='".$meghdar."' WHERE `uid`='".$oid."';";
		$r=mysqli_query($cn,$q);
	}
	
	function selectreject($id){
		include('config.php');
		$q="SELECT * FROM `reject` WHERE `id`='".$id."' ORDER BY `id` DESC";
		$r=mysqli_query($cn,$q);
		global $allequip,$suppdesc,$takhsis,$p1005,$p1025,$pcancel,$desc,$rejid,$karbar,$recep,$shopname,$serial,$adapt,$adaptor,$reson,$pos,$zaman;
		global $paye,$payeserial,$zirpaye,$payerej,$payepos,$sim,$modem,$modemserial,$modemadaptor,$modemspiliter,$modemrej,$supsign,$setpic,$simserial;
		global $tanaghoz,$rej_serial,$model,$pazirande,$pinpad,$ppserial,$rej_sim,$rej_simserial,$pdamage,$rej_uid;
		$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
        $allequip=$row['allequip'];
		$rejid=$row['id'];
        $tanaghoz=$row['tanaghoz'];
		$model=$row['model'];
		$pazirande=$row['pazirande'];
        $takhsis=$row['takhsis'];
		$uid=$row['uid'];
		$rej_uid=$row['uid'];
		$recep=$row['recep'];
		$shopname=$row['shopname'];
		$serial=$row['serial'];
		$rej_serial=$row['serial'];
		$ppserial=$row['pinpadSerial'];
		$pinpad=$row['pinpad'];
		$adaptor=$row['adaptor'];
		if($adaptor==1){$adapt='دارد';}else{$adapt='ندارد';}
		$reson=$row['reson'];
		$pos=$row['pos'];
		$paye=$row['paye'];
		$payeserial=$row['payeserial'];
		$zirpaye=$row['zirpaye'];
		$payerej=$row['payerej'];
		$payepos=$row['payepos'];
		$sim=$row['sim'];
		$simserial=$row['simserial'];
		$rej_sim=$row['sim'];
		$rej_simserial=$row['simserial'];
		$modem=$row['modem'];
		$modemserial=$row['modemserial'];
		$modemadaptor=$row['modemadaptor'];
		$modemspiliter=$row['modemspiliter'];
		$modemrej=$row['modemrej'];
		$supsign=$row['supsign'];
		$setpic=$row['setpic'];
		$p1005=$row['perferaj1005'];
		$p1025=$row['perferaj1025'];
		$pcancel=$row['cancelform'];
		$pdamage=$row['damageForm'];
		$desc=$row['desc'];
		$suppdesc=$row['desc'];
		$storedesc=$row['storedesc'];
		$zaman=$row['zaman'];
		$q="SELECT * FROM `users` WHERE `uid`='".$uid."' ORDER BY `person` DESC";
		$r=mysqli_query($cn,$q);
		$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
		$karbar=$row['name'];
	}

	function ersaldoc($user_id,$doc,$caption){
	$url="https://api.telegram.org/bot".$GLOBALS['token']."/sendDocument?chat_id=".$user_id."&document=http://waleto.ir/asanpardakht/".$doc.".xls&parse_mode=HTML&caption=".$caption."&thumb=http://waleto.ir/sadad/excel.jpg";
	file_get_contents($url);	
	}
	
	function tabdilzaman($x){
		include('jdf.php');
	$date=date_create(date('Ymd'));
date_add($date,date_interval_create_from_date_string("0 days"));
$ztahvil= date_format($date,"Y-m-d");
$timezone = 0;//برای 3:30 عدد 12600 و برای 4:30 عدد 16200 را تنظیم کنید
$now = date($ztahvil, time()+$timezone);
$time = date("H:i:s", time()+$timezone);
list($year, $month, $day) = explode('-', $now);
list($hour, $minute, $second) = explode(':', $time);
$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
$jalali_date = jdate("Y/m/d",$timestamp);
global $zamanchange;
$zamanchange=$jalali_date;//utf8_encode($jalali_date);
	}
	
	function ezafe($table,$radif,$meghdar){
		include('config.php');
		global $testq;
		$q="INSERT INTO `".$table."`(".$radif.") VALUES(".$meghdar.")";
		$r=mysqli_query($cn,$q);
		$testq=$q;
	}

	function updatereject($radif,$meghdar,$oid){
		include('config.php');
		$q="UPDATE `reject` SET `".$radif."`='".$meghdar."' WHERE `id`=$oid";
		$r=mysqli_query($cn,$q);
	}

	function delreject($id){
		include('config.php');
		$q="DELETE FROM `reject` WHERE `id`=".$id;
		$r=mysqli_query($cn,$q);
	}
	function delusers($id){
		include('config.php');
		$q="DELETE FROM `users` WHERE `uid`=".$id;
		$r=mysqli_query($cn,$q);
	}
	
	function selectrejname($id){
		include('config.php');
		$datereq=date("Ymd");
		$q="SELECT * FROM `reject` WHERE `recep`='".$id."' ORDER BY `zaman` DESC";
		$r=mysqli_query($cn,$q);
		global $rejid;
		$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
		$rejid=$row['id'];
	}

	function selectrejpazir($id){
		include('config.php');
		$datereq=date("Ymd");
		$q="SELECT * FROM `reject` WHERE `pazirande`='".$id."' ORDER BY `zaman` DESC";
		$r=mysqli_query($cn,$q);
		global $rejid;
		$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
		$rejid=$row['id'];
	}
	
	function selectRecName($id){
		include('configS.php');
		global $recpayane,$recGroup,$rec_city,$recname,$recpos,$recserial,$recmodel,$recpazir,$recsim,$toolsPos;
        $qqq = "SELECT * FROM `pazirande` WHERE `payaneCode`= $id AND `payaneGroup`!='MODEM' AND `payaneGroup`!='درگاه اينترنت' AND `payaneGroup`!='درگاه موبايل' AND `payaneGroup`!='پايه پوز'";
		$r=mysqli_query($cn,$qqq);
		$num=mysqli_num_rows($r);
		if($num>0){
            $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
		$endDate= $row['endDate'];
		$toolsPos= $row['toolsPos'];
        if($endDate=='' || $endDate==NULL){$recpos=1;}else{$recpos=2;}
            $recserial = $row['payaneSerial'];
            $recpayane = $row['payaneCode'];
            $recmodel = $row['payaneModel'];
            $recname = $row['shopName'];
            $recpazir = $row['pazirandeCode'];
            $recsim = $row['simSerial'];
            $rec_city = $row['city'];
            $recGroup = $row['payaneGroup'];
		}
		else{
		$recpos=0;
		}
	}

	function chkPazirande($pazirandeCode){
	    include ('configS.php');
		global $pz_info;
	$pz_info=array();
		$q="SELECT * FROM `pazirande` WHERE `pazirandeCode`='".$pazirandeCode."' AND `endDate`='' ORDER BY `pid` ASC";
		$r=mysqli_query($cn,$q);
		$num=mysqli_num_rows($r);
		global $pz,$md,$dm,$di,$pp,$st,$sim;
		$pz=0;$md=0;$dm=0;$di=0;$pp=0;$st=0;$sim=0;
	for($i=0;$i<$num;$i++){
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
		switch ($row['payaneGroup']){
			case 'MODEM':
			$pz_info[$pazirandeCode]['modem'][$md]=$row['payaneSerial'];
			$md++;
			break;
			case 'پايه پوز':
			$pz_info[$pazirandeCode]['paye'][$pz]=$row['payaneSerial'];
			$pz++;
			break;
			case 'درگاه موبايل':
			$pz_info[$pazirandeCode]['mobile'][$dm]=$row['payaneSerial'];
			$dm++;
			break;
			case 'درگاه اينترنت':
			$pz_info[$pazirandeCode]['internet'][$di]=$row['payaneSerial'];
			$di++;
			break;
			case 'PIN PAD':
			$pz_info[$pazirandeCode]['pinpad'][$pp]=$row['payaneSerial'];
			$pp++;
			break;
			default:
			$pz_info[$pazirandeCode]['set'][$st]=$row['payaneSerial'];
			$st++;
			break;
		}
	}
        $w="SELECT * FROM `pazirande` WHERE `pazirandeCode`='".$pazirandeCode."' AND `simserial`!='' ORDER BY `pid` ASC";
        $z=mysqli_query($cn,$w);
        $num=mysqli_num_rows($z);
        if($num>0) {
            for ($i = 0; $i < $num; $i++) {
                $row = mysqli_fetch_array($z,MYSQLI_ASSOC);
                $pz_info[$pazirandeCode]['sim'][$sim] = $row['simserial'];
                $sim++;
            }
        }
        else{
            $sim=0;
        }
	}

function chkVip($pazirande){
    include('configS.php');
    $datereq=date("Ymd");
    $q="SELECT * FROM `vip` WHERE `pazirande`='".$pazirande."' ORDER BY `vid` DESC";
    $r=mysqli_query($cn,$q);
    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
    global $chkVip_noe,$chkVip_pazirande,$vipCount,$vipGrade;
    $vipCount = mysqli_num_rows($r);
    if($vipCount>0) {
        $chkVip_noe = $row['noe'];
        $chkVip_pazirande = $row['pazirande'];
        $vipGrade = $row['grade'];
    }
}

function chCollect($payane){
    include('configS.php');
    global $chCollect_num;
    $datereq=date("Ymd");
    $q="SELECT * FROM `collect` WHERE `payane`='".$payane."' ORDER BY `cid` DESC";
    $r=mysqli_query($cn,$q);
    $chCollect_num = mysqli_num_rows($r);
    global $chCollect_serial, $chCollect_order, $chCollect_pazirande;
    global $chCollect_payane;
    if($chCollect_num>0) {
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
        $chCollect_serial = $row['serial'];
        $chCollect_order = $row['order'];
        $chCollect_pazirande = $row['pazirande'];
        $chCollect_payane = $row['payane'];
    }
    else{
        $chCollect_payane = 0;
    }
}

function chReq($pazirande){
    include('configS.php');
        $q="SELECT * FROM `req` WHERE `pazirande`='".$pazirande."' AND `setSerial`=0 AND `pos`='فعال' ORDER BY `rid` ASC";
    $r=mysqli_query($cn,$q);
    global $req_count;
    $req_count=mysqli_num_rows($r);
}


	function selectusers($user_id){
		include('config.php');
		$q="SELECT * FROM `users` WHERE `uid`=".$user_id;
		$r=mysqli_query($cn,$q);
		$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
		global $user_temp,$picurl,$word,$u_mid,$memo1,$suppname,$memo2,$memo3,$usercity,$reg,$mtel,$person,$edari,$memol,$memo4;
        $user_temp=$row['temp'];
        $picurl=$row['picurl'];
		$memo1=$row['memo1'];
		$memo2=$row['memo2'];
		$memo3=$row['memo3'];
		$memol=$row['memol'];
		$memo4=$row['memo4'];
		$u_mid=$row['mid'];
		$suppname=$row['name'];
		$usercity=$row['city'];
		$reg=$row['reg'];
		$mtel=$row['mtel'];
		$person=$row['person'];
		$edari=$row['edari'];
		$word=$row['word'];
	}

function selectcity($x,$y=0){
		include('config.php');
		$q="SELECT * FROM `city` WHERE `sub`=$x ORDER BY `id` ASC";
		$r=mysqli_query($cn,$q);
		global $selectcity;
		$selectcity=array();
		if($y==0) {
            $selectcity[] = array('اداری');
        }
		$num=mysqli_num_rows($r);
		$baghi=fmod($num,2);
		if($baghi==0){
			for($i=0;$i<$num/2;$i++){
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name1=$row['esm'];
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name2=$row['esm'];
			$selectcity[]=array($name2,$name1);
			}
		}
		else{
			$numr=round($num/2,0)-1;
			for($i=0;$i<$numr;$i++){

			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name1=$row['esm'];
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name2=$row['esm'];
			$selectcity[]=array($name2,$name1);
		}
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name1=$row['esm'];
			$selectcity[]=array($name1);

		}
		$selectcity[]=array('انصراف❌');
		}

	function sendContact($user_id,$phone,$title){
		$url= "https://api.telegram.org/bot".$GLOBALS['token']."/sendContact?chat_id=".$user_id."&phone_number=".$phone."&first_name=$title";
		file_get_contents($url);
	}
	function supportertel($id){
		global $poshtiban,$poshtibanum;
		$poshtiban=array();
		include('config.php');
		$q="SELECT * FROM `users` WHERE `city`='$id' AND `edari`=1 ORDER BY `person` ASC";
		$r=mysqli_query($cn,$q);
		$num=mysqli_num_rows($r);
		$poshtibanum=mysqli_num_rows($r);
		$baghi=fmod($num,2);
		if($baghi==0){
			for($i=0;$i<$num/2;$i++){
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name1=$row['name'];
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name2=$row['name'];
			$poshtiban[]=array($name2,$name1);
			}
		}
		else{
			$numr=round($num/2,0)-1;
			for($i=0;$i<$numr;$i++){

			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name1=$row['name'];
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name2=$row['name'];
			$poshtiban[]=array($name2,$name1);
		}
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name1=$row['name'];
			$poshtiban[]=array($name1);
		}
		$poshtiban[]=array('انصراف❌');
	}

	function barcode($addr){

	$ch = curl_init( );
	curl_setopt( $ch, CURLOPT_URL, 'https://zxing.org/w/decode?u='.$addr);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt( $ch, CURLOPT_TIMEOUT, 500 );
	$barcodi= curl_exec( $ch );
	global $subi,$sub ;
			$tool=strlen($barcodi);
			$pos=strpos($barcodi,'Parsed Result');
			$path_pos=$tool-$pos-52;
			$sub=substr($barcodi,($pos+65),$path_pos);

			$tool=strlen($sub);
			$pos=strpos($sub,'<pre>')+5;
			$path_pos=13;
			$subi=substr($sub,$pos,$path_pos);
}

	function edari(){
		global $edari;
		$edari=array();
		include('config.php');
		$q="SELECT * FROM `users` WHERE `edari`=2 ORDER BY `name` ASC";
		$r=mysqli_query($cn,$q);
		$num=mysqli_num_rows($r);
		$baghi=fmod($num,2);
		if($baghi==0){
			for($i=0;$i<$num/2;$i++){
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name1=$row['name'];
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name2=$row['name'];
			$edari[]=array($name2,$name1);
			}
		}
		else{
			$numr=round($num/2,0)-1;
			for($i=0;$i<$numr;$i++){

			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name1=$row['name'];
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name2=$row['name'];
			$edari[]=array($name2,$name1);
		}
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			$name1=$row['name'];
			$edari[]=array($name1);
		}
		$edari[]=array('انصراف❌');
	}

	function supporterteli($user_id,$id){
		include('config.php');
		$q="SELECT * FROM `users` WHERE `name`='$id' ORDER BY `person` ASC";
		$r=mysqli_query($cn,$q);
			$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
			global $posh,$internal,$edari;
			$tel=$row['mtel'];
			$internal=$row['internal'];
			$edari=$row['edari'];
			$name=$row['name'];
			$posh="+98$tel";
			//sendContact($user_id,$posh,$name);
		}

		function getUserPhoto($user_id){
            $url="https://api.telegram.org/bot690747998:AAGh3Rqf1pbNUEC-z_QNp4Pr54fTe_yh6n8/getChat?chat_id=$x";
            $string 	= json_decode(file_get_contents($url));
            $result 	= objectToArray($string);
            global $user_photo_id;
            $user_photo_id 	= $result['result']['photo']['big_file_id'];
        }

	function enteghal($x){
		$url="https://api.telegram.org/bot690747998:AAGh3Rqf1pbNUEC-z_QNp4Pr54fTe_yh6n8/getFile?file_id=$x";
		$string 	= json_decode(file_get_contents($url));
		$result 	= objectToArray($string);
		global $filenames,$file_path;
		$file_path 	= $result['result']['file_path'];
		$filenames=substr($file_path,7);
		copy("https://api.telegram.org/file/bot690747998:AAGh3Rqf1pbNUEC-z_QNp4Pr54fTe_yh6n8/$file_path","./$file_path");
		}

		function enteghalXML($x){
		$url="https://api.telegram.org/bot690747998:AAGh3Rqf1pbNUEC-z_QNp4Pr54fTe_yh6n8/getFile?file_id=$x";
		$string 	= json_decode(file_get_contents($url));
		$result 	= objectToArray($string);
		global $filenames,$file_path;
		$file_path 	= $result['result']['file_path'];
		$filenames=substr($file_path,9);
		copy("https://api.telegram.org/file/bot690747998:AAGh3Rqf1pbNUEC-z_QNp4Pr54fTe_yh6n8/$file_path","./$file_path");
		}

		function coreAPI($function,$variable){
	    global $coreAPI;
            $coreAPI = file_get_contents("http://waleto.ir/asanpardakht/portal/core.php?f=".$function."&v=".$variable);
        }

	function userinfo($x){
	include('config.php');
	$q="SELECT * FROM `users` WHERE `uid`=".$x;
	$r=mysqli_query($cn,$q);
	global $pos,$reg,$edari;
	$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
	$pos=$row['pos'];
	$reg=$row['reg'];
	$edari=$row['edari'];
	}


	function searchUser($user_id,$mtel){
	include('config.php');
	$q="SELECT * FROM `users` WHERE `mtel`='$mtel'";
	$r=mysqli_query($cn,$q);
	$num=mysqli_num_rows($r);
	global $fname,$karbar,$reg,$edari;
	if($num>0){
	$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
	$karbar=1;
	$fname=$row['name'];
	$reg=$row['reg'];
	$person=$row['person'];
	$edari=$row['edari'];
	$q="UPDATE `users` SET `uid`=$user_id WHERE `person`=$person";
	$r=mysqli_query($cn,$q);
	}
	else{
		$karbar=0;
	}
	}

function formPic($adr,$id,$h,$w){
    global $formPic,$site,$hash,$siti;
    $site='http://waleto.ir/asanpardakht/'.$adr.'.php?id='.$id;
    $secret = "TOP SECRET";
    $hash = md5($site.$secret);
    $siti=urlencode($site);
    $formPic=urlencode('http://api.screenshotmachine.com/?key=aaadab&dimension='.$h.'x'.$w.'&device=desktop&format=jpg&hash='.$hash.'&cacheLimit=0&delay=800&url='.$siti);
}

function makepic($page,$id,$w,$h){
	global $keypic,$makepics;
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_HTTPHEADER => array('apikey:24bbb4a4-822d-4af9-83f4-9d6a08cd3468'),
    CURLOPT_URL => 'https://api.screenshotapi.io/capture',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        'url' => "http://waleto.ir/sadad/$page.php?id=$id",
        'webdriver' => 'chrome',
        'fullpage' => 'false',
        'javascript' => 'true',
        'fresh' => 'true',
        'viewport' => "$w".'x'."$h",
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);
	$string 	= json_decode($resp);
	$result 	= objectToArray($string);
	$keypic=$result['key'];
$makepic=file_get_contents('http://waleto.ir/ret.php?key='.$keypic);
}
function watermark($pic){
	include ('lib/WideImage.php');
//load orginal image
$img = WideImage::load("$pic");
$watermark = WideImage::load('wt.png');
$new = $img->merge($watermark, 30, '80%', 30);
$new->saveToFile('http://waleto.ir/asanpardakht/wtt.jpg');
}
function ersalAnswer($cqi,$pos,$code,$mi,$tools){
    include('config.php');
    $q="SELECT * FROM `reject` WHERE `id`='".$code."' ORDER BY `id` DESC";
    $r=mysqli_query($cn,$q);
    $row=mysqli_fetch_array($r,MYSQLI_ASSOC);
    $sup_zaman=$row['zaman'];
    $recep=$row['recep'];
    $pazirande=$row['pazirande'];
    $p_serial = $row['payeserial'];
    $shopname=$row['shopname'];
    $simserial=$row['simserial'];
    $uid=$row['uid'];
    $pinpadserial=$row['pinpadSerial'];
    $serial=$row['serial'];
    $supsign=$row['supsign'];
    $setpic=$row['setpic'];
    $perferaj1005=$row['perferaj1005'];
    $perferaj1025=$row['perferaj1025'];
    $cancelform=$row['cancelform'];
    $damageform=$row['damageForm'];
    if($tools!=='paye' || $tools!=='sim'){
        $tools='pos';
    }
		switch ($pos){
		case 'S':///////////////////STORE
		$text=urlencode("درخواست برای انباردار ارسال شد");
$url= "https://api.telegram.org/bot".$GLOBALS['token']."/answerCallbackQuery?callback_query_id=".$cqi."&text=".$text."&show_alert =true";
	file_get_contents($url);
	$replyMarkup = array('inline_keyboard' => array(array(
		array("text"=>'❌خیر',"callback_data"=>"N-".$code."-".$uid."-".$tools),
		array("text"=>'✅بله',"callback_data"=>"Y-".$code."-".$uid."-".$tools),
		),));
	$aks="";
	if(strlen($setpic)>0){
	    $aks.=urlencode("✅تصویر دستگاه: <a href='http://waleto.ir/asanpardakht/photos/".$setpic."'>کلیک کنید</a>"."\n");
    }
    if(strlen($perferaj1005)>0){
	    $aks.=urlencode("✅پرفراژ1005: <a href='http://waleto.ir/asanpardakht/photos/".$perferaj1005."'>کلیک کنید</a>"."\n");
    }
    if(strlen($perferaj1025)>0){
	    $aks.=urlencode("✅پرفراژ1025: <a href='http://waleto.ir/asanpardakht/photos/".$perferaj1025."'>کلیک کنید</a>"."\n");
    }
    if(strlen($cancelform)>0){
	    $aks.=urlencode("✅فرم انصراف: <a href='http://waleto.ir/asanpardakht/photos/".$cancelform."'>کلیک کنید</a>"."\n");
    }
    if(strlen($damageform)>0){
	    $aks.=urlencode("✅فرم خسارت: <a href='http://waleto.ir/asanpardakht/photos/".$damageform."'>کلیک کنید</a>"."\n");
    }
$q="SELECT * FROM `users` WHERE `uid`='".$uid."' ORDER BY `person` DESC";
		$r=mysqli_query($cn,$q);
		$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
		$memol=$row['memol'];
	ersal($GLOBALS['anbardar'],$memol,$replyMarkup,1);
	update('users','pos',120,$GLOBALS['anbardar']);
	update('users','memo2',$code,$GLOBALS['anbardar']);
	update('users','memo3',$uid,$GLOBALS['anbardar']);
	updatereject('zaman',time(),$code);
		break;
		case 'Y':///////////////////YES
            $q="SELECT * FROM `users` WHERE `uid`=".$uid;//karbar info
            $r=mysqli_query($cn,$q);
            $row=mysqli_fetch_array($r,MYSQLI_ASSOC);
            $memo3 = $row['memo3'];
            $edari = $row['edari'];
            $word = $row['word'];

            if ($edari == 1) {
                $kelid = $GLOBALS['key_main1'];
            } elseif ($edari == 2) {
                $kelid = $GLOBALS['key_main2'];
            } elseif ($edari == 0) {
                $kelid = $GLOBALS['key_main0'];
            }elseif ($edari == 3) {
                $kelid = $GLOBALS['key_main3'];
            }

            updatereject('zamans',time(),$code);
            updatereject('resultpos',1,$code);
            updatereject('store',$GLOBALS['anbardar'],$code);

            $text_reply=urlencode("✅درخواست عودت تجهیزات فروشگاه :".$shopname." توسط انباردار تایید شد");
            $replyMarkup=array('keyboard' => $kelid,'resize_keyboard'=>true);
            ersal($uid,$text_reply,$replyMarkup,1);

            $accept_code  = $code.'.'.'1';
            formPic("reject","$accept_code",1429,"full");
            switch ($word){
                case 'pos':
                    $s_serial = $serial;
                    break;
                case 'paye':
                    $s_serial = $p_serial;
                    break;
                case 'sim':
                    $s_serial = $simserial;
                    break;
                case 'pinpad':
                    $s_serial = $pinpadserial;
                    break;
            }
            $text_reply=urlencode("توضیحات تایید درخواست را وارد کنید");
            $replyMarkup=array('keyboard' => $GLOBALS['key_cancel'],'resize_keyboard'=>true);
            $rp=json_decode($replyMarkup);
            $url= "https://api.telegram.org/bot".$GLOBALS['token']."/sendMessage?chat_id=".$GLOBALS['anbardar']."&text=".$text_reply."&reply_markup=".$rp."&parse_mode=HTML&disable_web_page_preview=true";
            file_get_contents($url);
            update('users','login',time(),$GLOBALS['anbardar']);
            update('users','pos',998,$GLOBALS['anbardar']);
            update('users','memo4',$uid,$GLOBALS['anbardar']);
            update('users','memo1',$code,$GLOBALS['anbardar']);
		break;
		case 'N':///////////////////NO
		include('config.php');
		$q="SELECT * FROM `reject` WHERE `id`=$code";
		$r=mysqli_query($cn,$q);
		$row=mysqli_fetch_array($r,MYSQLI_ASSOC);
		$uid=$row['uid'];
		$text_reply=urlencode("درخواست رد شد");
		$url= "https://api.telegram.org/bot".$GLOBALS['token']."/answerCallbackQuery?callback_query_id=".$cqi."&text=".$text_reply."&show_alert =true";
		file_get_contents($url);
		$text_reply=urlencode("علت رد درخواست را وارد کنید");
	$replyMarkup=array('keyboard' => $GLOBALS['key_cancel'],'resize_keyboard'=>true);
	$rp=json_decode($replyMarkup);
	$url= "https://api.telegram.org/bot".$GLOBALS['token']."/sendMessage?chat_id=".$GLOBALS['anbardar']."&text=".$text_reply."&reply_markup=".$rp."&parse_mode=HTML&disable_web_page_preview=true";
	file_get_contents($url);
	update('users','login',time(),$GLOBALS['anbardar']);
	update('users','pos',999,$GLOBALS['anbardar']);
	update('users','memo4',$uid,$GLOBALS['anbardar']);
	update('users','memo1',$code,$GLOBALS['anbardar']);
    updatereject('resultpos',2,$code);
		break;
		}
}

function selectSim($id)
{
    include('configS.php');
    global $s_pazirande,$s_shopname,$s_simserial,$s_payane;
    $qqq = "SELECT * FROM `pazirande` WHERE `simSerial`='".$id."' ORDER BY `pid` ASC";
    $r = mysqli_query($cn,$qqq);
    $num = mysqli_num_rows($r);
    if($num>0){
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
        $s_pazirande = $row ['pazirandeCode'];
        $s_shopname = $row ['shopName'];
        $s_simserial = $row ['simSerial'];
        $s_payane = $row ['payaneCode'];
    }
    else{
        $s_pazirande = '-';
        $s_shopname = '-';
        $s_simserial = '-';
        $s_payane = '-';
    }
}

function selectPaye($id)
{
    include('configS.php');
    global $s_pazirande,$s_shopname,$s_payane;
    $qqq = "SELECT * FROM `pazirande` WHERE `payaneGroup`='پايه پوز' AND `payaneSerial`= '".$id."' ORDER BY `pid` ASC";
    $r = mysqli_query($cn,$qqq);
    $num = mysqli_num_rows($r);
    if($num>0){
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
        if($row['endDate']>0){
            $s_pazirande = '*';
            $s_shopname = '-';
            $s_payane='-';
        }
        else{
            $s_pazirande = $row ['pazirandeCode'];
            $s_shopname = $row ['shopName'];
            $s_payane = $row ['payaneCode'];
        }
    }
    else{
        $s_pazirande = '-';
        $s_shopname = '-';
        $s_payane='-';
    }
}

function selectPinPad($id)
{
    include('configS.php');
    global $s_pazirande,$s_shopname,$s_payane,$_payaneModel;
    $qqq = "SELECT * FROM `pazirande` WHERE `payaneSerial`= '".$id."' ORDER BY `pid` ASC";
    $r = mysqli_query($cn,$qqq);
    $num = mysqli_num_rows($r);
    if($num>0){
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
        if($row['endDate']>0){
            $s_pazirande = '*';
            $s_shopname = '-';
            $s_payane='-';
        }
        else{
            $s_pazirande = $row ['pazirandeCode'];
            $s_shopname = $row ['shopName'];
            $s_payane = $row ['payaneCode'];
            $_payaneModel = $row ['payaneModel'];
        }
    }
    else{
        $s_pazirande = '-';
        $s_shopname = '-';
        $s_payane='-';
    }
}

function simPos($simserial){
    global $sim_pos,$sim_posi;
    include ('configS.php');
    $q = "SELECT * FROM `sim` WHERE `serial`='".$simserial."'";
    $r = mysqli_query($cn,$q);
    $num=mysqli_num_rows($r);
    if($num>0){
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
        $sim_posi = $row['pos'];
        switch ($sim_posi){
            case "تخصیص خورده":
                $sim_pos = 1;
                break;
            case "تسویه مفقودی":
                $sim_pos = 2;
                break;
            case "تخصیص نخورده":
                $sim_pos = 3;
                break;
        }
    }
    else{
        $sim_posi = 'یافت نشد';
        $sim_pos=0;
    }

}

function findReject($user_id,$recep)
{
    include('config.php');
    $q = "SELECT * FROM `reject` WHERE `recep`='".$recep."' AND `uid`='".$user_id."' ORDER BY `id` DESC";
    $r = mysqli_query($cn,$q);

    global $rejectCount, $rejectId, $rejectPos;
    $rejectCount = mysqli_num_rows($r) ;
    if($rejectCount>0) {
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
        $rejectId = $row['id'];
        $rejectPos = $row['resultpos'];
    }

}

function findRejectSim($user_id,$sim)
{
    include('config.php');
    $q = "SELECT * FROM `reject` WHERE `simserial`='".$sim."' AND `uid`='".$user_id."' ORDER BY `id` DESC";
    $r = mysqli_query($cn,$q);

    global $rejectCount, $rejid, $rejectPos;
    $rejectCount = mysqli_num_rows($r) ;
    if($rejectCount>0) {
        $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
        $rejid = $row['id'];
        $rejectPos = $row['resultpos'];
    }

}

function selectBranch($city,$edari){
    include('config.php');
    if($edari>0){
        $q = "SELECT * FROM `users` WHERE `edari`=$edari ORDER BY `uid` ASC";
    }
    else {
        $q = "SELECT * FROM `users` WHERE `city`='" . $city . "' AND `edari`=$edari ORDER BY `uid` ASC";
    }
    $r=mysqli_query($cn,$q);
    global $selectBranch;
    $selectBranch=array();
    $num=mysqli_num_rows($r);
    $baghi=fmod($num,2);
    if($baghi==0){
        for($i=0;$i<$num/2;$i++){
            $row=mysqli_fetch_array($r,MYSQLI_ASSOC);
            $name1=$row['name'];
            $row=mysqli_fetch_array($r,MYSQLI_ASSOC);
            $name2=$row['name'];
            $selectBranch[]=array($name2,$name1);
        }
    }
    else{
        $numr=round($num/2,0)-1;
        for($i=0;$i<$numr;$i++){

            $row=mysqli_fetch_array($r,MYSQLI_ASSOC);
            $name1=$row['name'];
            $row=mysqli_fetch_array($r,MYSQLI_ASSOC);
            $name2=$row['name'];
            $selectBranch[]=array($name2,$name1);
        }
        $row=mysqli_fetch_array($r,MYSQLI_ASSOC);
        $name1=$row['name'];
        $selectBranch[]=array($name1);

    }
    $selectBranch[]=array('انصراف❌');
}

function selectBranchInfo($name){
    include('config.php');
    $q="SELECT * FROM `users` WHERE `name`='".$name."' ORDER BY `uid` DESC";
    $r=mysqli_query($cn,$q);
    $row=mysqli_fetch_array($r,MYSQLI_ASSOC);
    global $br_mtel,$br_internal;
    $br_mtel=$row['mtel'];
    $br_internal=$row['internal'];
}

function odatTajhiz($user_id)
{
    global $ellat;
    $ellat = array(
        "1" => "جمع آوری موظفی",
        "2" => "جمع آوری مدیریتی",
        "3" => "انصراف پذیرنده",
        "4" => "عدم حضور پذیرنده",
        "5" => "عدم تحویل مدارک",
        "6" => "خرابی چاپگر",
        "7" => "خرابی صفحه کلید یا مگنت",
        "8" => "Tamperd/PedLock",
        "9" => "عدم ارتباط",
        "10" => "اشتباه در تخصیص",
        "11" => "سایر موارد",
        "12" => "خسارت",
    );
global $test;
    selectusers($user_id);
    selectreject($GLOBALS['memo1']);
    selectRecName($GLOBALS['memo3']);
    chkVip($GLOBALS['recpazir']);
    if ($GLOBALS['vipCount'] > 0) {
        if ($GLOBALS['chkVip_noe'] == 'vip') {
            $vnoe = 'Vip';
        } elseif ($GLOBALS['chkVip_noe'] == 'sepah') {
            $vnoe = 'Sepah';
        }
    } else {
        $vnoe = 'عادی';
    }
    if($GLOBALS['reson']>5 AND $GLOBALS['reson']<5.5){
        $x = explode(".",$GLOBALS['reson']);
        switch ($x[1]){
            case 1:
                $rs = "عدم تحویل مدارک - الحاقیه";
                break;
            case 2:
                $rs = "عدم تحویل مدارک - جواز";
                break;
            case 3:
                $rs = "عدم تحویل مدارک - مدارک شناسایی";
                break;
            case 4:
                $rs = "عدم تحویل مدارک - قرارداد";
                break;
        }
    }
    else{
        $rs = $GLOBALS['reson'] . "(" . $ellat[$GLOBALS['reson']] . ")";
    }
    if(strlen($GLOBALS['takhsis'])>2){
        $takh = "مدل مورد نیاز:" . $GLOBALS['takhsis'];
    }
    else{
        $takh = '';
    }

    if(strlen($GLOBALS['tanaghoz'])>0){
        switch ($GLOBALS['tanaghoz']){
            case 'simserial':
                $tanag_sim = "\n".'⛔سریال سیم کارت تناقض دارد';
                break;
            case 'pinpad':
                $tanag_pin = "\n".'⛔سریال پین پد تناقض دارد';
                break;
            case 'payepos':
                $tanag_paye = "\n".'⛔سریال پایه پوز تناقض دارد';
                break;
        }
    }
    else{
        $tanag_sim = '';
        $tanag_pin = '';
        $tanag_paye = '';
    }

    $report = urlencode(
        "⚠️عودت تجهیزات به انبار️⚠️
	کد پایانه: " . $GLOBALS['recep'] . "
	کد پذیرنده: " . $GLOBALS['pazirande'] . "
	نوع پذیرنده: " . $vnoe . "
	نام فروشگاه: " . $GLOBALS['shopname'] . "
	سریال دستگاه: " . $GLOBALS['serial'] . "
	مدل دستگاه: " . $GLOBALS['model'] . "
	آداپتور: " . $GLOBALS['adapt'] . "
	علت عودت: " . $rs."
	 ".$takh."
	وضعیت: " . $GLOBALS['pos'] . "\n🔸🔸🔸🔸");
    if ($GLOBALS['paye'] > 0) {
        if ($GLOBALS['zirpaye'] > 0) {
            $zz = 'دارد';
        } else {
            $zz = 'ندارد';
        }
        $a_paye = urlencode("
	پایه: دارد
	سریال پایه: " . $GLOBALS['payeserial'] .
     $tanag_paye."
	زیر پایه: " . $zz . "
	علت عودت: " . $GLOBALS['payerej'] . "(" . $ellat[$GLOBALS['payerej']] . ")
	وضعیت: " . $GLOBALS['payepos'] . "
	🔸🔸🔸🔸
	");
    } else {
        $a_paye = urlencode("\nپایه پوز: ندارد
	🔸🔸🔸🔸\n");
    }

    if ($GLOBALS['rej_sim'] > 0) {
        $a_sim = urlencode("سیم کارت: دارد
	سریال سیم کارت: " . $GLOBALS['rej_simserial'] .
            $tanag_sim."
	🔸🔸🔸🔸\n");
    } else {
        $a_sim = urlencode("سیم کارت: ندارد
	🔸🔸🔸🔸\n");
    }

    if ($GLOBALS['pinpad'] > 0) {
        $a_pinpad = urlencode("پین پد: دارد
	سریال پین پد: " . $GLOBALS['ppserial'].
            $tanag_pin."
	🔸🔸🔸🔸\n");
    } else {
        $a_pinpad = urlencode("\nپین پد: ندارد
	🔸🔸🔸🔸\n");
    }

    $tarikh = date("Ymd", $GLOBALS['zaman']);
    $tarikhi = date("H:i:s", $GLOBALS['zaman']);
    $date = date_create($tarikh);
    date_add($date, date_interval_create_from_date_string("0 days"));
    $ztahvil = date_format($date, "Y-m-d");
    $timezone = 0;//برای 3:30 عدد 12600 و برای 4:30 عدد 16200 را تنظیم کنید
    $now = date($ztahvil, time() + $timezone);
    $time = date("H:i:s", time() + $timezone);
    list($year, $month, $day) = explode('-', $now);
    list($hour, $minute, $second) = explode(':', $time);
    $timestamp = mktime($hour, $minute, $second, $month, $day, $year);
    $jalali_date = jdate("Y/m/d", $timestamp);
    $zamani2 = $jalali_date;//utf8_encode($jalali_date);

    $posht = urlencode("پشتیبان: " . "<a href='tg://user?id=".$user_id."'>".$GLOBALS['karbar'] . "</a> \n توضیحات پشتیبان: ". $GLOBALS['suppdesc'] ."
تاریخ ثبت: " . $zamani2." _ ".$tarikhi) ;
$aks="\n";
if (strlen($GLOBALS['setpic'])>0){$aks.="✅تصویر دستگاه: <a href='http://waleto.ir/asanpardakht/photos/" . $GLOBALS['setpic'] . "'>کلیک کنید</a>\n";}
if (strlen($GLOBALS['p1005'])>0){$aks.="✅پرفراژ1005: <a href='http://waleto.ir/asanpardakht/photos/" . $GLOBALS['p1005'] . "'>کلیک کنید</a>\n";}
if (strlen($GLOBALS['p1025'])>0){$aks.="✅پرفراژ1025: <a href='http://waleto.ir/asanpardakht/photos/" . $GLOBALS['p1025'] . "'>کلیک کنید</a>\n";}
if (strlen($GLOBALS['pcancel'])>0){$aks.="✅فرم انصراف: <a href='http://waleto.ir/asanpardakht/photos/" . $GLOBALS['pcancel'] . "'>کلیک کنید</a>\n";}
if (strlen($GLOBALS['pdamage'])>0){$aks.="✅فرم خسارت: <a href='http://waleto.ir/asanpardakht/photos/" . $GLOBALS['pdamage'] . "'>کلیک کنید</a>\n";}
if (strlen($GLOBALS['allequip'])>0){$aks.="✅تصویر تجهیزات: <a href='http://waleto.ir/asanpardakht/photos/" . $GLOBALS['allequip'] . "'>کلیک کنید</a>\n";}
    $text_reply .= $report . $a_paye . $a_sim . $a_modem . $a_pinpad . $posht  .  urlencode($aks) ;
    $wpic .= $report . $a_paye . $a_sim . $a_modem . $a_pinpad . $posht  . urlencode($aks) ;
    update('users', 'memol', $wpic, $user_id);
    $replyMarkup = array('inline_keyboard' => array(array(
        array("text" => "انصراف❌", "callback_data" => "c-" . $GLOBALS['rejid'] . "-" . $user_id),
        array("text" => "ارسال به انبار🛵", "callback_data" => "S-" . $GLOBALS['rejid'] . "-" . $user_id),
    ),));
    ersal($user_id, $text_reply, $replyMarkup, 1);
    update('users', 'mid', $message_id, $user_id);
    update('users', 'login', time(), $user_id);
    update('users', 'pos', 110, $user_id);

}

function excelReport($part,$day,$user_id){
	    include ('include.php');
	    $time_report = time()-($day*86400*30);
	    switch ($part){
            case 'odat':
            ersalpic($user_id, "http://waleto.ir/asanpardakht/excel.jpg",
                urlencode("http://waleto.ir/asanpardakht/excel.php?s=".$time_report));
                break;
        }
}

function set_type($model,$user_id)
{
    global $set_type,$keys_type;
    include('config.php');
    $q = "SELECT * FROM `setType` WHERE `model` LIKE '%$model%'";
    $r = mysqli_query($cn,$q);
    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
    $set_type = $row['type'];

        $keys_type = array();
        $w = "SELECT * FROM `setType` WHERE `type`=".$set_type;
        $z = mysqli_query($cn, $w);
        $num = mysqli_num_rows($z);
        $baghi = fmod($num, 2);
        if ($baghi == 0) {
            for ($i = 0; $i < $num / 2; $i++) {
                $row = mysqli_fetch_array($z,MYSQLI_ASSOC);
                $name1 = $row['sign'];
                $row = mysqli_fetch_array($z,MYSQLI_ASSOC);
                $name2 = $row['sign'];
                $keys_type[] = array($name2, $name1);
            }
            $keys_type[] = array('انصراف از عودت کالا❌');
        } else {
            $numr = round($num / 2, 0) - 1;
            for ($i = 0; $i < $numr; $i++) {
                $row = mysqli_fetch_array($z,MYSQLI_ASSOC);
                $name1 = $row['sign'];
                $row = mysqli_fetch_array($z,MYSQLI_ASSOC);
                $name2 = $row['sign'];
                $keys_type[] = array($name2, $name1);
            }
            $q = "SELECT * FROM `setType` WHERE `type`=0 ORDER BY `sid` DESC LIMIT 0,1";
            $r = mysqli_query($cn,$q);
            $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
            $name3 = $row['sign'];
            $keys_type[] = array($name3);
            $keys_type[] = array('انصراف از عودت کالا❌');
        }

        if($set_type==0){
            $text_reply = "از دستگاه های ثابت زیر مدل مورد نظر را انتخاب کنید";
        }
        else{
            $text_reply = "از دستگاه های بیسیم زیر مدل مورد نظر را انتخاب کنید";
        }
    $replyMarkup = array('keyboard' => $keys_type, 'resize_keyboard' => true);
    ersal($user_id, $text_reply, $replyMarkup, 1);
}

function set_type_search($type){
	    include ("config.php");
    $w = "SELECT * FROM `setType` WHERE `sign`='".$type."'";
    $z = mysqli_query($cn, $w);
    $num = mysqli_num_rows($z);
    global $set_type_search,$set_type_num;
    if($num>0) {
        $set_type_num = $num;
        $row = mysqli_fetch_array($z, MYSQLI_ASSOC);
        $set_type_search = $row['model'];
    }
    else{
        $set_type_num = 0;
    }
}

function sendMessage($group,$text){
    include ("config.php");
    switch ($group){
        case 'پشتیبان':
            $edari = 0;
            break;
        case 'اداری':
            $edari = 1;
            break;
        case 'انباردار':
            $edari = 2;
            break;
    }
    $w = "SELECT * FROM `users` WHERE `edari`=".$edari." AND `uid`>0";
    $z = mysqli_query($cn, $w);
    $num = mysqli_num_rows($z);
    $replyMarkup = array('keyboard' => array(array('')), 'resize_keyboard' => true);
    for($i=0; $i<$num; $i++) {
        $row = mysqli_fetch_array($z,MYSQLI_ASSOC);
        ersal($row['uid'],$text,$replyMarkup,1);
    }
    global $message_count;
    $message_count = $num;
}

function resetFactory($user_id){
    update('users', 'pos', 1, $user_id);
    update('users', 'memo1', NULL, $user_id);
    update('users', 'memo2', NULL, $user_id);
    update('users', 'memo3', NULL, $user_id);
    update('users', 'memo4', NULL, $user_id);
    update('users', 'memol', NULL, $user_id);
    update('users', 'paye', NULL, $user_id);
    update('users', 'sim', NULL, $user_id);
    update('users', 'modem', NULL, $user_id);
    update('users', 'login', time(), $user_id);
}

function botActive($pos){
	    include ("config.php");
	    $q = "UPDATE `settings` SET `active`=".$pos." WHERE 1";
	    $r = mysqli_query($cn,$q);
    $w = "SELECT * FROM `settings` WHERE 1";
    $z = mysqli_query($cn,$w);
    $row = mysqli_fetch_array($z,MYSQLI_ASSOC);
    global $botActive;
    $botActive = $row['active'];
}

function searchkarabr($text)
{
    include('config.php');
    $q = "SELECT * FROM `users` WHERE `name` LIKE '%$text%'";
    $r = mysqli_query($cn,$q);
    global $karbar_count,$karbar_login,$karbar_name,$karbar_id,$karbar_tel,$karbar_addr,$karbar_lvl,$karbar_store;
    $karbar_count = mysqli_num_rows($r);
    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
    $karbar_tel = $row['mtel'];
    $karbar_name = $row['name'];
    $karbar_addr = $row['city'];
    $karbar_lvl = $row['edari'];
    $karbar_id = $row['uid'];
    $karbar_store = $row['storeres'];
    $karbar_login = $row['login'];
}

function searchkarabrID($text)
{
    include('config.php');
    $q = "SELECT * FROM `users` WHERE `uid`=".$text;
    $r = mysqli_query($cn,$q);
    global $karbar_count,$karbar_login,$karbar_name,$karbar_store,$karbar_tel,$karbar_addr,$karbar_active,$karbar_lvl;
    $karbar_count = mysqli_num_rows($r);
    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);
    $karbar_tel = $row['mtel'];
    $karbar_name = $row['name'];
    $karbar_addr = $row['city'];
    $karbar_lvl = $row['edari'];
    $karbar_store = $row['storeres'];
    $karbar_login = $row['login'];
}
	?>