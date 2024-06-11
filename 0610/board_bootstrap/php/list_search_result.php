<?php
  include('dbconn.php'); //db계정과 연결

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
      table tr th:first-child{width:6%}
      table tr th:nth-child(2){width:67%}
      table tr th:nth-child(3){width:13%}
      table tr th:last-child{width:18%}
      .input-group{width:90%; margin: 0 auto}
    </style>
    <!-- 부트스트랩 js -->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>  
  <body>
    <form name="글내용보기" method="post" action="./php/delete.php">
      <input type="hidden" name="id" value="<?php echo $row['id']?>">
      <main>
        <table class="table table-striped table-hover text-center">
          <caption>게시판 목록</caption>
          <thead class="table-dark">
            <tr>
              <th>No.</th><th>제목</th><th>작성자</th><th>작성일</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $search = $_POST['search'];
              $sql = "select id, subject, name, datetime from free_board where subject='$search' or memo='$search'";

              $result = mysqli_query($conn, $sql);
                for($i=0; $row=mysqli_fetch_assoc($result); $i++): ?>
                  <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><a href="../view.php?id=<?php echo $row['id']?>" title="<?php echo $row['subject']?>"><?php echo $row['subject'] ?></a></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo date("Y-m-d", strtotime($row['datetime'])) ?></td>
                    <!-- <td><?php //echo substr($row['datetime'],0,10) ?></td> -->
                  </tr>
              <?php endfor; ?>
              
              <?php
                if($result==''){
                  echo '<script>alert("검색결과가 없습니다. 이전페이지로 이동합니다.");</script>';
                  echo '<script>Location.replace("../list.php");</script>';
                }
              
              ?>
          </tbody>
        </table>
        <p class="text-center">
          <a href="../list.php" title="글쓰기" class="btn btn-primary">전체목록보기</a>
        </p> 
      </main> 
  </body>
</html>