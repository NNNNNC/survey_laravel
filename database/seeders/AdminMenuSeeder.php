<?php
use OpenAdmin\Admin\Auth\Database\Menu;

Menu::create([
    'parent_id' => 0,
    'order'     => 5, // Adjust the order as needed
    'title'     => 'Surveys',
    'icon'      => 'fa-list',
    'uri'       => 'surveys',
]);
