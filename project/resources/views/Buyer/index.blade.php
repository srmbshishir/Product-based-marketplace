<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APWT Marketplace</title>
</head>
<body>
    <h1>APWT MarketPlace</h1>
    <a href="/buyer/profile/{{session('id')}}">{{ session('name') }}</a>
    <a href="{{route('logout')}}"><button>Log out</button></a>
    <table class="table table-striped">
		<tr>
            <td>Product Id</td>
            <td>Product Name</td>
			<td>Price</td>
			<td>Condition</td>
            <td>Category</td>
            <td>Discount</td>
            <td>Quantity</td>
            <td>description</td>
            <td>image</td>
            <td>Action</td>
		</tr>
        @foreach ($product as $key => $data)
            <tr>
                <td>{{$data->id}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->price}}</td>
                <td>{{$data->p_condition}}</td>
                <td>{{$data->category}}</td>
                <td>{{$data->discount}}</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->description}}</td>
                <td><img src="/upload/{{$data->image}}" alt="" width="200px" height="150px"></td>
                <td><a href="buyer/buy/{{ session('id') }}">Buy</a><br><a href="buyer/cart/{{ session('id') }}">Add to cart</a></td>
            </tr>
        @endforeach
 	</table>
</body>
</html>