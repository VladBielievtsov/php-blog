<?php

use App\Services\Router;
use App\controllers\Auth;
use App\controllers\Post;

Router::page('/', 'home');
Router::page('/login', 'login');
Router::page('/register', 'register');
Router::page('/profile', 'profile');
Router::page('/admin', 'admin');
Router::page('/post', 'post');
Router::page('/add-post', 'add-post');
Router::page('/user', 'user');

Router::post('/auth/register', Auth::class, 'register', true, true);
Router::post('/auth/login', Auth::class, 'login', true);
Router::post('/auth/logout', Auth::class, 'logout');
Router::post('/post/add', Post::class, 'add', true, true);

Router::enable();
