<!DOCTYPE html>
<style>
    .done-true {
    text-decoration: line-through;
    color: grey;
}
</style>
    <html ng-app="todoApp">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <title>PollSystem | Inicio</title>
        <link href="librerias/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="librerias/bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet">
        <!--<link href="css/csslogin.css" type="text/css" rel="stylesheet">-->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
        <script src="librerias/jquery-1.10.2.js" ></script>
        <script src="librerias/bootstrap/js/bootstrap.js"></script>
        <!--<script src="usuarios/usuarios.js" type="text/javascript"></script>-->
    </head>
    <body>
        <h2>Todo</h2>
        <div ng-controller="TodoListController as todoList">
          <span>{{todoList.remaining()}} of {{todoList.todos.length}} remaining</span>
          [ <a href="" ng-click="todoList.archive()">archive</a> ]
          <ul class="unstyled">
            <li ng-repeat="todo in todoList.todos">
              <label class="checkbox">
                <input type="checkbox" ng-model="todo.done">
                <span class="done-{{todo.done}}">{{todo.text}}</span>
              </label>
            </li>
          </ul>
          <form ng-submit="todoList.addTodo()">
            <input type="text" ng-model="todoList.todoText"  size="30" placeholder="add new todo here">
            <input class="btn-primary" type="submit" value="add">
          </form>
        </div>
    </body>
</html>
<script>
    angular.module('todoApp', [])
  .controller('TodoListController', function() {
    var todoList = this;
    todoList.todos = [
      {text:'learn AngularJS', done:true},
      {text:'build an AngularJS app', done:false}];

    todoList.addTodo = function() {
      todoList.todos.push({text:todoList.todoText, done:false});
      todoList.todoText = '';
    };

    todoList.remaining = function() {
      var count = 0;
      angular.forEach(todoList.todos, function(todo) {
        count += todo.done ? 0 : 1;
      });
      return count;
    };

    todoList.archive = function() {
      var oldTodos = todoList.todos;
      todoList.todos = [];
      angular.forEach(oldTodos, function(todo) {
        if (!todo.done) todoList.todos.push(todo);
      });
    };
  });
</script>