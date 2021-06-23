<!DOCTYPE html>
<html>
<head>
	<title>Login page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<h1>Login Page</h1>

	<form method="post">
        @csrf
        <table>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Submit"></td>
                <td></td>
            </tr>
        </table>
        {{session('msg')}}
        @foreach ($errors->all() as $error)
		{{$error}} <br>
	    @endforeach
	</form>
</body>
</html>