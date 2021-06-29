<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>APWT Marketplace</title>
</head>
<body>
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
               <td><a href="/register">Buy</a><br><a href="/register">Add to Cart</a></td>
            </tr>
        @endforeach
 	</table>
    
</body>
</html>