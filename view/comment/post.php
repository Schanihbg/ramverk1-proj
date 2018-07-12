<?php
if ($content[0]->is_post == 0) {
    $this->di->get("response")->redirect($this->di->get("url")->create("comment/post/".$content[0]->postID));
} elseif (isset($content[0]->comment) && !empty($content)) {
    $top_post = $content[0];
    $user = $this->di->get("userController")->getUser($top_post->userID, "id");

    echo '<div class="card" style="width: 256px;">';
    $picture = $this->di->get("gravatarController")->getGravatar($user->email, 256);
    echo sprintf('<img src="%s" alt="Gravatar picture">', $picture);
    echo sprintf('<a href="%s"><p class="text-center">%s</p></a>', $user->id, $user->acronym);
    echo '</div>';
    echo '<br>';

    echo '<div class="media">';
    echo '<div class="media-body">';
    echo '    <div class="card" style="width: 18rem;">';
    echo '        <div class="card-body">';
    echo $this->di->get("textfilter")->markdown(htmlspecialchars($top_post->comment, ENT_QUOTES));
    echo '        </div>';
    echo '        <hr>';

    echo '        <div class="text-center">';
    echo 'Tags: ';

    preg_match_all("/\#[a-öA-Ö0-9]+/", $top_post->tags, $output_array);
    foreach ($output_array as $value) {
        foreach ($value as $tag) {
            echo sprintf('<a href="%s">%s</a>', $this->di->get("url")->create("tag/".ltrim($tag, "#")), $tag);
            echo " ";
        }
    }
    echo '        </div>';
    echo '    </div>';

    $commentsArray = array();
    foreach (array_slice($content, 1) as $key => $value) {
        if ($value->is_post == 1) {
            $commentsArray[$value->id] = array($value);
        }

        if (array_key_exists($value->id, $commentsArray) && $value->is_post == 0) {
            array_push($commentsArray[$value->id], $value);
        } else {
            if ($value->parentID == $top_post->id) {
                $commentsArray[$value->id] = array($value);
            } elseif (array_key_exists($value->parentID, $commentsArray)) {
                array_push($commentsArray[$value->parentID], $value);
            } else {
                foreach (array_slice($content, 1) as $key => $check) {
                    if ($value->parentID == $check->id) {
                        array_push($commentsArray[$check->parentID], $value);
                    }
                }
            }
        }
    }

    $stepping = 1;
    foreach ($commentsArray as $key => $value) {
        foreach ($value as $comment) {
            if ($comment->parentID == $top_post->id) {
                $stepping = 1;
            } elseif ($comment->parentID == $value[0]->id) {
                $stepping = 2;
            }

            echo '    <div class="card" style="width: 18rem; margin-left: ' . 1 * $stepping . 'rem">';
            echo '        <div class="card-body">';
            echo $this->di->get("textfilter")->markdown(htmlspecialchars($comment->comment, ENT_QUOTES));
            echo '        </div>';
            echo sprintf('<a class="" href="%s">Reply</a>', $this->di->get("url")->create("comment/reply/".$comment->id));
            echo '    </div>';

            $stepping++;
        }
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
