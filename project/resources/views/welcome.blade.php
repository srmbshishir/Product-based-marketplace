{{-- <!DOCTYPE html>
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
        @foreach ($userlist as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->p_condition}}</td>
                <td>{{$product->category}}</td>
                <td>{{$product->discount}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->description}}</td>
                <td><img src="/upload/{{$product->image}}" alt="" width="200px" height="150px"></td>

                <td>
                    <a href="/product/{{$product->id}}/edit/"> Edit</a>
                    <a href="/product/{{$product->id}}/delete/" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        @endforeach
 	</table>
    
</body>
</html> --}}