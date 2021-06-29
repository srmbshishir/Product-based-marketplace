<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>Profile</title>
</head>
<body>
    <h1>personal profile of {{ session('id') }}</h1>
    <table>
        <tr>
            <td>Name</td>
            <td>{{ session('name') }}</td>
        </tr>
        <tr>
          <td>Email</td>
          <td>{{ session('email') }}</td>
      </tr>
      <tr>
          <td>Address</td>
          <td>{{ session('address') }}</td>
      </tr>
      <tr>
          <td>Mobile</td>
          <td>{{ session('phone') }}</td>
      </tr>
      <tr>
          <td>Password</td>
          <td>{{ session('password') }}</td>
      </tr>
      <tr>
          <td></td>
          <td><a href="/buyer/edit/{{session('id')}}">Edit</a></td>
      </tr>
    </table>
    <a href="/buyer/index">Go back.</a>
</body>
</html>