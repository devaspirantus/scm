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
 .button {
  background-color: #04AA6D;;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  cursor: pointer;
}
.button-delete {
  background-color: red;;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 15px;
  cursor: pointer;
}
</style>
</head>
<body>

<h1>Country Table</h1>
<a class="button" href="{{ route('countries.create') }}">Add Country</a>
<table>
  <tr>
    <th>Country</th>
    <th>Time</th>
    <th>Destination</th>
  <th>Action</th>
</tr>
 
  @foreach ($data as $country)
  <tr>
    <td>{{ $country->name }}</td>
    <td>{{ $country->created_at}}</td>
    @if (!@empty($country->destination))
      <td>{{ $country->destination->name}}</td>   
    @endif
    <td>
        <a href="{{ route('countries.edit', $country->id) }}" class="button">Edit</a>
        
        <form action="{{ route('countries.destroy', $country->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="button-delete">Delete</button>
        </form>
    </td>
  </tr>
  @endforeach
</table>

</body>
</html>



