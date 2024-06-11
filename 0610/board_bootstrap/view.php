<?php
  include('./php/dbconn.php');

  $id = $_GET['id'];
  $id = mysqli_real_escape_string($conn, $id);

  // echo $id; //넘겨받은 id값 출력해보기
  $sql = "select * from free_board where id='$id'";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
?>
<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>글내용보기</title>
    <!-- 부트스트랩 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>      
      caption{display:none}
      a{text-decoration: none; color: #333;}
      section{width:90%; margin: 0 auto}
      section th{width:20%}
    </style>
    <!-- 부트스트랩 js -->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>  
  <body>
    <form name="글내용보기" method="post" action="./php/delete.php">
      <input type="hidden" name="id" value="<?php echo $row['id']?>">
      <main>
        <section>
          <h2>글내용 보기</h2>
          <table class="table">
            <caption>글내용보기</caption>
            <tr>
              <th class="table-secondary">No.</th>
              <td><?php echo $row['id']?></td>
            </tr>
            <tr>
              <th class="table-secondary">작성자</th>
              <td><?php echo $row['name']?></td>
            </tr>
            <tr>
              <th class="table-secondary">제목</th>
              <td><?php echo $row['subject']?></td>
            </tr>
            <tr>
              <th class="table-secondary">내용</th>
              <td><?php echo $row['memo']?></td>
            </tr>
            <tr>  
              <th class="table-secondary">작성날짜</th>
              <td><?php echo substr($row['datetime'],0,10)?></td>
            </tr>
            <tr>
              <th class="table-secondary"><label for="pwd">비밀번호 : </label></th>
              <td><input type="password" id="pwd" name="pwd" class="form-control"></td>
            </tr>
          </table>
          <p class="text-start">          
            <a href='update.php?id=<?=$row['id']?>' title="수정하기" class="btn btn-primary">수정하기</a>
            <input type="submit" value="삭제" class="btn btn-danger" onclick='return formCheck();'></a>     
            <a href="list.php" title='목록' class="btn btn-secondary" style="float:right">목록</a>
          </p>
        </section>
      </main>    
    </form>
    <script>
      function formCheck(){
        // alert('dsfa');
        let pwd = document.getElementById('pwd').value;
        // console.log(pwd);
        if(pwd.length<1){
          alert('패스워드를 입력해주세요');
          document.getElementById('pwd').focus();
          return false;
        }else{
          return true;
        }
      }
    </script>
  </body>
</html>