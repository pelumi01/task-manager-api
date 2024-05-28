<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task PDF</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .task {
            margin-top: 20px;
        }

        .field {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
        }

        span {
            margin-left: 10px;
            color: #555;
        }

        label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
            color: #333;
        }

    </style>
</head>
<body>
<div class="container">
    <h1>Task Details</h1>
    <div class="task">
        <div class="field">
            <label for="title">Title:</label>
            <span id="title">[Task Title]</span>
        </div>
        <div class="field">
            <label for="due_date">Due Date:</label>
            <span id="due_date">[Due Date]</span>
        </div>
        <div class="field">
            <label for="description">Description:</label>
            <span id="description">[Task Description]</span>
        </div>
        <div class="field">
            <label for="is_completed">Completed:</label>
            <span id="is_completed">[Yes/No]</span>
        </div>
    </div>
</div>
</body>
</html>
