<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task PDF</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 60%;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }

        h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .task {
            margin-top: 20px;
        }

        .field {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        span {
            color: #777;
        }

        @media print {
            body {
                background-color: #fff;
            }

            .container {
                box-shadow: none;
                border: none;
            }

            .field {
                border-bottom: none;
            }
        }

    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Task Details</h1>
    </div>
    @foreach( $tasks as $task)
    <div class="task">
        <div class="field">
            <label for="title">Title:</label>
            <span id="title">{{ $task->title }}</span>
        </div>
        <div class="field">
            <label for="due_date">Due Date:</label>
            <span id="due_date">{{ \Carbon\Carbon::parse($task->due_date)->format('jS F Y') }}</span>
        </div>
        <div class="field">
            <label for="description">Description:</label>
            <span id="description">{{ $task->description }}</span>
        </div>
        <div class="field">
            <label for="is_completed">Completed:</label>
            <span id="is_completed">{{ $task->is_completed == true ? 'Yes' : 'No' }}</span>
        </div>
    </div>
    @endforeach
</div>
</body>
</html>
