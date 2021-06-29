<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>APWT Marketplace</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form align="center" method="post">
   @csrf
        <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" value="{{$user->name}}"></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="email" name="email" value="{{$user->email}}"></td>
      </tr>
      <tr>
          <td>Address</td>
          <td><input type="text" name="address" value="{{$user->address}}"></td>
      </tr>
      <tr>
          <td>Mobile</td>
          <td><input type="phone" name="phone" value="{{$user->phone}}"></td>
      </tr>
      <tr>
          <td></td>
          <td><input type="submit" name="edit"></td>
          <td></td>
      </tr>
      <tr>
          <td><a href="buyer/cpass/{{ session('id') }}">Change Password</a></td>
      </tr>
    </form>
    @foreach ($errors->all() as $error)
  {{$error}} <br>
  @endforeach
</body>
</html>