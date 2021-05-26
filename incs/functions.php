<?php
function debug($data){
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function load($data){
    foreach ($_POST as $k => $v) {
        if(array_key_exists($k, $data)){
            $data[$k]['value'] = $v;
        }
    }
    return $data;
}

function validate($data){
    $errors = '';
    foreach ($data as $k => $v) {
        if($data[$k]['required'] && empty($data[$k]['value'])){
            $errors .= "<li>Вы не заполнили поле {$data[$k]['field_name']}</li>";
        }
    }
    return $errors;
}

function getRubric(){
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM rubric";
    $res = mysqli_query($conn, $sql);
    $rubricArr= [];
    while ($result = mysqli_fetch_assoc($res)){
        $db_rubric = $result['rubric'];
        $rubricArr[] = $db_rubric;
    }
    mysqli_close($conn);
    return $rubricArr;
}

function addDB($data){
    $conn = mysqli_connect('127.0.0.1', 'mysql', 'mysql', 'news2');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO news VALUES (NULL,'".$data['data']['value']."','".$data['title']['value']."','".$data['text']['value']."','".$data['img_name']['value']."')";
    mysqli_query($conn, $sql);
    
}
?>