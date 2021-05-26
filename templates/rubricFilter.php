<?php 
$id = $_GET['id'];
$rubname = getRubName($id);


echo "<div class='row'><div class='rubric'><a href='/'>#" . $rubname . "<i class='fas fa-times'></i></a></div></div>";
$res=getSortedNews($id);
if (mysqli_num_rows($res)==0):
    echo '<div class="row">Извините, но по данной рубрике еще нет новостей!(</div>';
else:
while ($result = mysqli_fetch_assoc($res)): 
if ($result['visible']==1){?>
    <article class="article">
    <div class="row">
        <div class="title"><a href="index.php?page=news&id=<?php echo $result['ID']?>" class="title-link"><?php echo $result["title"]?></a></div>
        <div class="img"><img width="270" height="190" src="../img/img-news/<?php echo $result['img']?>.jpg" alt=""></div>
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
<?php }endwhile;endif?>
