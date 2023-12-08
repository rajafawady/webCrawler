<?php

class webSearch {
    public function search($query) {
        $searchUrl = $query;
        $htmlContent = $this->fetchHtmlContent($searchUrl);
        if ($htmlContent !== false) {
            return $this->parseSearchResults($htmlContent);
        } else {
            return null;
        }
    }

    private function fetchHtmlContent($url) {
        $curl = curl_init($url);

        // Set cURL options

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

        // Execute cURL session
        $htmlContent = curl_exec($curl);

        // Check for errors during the cURL request
        if (curl_errno($curl)) {
            echo 'Error fetching URL: ' . curl_error($curl) . PHP_EOL;
            $htmlContent = false;
        }

        // Close cURL session
        curl_close($curl);
        return $htmlContent;
    }

    private function parseSearchResults($htmlContent) {
        $dom = new DOMDocument;
        libxml_use_internal_errors(true);
        $dom->loadHTML($htmlContent);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $results = $xpath->query('//h2[following-sibling::div[@class="b_caption"]]');
        $searchResults = []; // Initialize an empty array to store results
        if ($results->length > 0) {
            foreach ($results as $result) {
                // Get nodeValue of h2
                $h2 = $result->nodeValue;
                
                $followingDiv = $xpath->query('following-sibling::div', $result)->item(0);
                $href="";
                $url=$result->childNodes->item(0);
                if ($url->nodeName === 'a') {
                    // Access href of anchor tag
                    $href = $url->getAttribute('href');
                }
                $des=$followingDiv->nodeValue;
                $desc=preg_replace("/^Web/",'',$des);
                $resultArray = [
                'h2' => $h2,
                'href' => $href,
                'desc' => $desc,
                ];
                $searchResults[] = $resultArray;
            }
            return $searchResults;
        }
        else {
            return null;
        }
    }   

};
$keyword='https://www.w3schools.com/';
$webSearch = new WebSearch();
$results=$webSearch->search($keyword);
?>