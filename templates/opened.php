<?php
require_once __DIR__ . '/connect.php';
require_once __DIR__ . '/functions.php';
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM news WHERE ID=" . $id;
$res = mysqli_query($conn, $sql);
while ($result = mysqli_fetch_assoc($res)) : ?>
    <article class="article opened">
        <div class="row">
            <?php $rubrics = getActiveRub($result['ID']);
            while ($rub = mysqli_fetch_assoc($rubrics)) {
                echo "<div class='rubric'><a href='index.php?page-rubric&id=".$rub['ID']."'>#" . $rub['rubric'] . "</a></div>";
            }
            ?>
            <a class="get-back-link" href="/">Вернуться обратно</a>
        </div>
        <div class="row data">
            <?php $date = new DateTime($result['date']);
            $new_date = $date->format('d-F,Y G:i');
            echo $new_date;
            ?>
        </div>
        <div class="row">
           <div class="title-link"><?php echo $result['title']?></div>
           
       </div>
        <div class="article-text">
            
            <div class="text"><img width="340" height="230" class="img-text" src="../img/img-news/<?php echo $result['img']?>.jpg" alt=""><?php echo $result['text']?></div>
        </div>



    </article>
<?php endwhile; ?>