<?php
echo '<div class="card" style="width: 18rem;">';
echo '    <div class="card-header">';
echo '        New';
echo '    </div>';
echo '    <ul class="list-group list-group-flush">';

foreach (array_reverse($content) as $key => $value) {
    $user = $this->di->get("userController")->getUser($value->userID, "id");
    $url = $this->di->get("url")->create("comment/post\\");

    echo sprintf('<li class="list-group-item"><a href="%s%s">%s</a></li>', $url, $value->id, $value->post_title);
}

echo '    </ul>';
echo '</div>';

echo "<br>";

$url_new = $this->di->get("url")->create("comment/new");

echo '<div class="card" style="width: 18rem;">';
echo '    <ul class="list-group list-group-flush">';
echo sprintf('<li class="list-group-item"><a href="%s">Write a new comment</a></li>', $url_new);
echo '    </ul>';
echo '</div>';
