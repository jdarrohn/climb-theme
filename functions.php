<?php

/**
 * Autoload with Composer
 */
include_once(__DIR__.'/vendor/autoload.php');

Setup\Scripts::enqueue_all();

Setup\PostTypes\Climb::register();
Setup\PostTypes\Attempt::register();

Setup\Taxonomies\Location::register();

Setup\User::setup_json();

Setup\Roles::add_roles();

Setup\Menus::init();

Setup\Rewrites::init();

Setup\Admin::init();

add_theme_support( 'post-thumbnails' ); 