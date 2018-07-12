<?php
echo '<h1>Users</h1>';
echo '<table class="table">';
echo '    <tr>';
echo '        <th>Acronym</th>';
echo '        <th>Email</th>';
echo '    </tr>';

foreach ($content as $item) {
    echo '<tr>';
    echo sprintf('<td><a href="%s">%s</a></td>', $this->di->get("url")->create("user/{$item->id}"), $item->acronym);
    echo sprintf('<td>%s</td>', $item->email);
    echo '</tr>';
}

echo '</table>';
