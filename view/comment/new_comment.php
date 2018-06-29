<?php

if ($this->di->get("session")->get("userLoggedIn")) {
    $user = $this->di->get("userController")->getUser($this->di->get("session")->get("userLoggedIn"), "acronym");

    echo <<< EOD
<form action="new_comment_action" method="POST">
    <div class="form-group">
        <label>Title</label>
        <input name="title" type="text" class="form-control" aria-describedby="Title" placeholder="Enter title" required>
    </div>
    <div class="form-group">
        <label>Comment</label>
        <textarea name="comment_area" class="form-control" rows="3" required></textarea>
    </div>
    <a class="btn btn-outline-primary" href="{$this->di->get("url")->create("comment")}">Go back</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
EOD;
} else {
    echo sprintf('Please login to post a new comment. Login <a href="%s">here<a/>', $this->di->get("url")->create("user/login"));
    echo '<br>';
    echo sprintf('To create a user, click <a href="%s">here<a/>', $this->di->get("url")->create("user/create"));
}
