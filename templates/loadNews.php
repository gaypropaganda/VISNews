<?php
   require_once __DIR__ . '/connect.php';
   require_once __DIR__ . '/functions.php';
   $conn = mysqli_connect($servername, $username, $password, $database);
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   $sql = "SELECT * FROM news ORDER BY date DESC";
   $res = mysqli_query($conn, $sql);
   while ($result = mysqli_fetch_assoc($res)):
   if ($result['visible']==1){ ?>
       <article class="article">
       <div class="row">
           <div class="title"><a href="index.php?page=news&id=<?php echo $result['ID']?>" class="title-link"><?php echo $result["title"]?></a></div>
           <div class="img"><img width=270 heigth=190 src="../img/img-news/<?php echo $result['img']?>.jpg" alt=""></div>
       </div>
       <div class="row data">
           <?php $date = new DateTime($result['date']);
           $new_date = $date -> format('d-F,Y G:i');
           echo $new_date
           ?>
       </div>
       <div class="row">
           <?php $rubrics = getActiveRub($result['ID']);
             while ($rub = mysqli_fetch_assoc($rubrics)){
                 echo "<div class='rubric'><a href='index.php?page=rubric&id=".$rub['ID']."'>#". $rub['rubric'] . "</a></div>";
             }
           ?>
           
       </div>
   </article>
   <?php }endwhile;?>


