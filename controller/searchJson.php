<?php

class SearchInJson {
    private $jsonData;

    public function __construct($jsonFile) {
        $this->jsonData = $this->loadJsonFile($jsonFile);
    }

    public function searchKeyword($keyword) {
        $matchingUrls = [];
        if($this->jsonData){
        foreach ($this->jsonData as $result) {
            $url = $result['url'];
            foreach ($result['data'] as $item) {
                if (isset($item['content']) && stripos(strtolower($item['content']), strtolower($keyword)) !== false) {
                    $matchingUrls[] = $url;
                    break; // Once a match is found for the URL, no need to check other items for the same URL
                }
            }
        }
    }
        return $matchingUrls;
    }

    private function loadJsonFile($jsonFile) {
        $filePath="../jsondata/".$jsonFile.".json";
        $jsonContents = file_get_contents($filePath);
        if($jsonContents){
            return json_decode($jsonContents, true);
        }else{
            return null;
        }
    }

};

$data = json_decode(file_get_contents('php://input'), true);
if(isset($data['key']) && isset($data['id'])){
    $keyword=trim($data['key']);
    $urlID=trim($data['id']);
    $jsonSearch=new SearchInJson($urlID);
    $searchResults=$jsonSearch->searchKeyword($keyword);
    echo json_encode(["result"=>$searchResults]);
}
?>
