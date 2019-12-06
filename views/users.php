<?php
/** @var App\modules\User [] $users */

foreach ($users as $user) : ?>
    <h1><?= $user->login ?></h1>
<?php endforeach;?>
