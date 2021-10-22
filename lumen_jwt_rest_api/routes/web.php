<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Auth;
$router->get('/', function () use ($router) {
    return "Welcome To Lumen APIS with (JWT):".$router->app->version();
});

$router->group(['prefix' => 'api/v1'], function () use ($router) {
//  Login/Register
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');
 });

$router->group(['prefix' => 'api/v1', 'middleware'=>'auth'], function () use ($router) {
//  Dashboard
    $router->get('/dashboard', 'DashboardController@getDashboard');

//  Task
    $router->get('/tasks', 'TaskController@getTask');
    $router->post('/add/task', 'TaskController@addTask');
    $router->get('/get/task/{id}', 'TaskController@getSingleTask');
    $router->put('/update/task', 'TaskController@updateTask');
    $router->delete('/delete/task/{id}', 'TaskController@deleteTask');

//  Project
    $router->get('/projects', 'ProjectController@getProject');
    $router->post('/add/project', 'ProjectController@addProject');
    $router->get('/get/project/{id}', 'ProjectController@getSingleProject');
    $router->put('/update/project', 'ProjectController@updateProject');
    $router->delete('/delete/project/{id}', 'ProjectController@deleteProject');

//    Change Password
    $router->post('/change_password', 'UserController@changePassord');
});
