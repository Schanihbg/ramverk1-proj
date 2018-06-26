<?php
foreach (array_reverse($content) as $key => $value) {
    $user = $this->di->get("userController")->getUser($value->userID, "id");

    echo sprintf('<a href="%s%s">Post by %s with id %s</a> <br>', $this->di->get("url")->create("comment/post\\"), $value->id, $user->email, $value->id);
}
echo "<br>";
echo sprintf('<a href="%s">Write a new comment</a>', $this->di->get("url")->create("comment/new"));
