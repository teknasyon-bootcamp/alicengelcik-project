<?php
header('Content-Type: application/json; charset=utf-8');
foreach ($allNews as $news){
    echo "News:".json_encode($news);
}