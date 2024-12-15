<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .task-list {
            max-width: 600px;
            margin: 0 auto;
        }
        .task-title {
            font-size: 1.25rem;
        }
        .completed {
            text-decoration: line-through;
            color: #6c757d;
        }
        .task-form input {
            border-radius: 30px;
        }
        .task-form button {
            border-radius: 30px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <h1 class="text-center text-primary mb-4">To-Do App</h1>

    <!-- Task Form -->
    <div class="task-list mb-4">
        <form action="{{ route('tasks.store') }}" method="POST" class="task-form d-flex">
            @csrf
            <input type="text" name="title" class="form-control me-2" placeholder="What do you need to do?" required>
            <button class="btn btn-primary px-4">Add</button>
        </form>
    </div>

    <!-- Task List -->
    <div class="task-list">
        @if($tasks->isEmpty())
            <p class="text-center text-muted">No tasks yet. Add one above!</p>
        @else
            <ul class="list-group">
                @foreach ($tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <!-- Task Checkbox and Title -->
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="d-flex align-items-center">
                            @csrf
                            @method('PUT')
                            <input type="checkbox" class="form-check-input me-2"
                                   {{ $task->is_completed ? 'checked' : '' }}
                                   onchange="this.form.submit()">
                            <span class="task-title {{ $task->is_completed ? 'completed' : '' }}">
                                {{ $task->title }}
                            </span>
                        </form>

                        <!-- Delete Button -->
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
