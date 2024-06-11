<?php
  include('dbconn.php'); //db계정과 연결

  $id = $_POST['id'];
  $title = $_POST['title'];
  $name = $_POST['name'];
  $txtbox = nl2br($_POST['txtbox']);
  $pwd = $_POST['pwd'];

  //nl2br : 데이터 입력시 텍스트 정보는 그대로 입력되고, 출력시에만 br태그 사용한 것처럼 자동 줄 변경이 됨.

  // 보완성을 위해 써줌
  $id = mysqli_real_escape_string($conn, $id);
  $title = mysqli_real_escape_string($conn, $title);
  $name = mysqli_real_escape_string($conn, $name);
  $txtbox = mysqli_real_escape_string($conn, $txtbox);
  $pwd = mysqli_real_escape_string($conn, $pwd);

  /*
  mysqli_real_escape_string
  php에서 제공하는 함수로서 MYSQL과 커넥션을 할 때 string을 Escape한 상태로 만들어주는 함수
  string을 입력할 때 jeon's person 처럼 sql문에 앞서 있던 '기호와 중첩이 될 수 있다. 이러한 문제를 해결하기 위해서 \n, \r, \" 처럼 구별해주는 형태로 만들어주는 것을 escape_string이라고 한다.

  예) select * from table where ''
  */


  date_default_timezone_set('Asia/Seoul');
  $datetime = date('Y-m-d H:i:s');

  // 값출력하기 테스트
  // echo $id . '<br>';
  // echo $title . '<br>';
  // echo $name . '<br>';
  // echo $txtbox . '<br>';
  // echo $pwd . '<br>';
  // echo $datetime;

  // 사용자 아이피주소 가져오기
  $ip =$_SERVER['SERVER_ADDR']; //사용자가 접속한 IP주소를 가져옴.
  // echo $ip;

  //수정버튼 클릭시 update구문
  if($id){ //사용자가 수정한 아이디 값이 같을 경우 (id가 있을때)
    $sql = "select * from free_board where id='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

    if(password_verify($pwd, $row['pwd'])){
      $sql = "update free_board set subject='$title', memo='$txtbox' where id='$id'";
      mysqli_query($conn,$sql);
      echo "<script>location.replace('../view.php?id=$id');</script>";
    }else{ // 패스워드가 다를 경우
      echo "<script>alert('패스워드가 다릅니다. 다시 확인하세요.');</script>";
      echo "<script>location.replace('../update.php?id=$id');</script>";
      exit;
    }
  }else{ //새롭게 작성할 때 (id가 없을 때)
    // 패스워드 암호화
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $datetime = date("Y-m-d H:i:s");
    $ip = $_SERVER['REMOTE_ADDR'];
    // db insert문을 사용하여 데이터에 자료 입력하기
    $sql = "insert into free_board(subject, name, memo, pwd, datetime, ip) value('$title', '$name', '$txtbox', '$pwd', '$datetime', '$ip')";

    $result = mysqli_query($conn, $sql);

    if($result){
      echo "<script>alert('글작성이 완료되었습니다.');</script>";
      echo "<script>location.replace('../list.php');</script>";
      exit;
    }else{
      echo "글입력 실패 : " . mysqli_error($conn);
      mysqli_close($conn); //데이터베이스 접속종료
    }
  }












  
  

  
?>