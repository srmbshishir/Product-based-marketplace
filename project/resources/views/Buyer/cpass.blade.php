<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APWT Marketplace</title>
</head>
<body>
    <h1>Change Password</h1>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td><input type="password" value="{{ $user->oldPassword }}" placeholder="old password"></td>
            </tr>
            <tr>
                <td><input type="password" value="{{ $user->newPassword }}" placeholder="new password"></td>
            </tr>
            <tr>
                <td><input type="password" value="rpass" placeholder="confirm password"></td>
            </tr>
            <tr>
                <td><input type="submit" value="submit"></td>
            </tr>
        </table>
    </form>
</body>
</html>