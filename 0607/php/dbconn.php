<?php
  $mysql_host='localhost'; //호스트명
  $mysql_user='root'; //사용자명
  $mysql_password='1234'; //패스워드
  $mysql_db='project'; //데이터베이스명

  //데이터베이스 연결을 위한 변수 생성
  $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

  if(!$conn){ //연결오류 발생시 스크립트 종료한다.
    die("연결실패 : " . mysqli_connect_error());
  }

	ini_set('display_errors', 'ON'); //에러 메세지 출력
?>