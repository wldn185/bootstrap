<?php
  include('dbconn.php');

  $id = $_POST['id'];
  $title = $_POST['title'];
  $txtbox = nl2br($_POST['txtbox']);
  $pwd = $_POST['pwd'];

  //echo $id;
  // echo $title;
  // echo $txtbox;
  // echo $pwd;

  //보완성을 위해 써줌
  $id = mysqli_real_escape_string($conn, $id);
  $title = mysqli_real_escape_string($conn, $title);
  $txtbox = mysqli_real_escape_string($conn, $txtbox);
  $pwd = mysqli_real_escape_string($conn, $pwd);

  $sql = "update free_board set subject='$title', memo='$txtbox' where id='$id'";
  $result = mysqli_query($conn, $sql);

  if($result){
    echo "<script>alert('글수정이 완료되었습니다.');</script>";
    echo "<script>location.replace('../list.php');</script>";
    exit;
  }else{
    echo "글수정 실패 : " . mysqli_error($conn);
    mysqli_close($conn); //데이터베이스 접속종료
  }
?>