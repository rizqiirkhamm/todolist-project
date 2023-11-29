<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Todo List Website</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
</head>

<body>
  <div class="container">
    <h1>Todo List</h1>
    <div class="input-container">
      <input class="todo-input" type="text" id="task" placeholder="Add a new task...">
      <button class="add-button" type="submit" onclick="addTask()">
        <i class="fa fa-plus-circle"></i>
      </button>
    </div>
    <div class="filters">
      <button class="filter" id="completedButton" onclick="toggleCompleted()" data-filter="completed">Incomplete</button>
      <button class="delete-all" onclick="deleteAll()">Delete All</button>
    </div>
    <div class="todos-container" id="todos">
      <div class="todos">

      </div>
    </div>
  </div>
  <script src="./script.js"></script>
</body>

</html>