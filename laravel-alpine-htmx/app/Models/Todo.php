<?php

namespace App\Models;

class Todo {
    public $id;
    public $name;
    public $completed;

    public function __construct($id, $name, $completed = false) {
        $this->id = $id;
        $this->name = $name;
        $this->completed = filter_var($completed, FILTER_VALIDATE_BOOLEAN);
    }
}