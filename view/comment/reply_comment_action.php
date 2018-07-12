<?php
    $user = $this->di->get("userController")->getUser($this->di->get("session")->get("userLoggedIn"), "acronym");

    $sql = "INSERT INTO ramverk1_proj_comment (userID, comment, parentID, postID) VALUES (?, ?, ?, ?)";

    $this->di->get("database")->execute($sql, [$user->id, $_POST["comment_area"], $_POST["comment_id"], $_POST["post_id"]]);

    $this->di->get("response")->redirect($this->di->get("url")->create("comment/post/".$_POST["post_id"]));
