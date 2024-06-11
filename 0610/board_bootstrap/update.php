<?php
  include('./php/dbconn.php');

  //view.php에서 넘겨진 id값을 받아서 출력
  $id = $_GET['id'];
  $id = mysqli_real_escape_string($conn, $id);
  // echo $id;

  $sql = "select * from free_board where id='$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  // echo $row[0] . 'id 변경안함<br>';
  // echo $row[1] . '<br>';
  // echo $row[2] . 'name 변경안함<br>';
  // echo $row[3] . '<br>';
  // echo $row[4] . '<br>';
  // echo date("Y-m_d", strtotime($row[5])) . '<br>';


?>

<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>자유게시판 - 글수정하기</title>
    <!-- 부트스트랩 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      caption{display:none}
      section.board{width:90%; margin: 0 auto}
    </style>
    <!-- 부트스트랩 js -->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
  <body>
    <form name="글수정하기" method="post" action="./php/dbinput.php" onsubmit="return formCheck();">
      <section class="board">
        <h2>게시판 글 수정</h2>
        <table class="table">
          <caption>글쓰기</caption>
          <thead>
            <input type="hidden" name="id" value="<?php echo $row['id']?>">
            <tr>
              <th scope="row" class="table-secondary"><label for="title">글제목</label></td>
              <td scope="row"><input type="text" maxlength="255" id="title" name="title" value="<?php echo $row[1] ?>" class="form-control"></td>
            </tr>
          </thead>

          <tbody>
            <tr>
              <th class="table-secondary"><label for="name">작성자</label></td>
              <td><input type="text" maxlength="50" id="name" name="name" value="<?php echo $row[2] ?>" readonly class="form-control"></td>
            </tr>
            <tr>
              <th class="table-secondary"><label for="txtbox">내용</label></td>
              <td><textarea cols="50" rows="30" id="txtbox" name="txtbox" class="form-control" style='height:200px; resize:none'><?php echo $row[3] ?></textarea></td>
            </tr>
            <tr>
              <th class="table-secondary"><label for="pwd">비밀번호</label></td>
              <td><input type="password" maxlength="255" id="pwd" name="pwd" class="form-control"></td>
            </tr>
          </tbody>
        </table>
        <p class="text-center">         
          <input type="submit" value="글입력 완료" class="btn btn-primary">
          <input type="reset" value="입력 취소" class="btn btn-secondary">
        </p>
      </section>
    </form>

    <script>
      // 유효성검사
      function formCheck(){
        //제목체크
        if(document.getElementById('title').value.length<1){
          alert('제목을 입력하세요.');
          document.getElementById('title').focus();
          return false;
        }
        //내용체크
        if(document.getElementById('txtbox').value.trim().length===0){
          alert('내용을 입력하세요.');
          document.getElementById('txtbox').focus();
          return false;
        }
        //패스워드체크
        if(document.getElementById('pwd').value.length<1){
          alert('비밀번호를 입력하세요.');
          document.getElementById('pwd').focus();
          return false;
        }
        return true;
      }
    </script>
  </body>
</html>