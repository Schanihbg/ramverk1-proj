<?php
$tagsArray = array();

foreach ($content as $value) {
    preg_match_all("/\#[a-öA-Ö0-9]+/", $value->tags, $tempArray);

    foreach (array_values($tempArray[0]) as $tag) {
        array_push($tagsArray, $tag);
    }
}

$tagsArray = array_unique($tagsArray);
sort($tagsArray);

echo '<div class="card" style="width: 18rem;">';
echo '    <div class="card-header">';
echo '        All tags';
echo '    </div>';
echo '    <ul class="list-group list-group-flush">';

foreach ($tagsArray as $key => $value) {
    $url = $this->di->get("url")->create("tag/".ltrim($value, "#"));

    echo sprintf('<li class="list-group-item"><a href="%s">%s</a></li>', $url, $value);
}

echo '    </ul>';
echo '</div>';
