<?php
if(isset($_GET['id'])){
    $urlID=$_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crawl Results</title>
    <link rel="stylesheet" href="styles/search.css">
</head>
<body>
    <div class="cont" id="searchCont">
        <h1 class="heading">Search Keyword in Crawled Results</h1>
      
            <div class="container">
                <div class="input-cont">
                    <input class="input1" type="text" placeholder="Url..." name="keyword" id="keyword">
                    <input type="hidden" value='<?php echo $urlID ?>' placeholder="Depth..." name="urlID" id="urlID">
                </div>
                <button id="submitbutton" class="search" onclick="handleSubmit(event)">Search</button>
            </div>
    </div>

    <div class='siteResults' id="results"></div>

    <script>
        function handleSubmit(event) {
            event.preventDefault();
            var keyword = encodeURIComponent(document.getElementById("keyword").value).trim();
            var urlID = document.getElementById("urlID").value;
            if(keyword && urlID){
                var container = document.getElementById("searchCont");
                container.style.position="relative";
                container.style.top="10px";
                showSearchResults();

            }else{
                alert("Please enter a keyword!");
            }
        }

        function closeButtonClickHandler() {
            var container = document.getElementById("searchCont");
            results.innerHTML='';
        }

        function showSearchResults() {
            var resultCont=document.getElementById("results");
            resultCont.innerHTML='<div class="progress-circle"></div><h3 class="error">Fetching</h3>';
            var keyword=document.getElementById("keyword").value.trim();
            var urlID=document.getElementById("urlID").value;
            var arr=JSON.stringify({ key: keyword, id: urlID });
            fetch('controller/searchJson.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
                body: arr,
            })
            .then(response => response.json())
            .then(data => {
                if (data.result) {
                    var results=data.result;
                    var html='<div class="cross-cont"><div id="crossButton" onclick="closeButtonClickHandler()">✖</div></div><h3 class="error" style="margin-bottom:10px;">All these urls contain the entered keyword:</h3>';
                    results.forEach(item => {
                        html+=`
                            <div class='resultContainer'>
                                <div>
                                    <h3 class='title'>
                                        <a class='result' href='${item}' >
                                            ${item}
                                        </a>
                                    </h3>
                            </div>`;
                    });
                    resultCont.innerHTML=html;
                } else {
                    console.error('Error Getting Results');
                    resultCont.innerHTML="<div class='error'><p>Error Getting Results</p><button onclick='showSearchResults()'>Try Again</button></div>";
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        };

    </script>
</body>
</html>



<?php
}
?>