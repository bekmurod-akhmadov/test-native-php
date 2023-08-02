<?php

function getScience(){
    global $db;
    $sql = "select * from fan";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $i){
        debug($i->getMessage());
    }
}

function queryByScience($science , $count){
    global $db;
    $sql = "select * from savollar where fan_id = $science order by rand()  limit $count";
    $prepare = $db->prepare($sql);
    $prepare->execute();
    $models = $prepare->fetchAll(PDO::FETCH_ASSOC);
    return $models;
}

function getAnswersByQuestion($id){
    global $db;
    $sql = "select * from variantlar where savol_id = $id";
    $prepare = $db->prepare($sql);
    $prepare->execute();
    $models = $prepare->fetchAll(PDO::FETCH_ASSOC);
    return $models;
}

function getVariantById($id){
    global $db;
    $sql = "select * from variantlar where savol_id = $id";
    $prepare = $db->prepare($sql);
    $prepare->execute();
    return $prepare->fetchAll(PDO::FETCH_ASSOC);
}

function debug($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
