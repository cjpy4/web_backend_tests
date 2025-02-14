<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;

Route::get('/welcome', function () {
    return view('welcome');
});
$todos = [
    new Todo(1, 'Buy groceries'),
    new Todo(2, 'Clean the house'),
    new Todo(3, 'Finish the project', true),
];

Route::get('/', function () {

    $todos = [
        new Todo(1, 'Buy groceries'),
        new Todo(2, 'Clean the house'),
        new Todo(3, 'Finish the project', true),
    ];

    return view('index', [
        'todos' => $todos
    ]);
});

Route::post('/submit-todo', function () {
    $todo = new Todo(4, request('name'), request('completed'));

    return view('todo', [
        'id' => $todo->id,
        'name' => $todo->name,
        'completed' => $todo->completed ? 'Yes' : 'No'
    ]);
});