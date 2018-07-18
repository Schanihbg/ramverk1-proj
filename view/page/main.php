<?php
echo '<div class="text-center">';
echo sprintf('<p>%s</p>', $this->di->get("textfilter")->markdown("# Welcome to Liker"));
echo sprintf('<p>%s</p>', $this->di->get("textfilter")->markdown("The site where *YOU* can like anything."));
echo '</div>';

// Flex
echo '<div class="d-flex flex-row">';

// Comments
echo '<div class="card flex-fill" style="width: 18rem;">';
echo '    <div class="card-header">';
echo '        New';
echo '    </div>';
echo '    <ul class="list-group list-group-flush">';

foreach (array_reverse($comments) as $value) {
    $user = $this->di->get("userController")->getUser($value->userID, "id");
    $url = $this->di->get("url")->create("comment/post\\");

    echo sprintf('<li class="list-group-item"><a href="%s%s">%s</a></li>', $url, $value->id, $value->post_title);
}

echo '    </ul>';
echo '</div>';

echo "<br>";

// Top users
echo '<div class="card flex-fill" style="width: 18rem;">';
echo '    <div class="card-header">';
echo '        Top Users by post count';
echo '    </div>';
echo '    <ul class="list-group list-group-flush">';

foreach ($topUsers as $value) {
    $user = $this->di->get("userController")->getUser($value->userID, "id");
    $url = $this->di->get("url")->create("comment/post\\");

    echo sprintf('<li class="list-group-item"><a href="%s%s">%s(%s)</a></li>', $url, $value->userID, $user->acronym, $value->count);
}

echo '    </ul>';
echo '</div>';

echo "<br>";


// Tags
$tagsArray = array();

foreach ($tags as $value) {
    preg_match_all("/\#[a-öA-Ö0-9]+/", $value->tags, $tempArray);

    foreach (array_values($tempArray[0]) as $tag) {
        array_push($tagsArray, $tag);
    }
}

$tagsCount = array_count_values($tagsArray);
$tagsArray = array_unique($tagsArray);
$allTags = array_combine($tagsArray, $tagsCount);

arsort($allTags);

echo '<div class="card flex-fill" style="width: 18rem;">';
echo '    <div class="card-header">';
echo '        Popular tags';
echo '    </div>';
echo '    <ul class="list-group list-group-flush">';

foreach ($allTags as $key => $value) {
    $url = $this->di->get("url")->create("tag/".ltrim($key, "#"));

    echo sprintf('<li class="list-group-item"><a href="%s">%s (%s)</a></li>', $url, $key, $value);
}

echo '    </ul>';
echo '</div>';

// End Flex
echo '</div>';
