<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go & Alpine.js - Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/htmx.org@2.0.4" integrity="sha384-HGfztofotfshcF7+8n44JQL2oJmowVChPTg48S+jvZoztPfvwD79OC/LTtG6dMp+" crossorigin="anonymous"></script>
</head>
<body class="container">

    <div class="row mt-4 g-4" x-data="{ todos: {{ Js::from($todos) }} }">
        <div class="col-8">
            <h1 class="mb-4">Todo Items</h1>
        
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Completed</th>
                    </tr>
                </thead>
                
            <tbody id="todo-table-body">
                <template x-for="todo in todos">
                    <tr>
                        <td x-text="todo.id"></td>
                        <td x-text="todo.name"></td>
                        <td x-text="todo.isCompleted"></td>
                    </tr>
                </template>
            </tbody>

            </table>
        </div>

        <div class="col-4">
            <h1 class="mb-4">Add Todo</h1>

            <form hx-post="/submit-todo/" hx-target="#todo-table-body" hx-swap="beforeend">
                @csrf
                <div class="mb-2">
                    <label>Todo Name</label>
                    <input type="text" name="name" class="form-control"/>
                </div>
                <div class="mb-2">
                    <label>Is Completed?</label>
                    <input type="checkbox" name="completed" value="true"/>
                </div>

                <input type="submit" value="Add Todo" class="btn btn-primary"/>
            </form>
        </div>

    </div>

</body>
</html>