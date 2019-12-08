<?php
/** @var App\modules\User [] $users */

foreach ($users as $user) : ?>
    <div class="card-body">
        <div class="card-header">
            <h5 class>
                  <?=  $user->login ?>
            </h5>
        </div>
    </div>
<?php endforeach;?>
