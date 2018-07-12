<?php
$navbar = [
    "items" => [
        "home" => [
            "title" => "Home",
            "route" => "",
        ],
        "comment" => [
            "title" => "Comment",
            "route" => "comment",
        ],
        "tag" => [
            "title" => "Tag",
            "route" => "tag",
        ],
        "user" => [
            "title" => "Users",
            "route" => "user/users",
        ],
        "about" => [
            "title" => "About",
            "route" => "about",
        ],
    ]
];

?>
<div class="container">
<div class="header">
    <nav class="navbar navbar-dark bg-dark navbar-expand-md rounded">
        <a class="navbar-brand" href="<?= $di->get("url")->create($navbar["items"]["home"]["route"]) ?>">Lösningen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#containerNavbar" aria-controls="containerNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="containerNavbar">
            <ul class="navbar-nav mr-auto">
            <?php
            foreach ($navbar["items"] as $key) {
                echo '<li class="nav-item">';
                echo '<a class="nav-link ' . ($di->get("request")->getRoute() == $key["route"] ? "active" : "") . '" href="' . $di->get("url")->create($key["route"]) . '">' . $key["title"] . '</a>';
                echo '</li>';
            }
            ?>
            </ul>
            <ul class="navbar-nav navbar-right">
                <li><a class="nav-orange nav-link <?= $this->di->get("request")->getRoute() == "user" ? "active" : "" ?>" href="<?= $this->di->get("url")->create("user")?>"><?= $this->di->get("session")->get("userLoggedIn") ?> Profile</a></li>
            </ul>
        </div>
    </nav>
</div>
