<h1>todo-list</h1>
<p>A php backend for a todo list.</p>
<h3>todoList.sql has 'DROP TABLE list' if db already has list table with datas</h3>
<h2>Endpoints:</h2>
<ul>
  <li>get one todo with ID<br>
  GET http://127.0.0.1/todo-list/api/items.php?id=1</li>
  <li>get some todo filtered with name and complete<br>
  GET http://127.0.0.1/todo-list/api/items.php<br>
  GET http://127.0.0.1/todo-list/api/items.php?name=something&completed=1<br>
  GET http://127.0.0.1/todo-list/api/items.php?page=2<br>
  GET http://127.0.0.1/todo-list/api/items.php?name=some&page=3&per_page=4</li>
  <li>create new todo with name and may description<br>
  POST http://127.0.0.1/todo-list/api/items.php<br>
  {"name":"make something", "description":"sometext"}<br>
  {"name":"make anything"}</li>
  <li>remove a todo with id<br>
  DELETE http://127.0.0.1/todo-list/api/items.php?id=1</li>
  <li>modify a todo with id and set name, description or complete<br>
  PATCH http://127.0.0.1/todo-list/api/items.php?id=1<br>
  {"name": "make something", "description": "sometext", "completed": "0"}<br>
  {"description": "some other text", "completed": "0"}<br>
  {"completed": "1"}</li>
</ul>
<h2>Todos:</h2>
<ul>
  <li>htaccess for able to use endpoint without ".php"</li>
  <li>need more appropriate response codes</li>
  <li>.env or similar for db</li>
  <li>check at PATCH that the new datas are really new</li>
</ul>
