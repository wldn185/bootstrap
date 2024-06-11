<?php
  include('dbconn.php');

  $id = $_POST['id'];
  $pwd = trim($_POST['pwd']);
  // // $pwd = "select pwd from  fre_board where id ='$id'";
  $id = mysqli_real_escape_string($conn,$id);
  $pwd = mysqli_real_escape_string($conn,$pwd);
  
  // // echo $pwd . '<br>';
  // // echo $id;
  
  
  // // $pwd = PASSWORD('pwd');
  // $sql = "select * from fre_board where id='$id' and pwd=('$pwd')";
  $sql = "SELECT pwd FROM free_board WHERE id = '$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  
  //input에 입력된 비밀번호를 가져오기
  $hapwd = $row['pwd'];
  
  
  //데이터베이스 패스워드 같음 $hapwd
  echo $hapwd;
  
  // 만약에 넘겨받은  패스워드가  일치하면 삭제
  // $pwd == $row['pwd']
  // password_verify($hapwd, $row['pwd'])
  
  // 만약에 넘겨받은 아이디값이 없다면
  if(password_verify($pwd, $hapwd)){
    //아이디와 패스워드가 일치된다면 아래 쿼리가 실행하여 게시물 삭제
    $sql = "delete from free_board where id='$id'";
    $result = mysqli_query($conn, $sql);
    //삭제하고 list 화면으로 이동하기
    echo "<script>alert('삭제되었습니다')</script>";
    echo "<script>location.replace('../list.php')</script>";
    exit;
  }else{
    echo "<script>alert ('패스워드가 일치하지 않습니다. 다시확인하세요')</script>";
    //이전페이지로 이동
    echo "<script>history.back(1);</script>";
    exit;
  }

?>