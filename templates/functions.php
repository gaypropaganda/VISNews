
<?php
function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}



function getActiveRub($id)
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT rubric_id FROM intermediate WHERE news_id=" . $id;
    $result = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM rubric WHERE ";
    $rubid = [];
    while ($res = mysqli_fetch_assoc($result)) {
        $rubid[] = $res['rubric_id'];
    }
    foreach ($rubid as $k => $v) {
        if ($k == count($rubid) - 1) {
            $sql2 .= ' ID=' . $v;
        } else {
            $sql2 .= ' ID=' . $v . ' OR';
        }
    }

    $result2 = mysqli_query($conn, $sql2);
    mysqli_close($conn);
    return $result2;
}
function getSortedNews($id)
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT news_id FROM intermediate WHERE rubric_id=" . $id;
    $result = mysqli_query($conn, $sql);
    $sql2 = "SELECT * FROM news WHERE ";
    $newsid = [];
    while ($res = mysqli_fetch_assoc($result)) {
        $newsid[] = $res['news_id'];
    }
    if (count($newsid) != 0) {
        foreach ($newsid as $k => $v) {
            if ($k == count($newsid) - 1) {
                $sql2 .= ' ID=' . $v;
            } else {
                $sql2 .= ' ID=' . $v . ' OR';
            }
        }
        $sql2 .= " ORDER BY date DESC";
        $result2 = mysqli_query($conn, $sql2);
    } else {
        $result2 = mysqli_query($conn, 'SELECT 0 WHERE 0=1');
        
    }
    mysqli_close($conn);
    return $result2;
}

function getRubric()
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM rubric";
    $res = mysqli_query($conn, $sql);
    $rubricArr = [];
    while ($result = mysqli_fetch_assoc($res)) {
        $db_id = $result['ID'];
        $db_rubric = $result['rubric'];
        $rubricArr[] = [$db_id, $db_rubric];
    }
    mysqli_close($conn);
    return $rubricArr;
}

function getRubName($id)
{
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT rubric FROM rubric WHERE ID=" . $id;
    $res = mysqli_query($conn, $sql);
    $rubricName = '';
    while ($result = mysqli_fetch_assoc($res)) {
        $rubricName = $result['rubric'];
    }
    mysqli_close($conn);
    return $rubricName;
}



?>