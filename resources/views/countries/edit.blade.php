<!DOCTYPE html>
<html>
<style>
form {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

label {display: block;}

input[type=text], select {
  width: 100%;
  padding: 12px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
 .button {
  background-color: #04AA6D;;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
}
</style>
<body>

<h2> Create Country </h2>

<form action="{{ route('countries.update', $data->id) }}" method="POST">
  @csrf
  @method('PUT')
  <label for="name">Name</label>
  <input type="text" id="name" name="name" placeholder="Your name.." value="{{ old('name', $data->name ?? '') }}">
  
  <label for="active">Active</label>
  <input type="checkbox" id="active" name="active" value="1" {{ old('active', $data->active ?? '') ? 'checked' : '0' }}>
  
  <input type="submit" value="Update">
</form>

</body>
</html>


