<?php

echo '<div class="jumbotron">';
echo '    <div class="container">';
echo '        <h1 class="display-4">#' . $tag . '</h1>';
echo '    </div>';
echo '</div>';

echo '<div class="card">';
echo '  <ul class="list-group list-group-flush">';
foreach ($content as $key => $value) {
    $user = $this->di->get("userController")->getUser($value->userID, "id");
    $url = $this->di->get("url")->create("comment/post\\");

    echo sprintf('<li class="list-group-item"><a href="%s%s">%s</a></li>', $url, $value->id, $value->post_title);
}
echo '  </ul>';
echo '</div>';
echo '<br>';

echo sprintf('<a class="btn btn-outline-primary" href="%s">Go back</a>', $this->di->get("url")->create("tag"));
