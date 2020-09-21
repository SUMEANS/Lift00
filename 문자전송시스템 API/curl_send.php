<?php
function plus(){
	 $connect = mysqli_connect('localhost','sumean','Whoami21?','db') or die("fail");
	  $query = "select pn from sms";
	  $result = mysqli_query($connect, $query);
	  $n = mysqli_num_rows($result);
	  $last = array();

	  for($i=0;$i<$n;$i=$i+1){
		  $row = mysqli_fetch_row($result);
		   $last[$i] = $row[0];
	  }

	  $receivers = implode(',', $last);
	  return $receivers;
}





/****************** 인증정보 시작 ******************/
$sms_url = "https://apis.aligo.in/send/"; // 전송요청 URL
$sms['user_id'] = "ghkdtnals21"; // SMS 아이디
$sms['key'] = "x1sq2t6hgew885euh0yhqrmmui65vr6m";//인증키
/****************** 인증정보 끝 ********************/

/****************** 전송정보 설정시작 ****************/
$_POST['msg'] = '현재고객님의 거처에 낙상이 감지되었습니다'; // 메세지 내용 : euc-kr로 치환이 가능한 문자열만 사용하실 수 있습니다. (이모지 사용불가능)
$_POST['receiver'] = plus();
$_POST['destination'] = '01072227586|티엘비즈,01086604566|티엘비즈'; // 수신인 %고객명% 치환
$_POST['sender'] = "01056620434"; // 발신번호
$_POST['rdate'] = ''; // 예약일자 - 20161004 : 2016-10-04일기준
$_POST['rtime'] = ''; // 예약시간 - 1930 : 오후 7시30분
$_POST['testmode_yn'] = 'N'; // Y 인경우 실제문자 전송X , 자동취소(환불) 처리
$_POST['subject'] = ''; //  LMS, MMS 제목 (미입력시 본문중 44Byte 또는 엔터 구분자 첫라인)
// $_POST['image'] = '/tmp/pic_57f358af08cf7_sms_.jpg'; // MMS 이미지 파일 위치 (저장된 경로)
$_POST['msg_type'] = 'SMS'; //  SMS, LMS, MMS등 메세지 타입을 지정
// ※ msg_type 미지정시 글자수/그림유무가 판단되어 자동변환됩니다. 단, 개행문자/특수문자등이 2Byte로 처리되어 SMS 가 LMS로 처리될 가능성이 존재하므로 반드시 msg_type을 지정하여 사용하시기 바랍니다.
/****************** 전송정보 설정끝 ***************/

$sms['msg'] = stripslashes($_POST['msg']);
$sms['receiver'] = $_POST['receiver'];
$sms['destination'] = $_POST['destination'];
$sms['sender'] = $_POST['sender'];
$sms['rdate'] = $_POST['rdate'];
$sms['rtime'] = $_POST['rtime'];
$sms['testmode_yn'] = empty($_POST['testmode_yn']) ? '' : $_POST['testmode_yn'];
$sms['title'] = $_POST['subject'];
$sms['msg_type'] = $_POST['msg_type'];
// 만일 $_FILES 로 직접 Request POST된 파일을 사용하시는 경우 move_uploaded_file 로 저장 후 저장된 경로를 사용하셔야 합니다.
if(!empty($_FILES['image']['tmp_name'])) {
	$tmp_filetype = mime_content_type($_FILES['image']['tmp_name']); 
	if($tmp_filetype != 'image/png' && $tmp_filetype != 'image/jpg' && $tmp_filetype != 'image/jpeg') $_POST['image'] = '';
	else {
		$_savePath = "./".uniqid(); // PHP의 권한이 허용된 디렉토리를 지정
		if(move_uploaded_file($_FILES['file']['tmp_name'], $_savePath)) {
			$_POST['image'] = $_savePath;
		}
	}
}
// 이미지 전송 설정
if(!empty($_POST['image'])) {
	if(file_exists($_POST['image'])) {
		$tmpFile = explode('/',$_POST['image']);
		$str_filename = $tmpFile[sizeof($tmpFile)-1];
		$tmp_filetype = mime_content_type($_POST['image']);
		if ((version_compare(PHP_VERSION, '5.5') >= 0)) { // PHP 5.5버전 이상부터 적용
			$sms['image'] = new CURLFile($_POST['image'], $tmp_filetype, $str_filename);
			curl_setopt($oCurl, CURLOPT_SAFE_UPLOAD, true);
		} else {
			$sms['image'] = '@'.$_POST['image'].';filename='.$str_filename. ';type='.$tmp_filetype;
		}
	}
}
/*****/
$host_info = explode("/", $sms_url);
$port = $host_info[0] == 'https:' ? 443 : 80;

$oCurl = curl_init();
curl_setopt($oCurl, CURLOPT_PORT, $port);
curl_setopt($oCurl, CURLOPT_URL, $sms_url);
curl_setopt($oCurl, CURLOPT_POST, 1);
curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
$ret = curl_exec($oCurl);
curl_close($oCurl);

echo $ret;
$retArr = json_decode($ret); // 결과배열
mysqli_close($connect);
