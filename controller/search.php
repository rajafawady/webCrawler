<?php
include_once("webCrawl.php");
include_once("dbSearch.php");
$data = json_decode(file_get_contents('php://input'), true);
if(isset($data['key']) && isset($data['deep'])){
    $url=urldecode($data['key']);
    $depth=$data['deep'];
    $results=array();
    $dbSearch=new DBSearch();
    if($dbSearch->check($url)){
        $id=$dbSearch->search($url);
        $results[] = $id;
    }else{
        $webSearch = new WebSearch();
        $res=$webSearch->search($url,$depth);
        if($res){
            $results []= $res;
        }
       
    }
    echo json_encode(['result' => $results]);
}
?>