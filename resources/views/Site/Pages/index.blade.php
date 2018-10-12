@extends("Site.Layouts.master")
@section("title")

    | {{ $title  }}
@endsection

@section('content')
    <div class="container">
        <form id= "add-product-form" action="{{ route('site.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="product-name">Product Name</label>
                <input type="text" class="form-control" id="product-name" placeholder="Enter Product Name">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity in stock</label>
                <input type="text" class="form-control" id="quantity" placeholder="Enter the Product Quantity">
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" placeholder="Enter the Product price">
            </div>
            <button type="button" id="btn-form-submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <br />
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Date</th>
                <th scope="col">Total value number</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products['products'] as $key => $product)
                <tr>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                    <td>{{ $product['price'] }}</td>
                    <td>{{ $product['Date'] }}</td>
                    <td>{{ (int)$product['price']  * (int)($product['quantity']) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection