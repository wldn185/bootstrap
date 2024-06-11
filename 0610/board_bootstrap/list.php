<?php
  include('./php/dbconn.php'); //db계정과 연결

  $sql = "select * from free_board";
  $result = mysqli_query($conn, $sql);
?>

<html lang="ko">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>자유게시판 - 목록</title>
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
    <head></head>
    <main>
      <h2>게시판 목록</h2>
      <table class="table table-striped table-hover text-center">
        <caption>게시판 목록</caption>
        <thead class="table-dark">
          <tr>
            <th>No.</th><th>제목</th><th>작성자</th><th>작성일</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $num = 50;
            //한 페이지에 보여질 게시물 개수
            $list_num = 5;
            
            //이전, 다음 버튼 클릭시 나오는 페이지 수
            $page_num =3;
            
            //현재 페이지
            $page = isset($_GET["page"])? $_GET["page"] : 1;
            
            // 전체페이지수 계산
            $total_page = ceil($num / $list_num);
            //10페이지 = 게시물 50개 / 5 한페이지 출력개수
            
            //전체블럭 계산
            $total_block = ceil($total_page / $page_num);
            //3.333333 =  10/3
            
            //현재블럭번호 계산
            $now_block = ceil($page / $page_num);
            
            //블럭당 시작페이지 번호
            $s_pageNum = ($now_block - 1) * $page_num + 1;
            
            //데이터가 0인 경우
            if($s_pageNum <= 0){ $s_pageNum = 1; };
            
            //블럭당 마지막페이지 번호
            $e_pageNum = $now_block * $page_num;
            
            //마지막 번호가 전체 페이지번호보다 크다면 동일한 값을 준다.
            if($e_pageNum > $total_page){ $e_pageNum = $total_page; };
    
            $start = ($page - 1) * $list_num;
            $cnt = $start + 1;

            // $sql = "select * from free_board order by id DESC";
            // $result = mysqli_query($conn, $sql);       
            $query = "select * from free_board order by id DESC limit $start, $list_num;";
            $result = mysqli_query($conn, $query);     
            for($i=0; $row=mysqli_fetch_assoc($result); $i++): 
          ?>
            <tr>
              <td><?php echo $row['id'] ?></td>
              <td><a href="view.php?id=<?php echo $row['id']?>" title="<?php echo $row['subject']?>"><?php echo $row['subject'] ?></a></td>
              <td><?php echo $row['name'] ?></td>
              <td><?php echo date("Y-m-d", strtotime($row['datetime'])) ?></td>
              <!-- <td><?php //echo substr($row['datetime'],0,10) ?></td> -->
            </tr>
          <?php endfor; 
            $cnt++;
          ?>
        </tbody>     
      </table>

      <nav aria-label="페이지 내비게이션">
        <ul class="pagination justify-content-center">
          <?php 
            //페이지네이션이 들어가는 곳
            //이전페이지
            if($page <= 1){ ?> 
              <li><a href="list.php?page=1" class="page-link">이전</a></li>
              <?php } 
              else{ ?> 
              <li><a href="list.php?page=<?php echo ($page-1); ?>" class="page-link">이전</a></li>
              <?php };
              ?> 
          <?php //여기서부터 페이지 번호출력하기
            for($print_page=$s_pageNum;$print_page<=$e_pageNum;$print_page++){?>
              <li><a href="list.php?page=<?php echo $print_page; ?>" class="page-link">
                <?php echo $print_page ?>
              </a></li>
            <?php }; ?>  

            <!-- 다음 버튼 나오는 곳 -->
            <?php if($page>=$total_page){ ?>
              <li><a href="list.php?page=<?php echo $total_page; ?>" title="다음페이지로" class="page-link">다음</a></li>
            <?php }else{ ?>
              <li><a href="list.php?page=<?php echo ($page+1); ?>" class="page-link">다음</a></li>
          <?php };    
          ?>
        </ul>
      </nav>
      
      <form name="목록조회" method="post" action="./php/list_search_result.php">
        <p class="text-center input-group text-center">
          <input type="search" id="search" name="search" placeholder="검색어입력" class="form-control">
          <input type="submit" value="검색(제목+내용)" id="search_btn" onclick= "return form_check();" class="btn btn-secondary input-group-text">
          <a href="write.php" title="글쓰기" class="btn btn-primary">글쓰기</a>
        </p> 
      </form>
    </main>
    <footer></footer>
    <script>
      // let s_btn = document.getElementById('search_btn');

      // s_btn.addEventListener('click', function(){
      //   form_check();
      // });

      function form_check(){
        // alert('click');
        if(document.getElementById('search').value.length<1){
          alert('검색어를 입력하지 않았습니다. 확인하세요.');
          return false;
        }
        return true;
      }
    </script>
  </body>
</html>