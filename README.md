<h1>todo-list</h1>
<p>A php backend for a todo list.</p>
<h2>Endpoints:</h2>
<ul>
  <li>GET http://127.0.0.1/todo-list/api/items.php?id=1</li>
  <li>POST http://127.0.0.1/todo-list/api/items.php<br>
  {"name":"make something", "description":"sometext"}<br>
  {"name":"make anything"}</li>
  <li>DELETE http://127.0.0.1/todo-list/api/items.php?id=1</li>
  <li>PATCH http://127.0.0.1/todo-list/api/items.php?id=1<br>
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
