<?php
if (isset($content[0]->comment) && !empty($content)) {
    $top_post = $content[0];
    $user = $this->di->get("userController")->getUser($top_post->userID, "id");

    echo '<div class="card" style="width: 256px;">';
    $picture = $this->di->get("gravatarController")->getGravatar($user->email, 256);
    echo sprintf('<img src="%s" alt="Gravatar picture">', $picture);
    echo sprintf('<p class="text-center">%s</p>', $user->email);
    echo '</div>';
    echo '<br>';

    echo '<div class="media">';
    echo '<div class="media-body">';
    echo '    <div class="card" style="width: 18rem;">';
    echo '        <div class="card-body">';
    echo $this->di->get("textfilter")->markdown(htmlspecialchars($top_post->comment, ENT_QUOTES));
    echo '        </div>';
    echo '    </div>';

    foreach (array_slice($content, 1) as $key => $value) {
        echo '<div class="media mt-2 ml-3">';
        echo '<div class="media-body">';
        echo '    <div class="card" style="width: 18rem;">';
        echo '        <div class="card-body">';
        echo $this->di->get("textfilter")->markdown(htmlspecialchars($value->comment, ENT_QUOTES));
        echo '        </div>';
        echo '    </div>';
    }

    foreach (array_slice($content, 1) as $key => $value) {
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';
    echo '<br>';

    if ($this->di->get("session")->has("userLoggedIn")) {
        $user = $this->di->get("userController")->getUser($this->di->get("session")->get("userLoggedIn"), "acronym");

        echo sprintf('<a class="btn btn-outline-primary" href="%s">Go back</a>', $this->di->get("url")->create("comment"));
        echo sprintf('<a class="btn btn-success" href="%s">Reply</a>', $this->di->get("url")->create("comment/reply/".$top_post->id));
        if ($user->id == $top_post->userID || $user->adminflag == 1) {
            echo sprintf('<a class="btn btn-outline-primary" href="%s">Edit</a>', $this->di->get("url")->create("comment/edit/".$top_post->id));
            echo sprintf('<a class="btn btn-outline-danger" href="%s">Delete</a>', $this->di->get("url")->create("comment/delete/".$top_post->id));
        }
    }
} else {
    $this->di->get("response")->redirect($this->di->get("url")->create("comment"));
}
