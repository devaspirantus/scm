<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #ddd;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2;}

tr:hover {background-color: #ddd;}

th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>

<h1>Flight Table</h1>

<table>
  <tr>
    <th>Distination</th>
    <th>Time</th>
    <th>Action</th>
  </tr>
 
  @foreach ($data as $flight)
  <tr>
    <td>{{ $flight->name }}</td>
    <td>{{ $flight->created_at}}</td>
  </tr>
  @endforeach
</table>

</body>
</html>



