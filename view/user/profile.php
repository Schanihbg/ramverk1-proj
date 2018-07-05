<?php
$user = null;
$the_email = null;
$the_acronym = null;

if ($this->di->get("session")->has("userLoggedIn")) {
    $user = $this->di->get("userController")->getUser($this->di->get("session")->get("userLoggedIn"), "acronym");

    $the_email = $user->email;
    $the_acronym = $user->acronym;
}

if (isset($content->acronym)) {
    $the_email = $content->email;
    $the_acronym = $content->acronym;
}

if (isset($content->id)) {
    $picture = $this->di->get("gravatarController")->getGravatar($the_email, 256);

    echo '<div class="card" style="width: 256px;">';
    echo sprintf('<img src="%s" alt="Gravatar picture">', $picture);
    echo sprintf('<p class="text-center">Acronym: %s <br> Email: %s</p>', $the_acronym, $the_email);
    echo '</div>';

    if ($this->di->get("session")->has("userLoggedIn") && $user->id == $content->id) {
        echo sprintf('<a class="btn btn-outline-primary" href="%s">Edit user</a>', $this->di->get("url")->create("user/update/".$user->id));

        if ($user->adminflag == 1) {
            echo sprintf('<a class="btn btn-outline-primary" href="%s">Admin panel</a>', $this->di->get("url")->create("user/admin/"));
        }

        echo sprintf('<a class="btn btn-outline-danger" href="%s">Logout</a>', $this->di->get("url")->create("user/logout"));
        echo '<br>';
    }
} elseif (isset($user)) {
    $this->di->get("response")->redirect($this->di->get("url")->create("user/".$user->id));
} else {
    echo sprintf('You are not logged in, click here to <a href="%s">login<a/>', $this->di->get("url")->create("user/login"));
    echo '<br>';
    echo sprintf('To create a user, click <a href="%s">here<a/>', $this->di->get("url")->create("user/create"));
}

if (isset($user) || isset($content->id)) {
    echo '<div class="d-flex pt-4">';

    //Posts card
    echo '<div class="card flex-fill">';
    echo '    <div class="card-header">';
    echo '        Posts by user';
    echo '    </div>';
    echo '    <ul class="list-group list-group-flush">';

    if (isset($comments) && !empty($comments)) {
        foreach ($comments as $key => $value) {
            if ($value->is_post == 1) {
                echo sprintf('<li class="list-group-item"><a href="%s">%s</a></li>', $this->di->get("url")->create("comment/post/".$value->id), $value->post_title);
            }
        }
    } else {
        echo '<li class="list-group-item">Nothing</li>';
    }

    echo '    </ul>';
    echo '</div>';

    //Comments card
    echo '<div class="card flex-fill">';
    echo '    <div class="card-header">';
    echo '        Comments by user';
    echo '    </div>';
    echo '    <ul class="list-group list-group-flush">';

    if (!empty($comments)) {
        foreach ($comments as $key => $value) {
            if ($value->is_post == 0) {
                $title = null;
                foreach ($comments as $key1 => $value1) {
                    if ($value->postID == $value1->id) {
                        $title = $value1->post_title;
                    }
                }
                echo sprintf('<li class="list-group-item"><a href="%s">Comment in post: %s</a></li>', $this->di->get("url")->create("comment/post/".$value->id), $title);
            }
        }
    } else {
        echo '<li class="list-group-item">Nothing</li>';
    }

    echo '    </ul>';
    echo '</div>';

    echo '</div>'; // Close flex
}
