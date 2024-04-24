<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crud Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark">
        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-light"  href="/">Products</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <div class="text-right">
            <a href="/create" class="btn btn-dark mt-2">New Product</a>
        </div>
        <table class="table table-hover mt-2">
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($product))
                @foreach ($product as $product)
                <tr>
                    {{-- <td>{{$loop->index +1}}</td> --}}
                    <td>{{$product->name}}</td>
                    <td>{{$product->description}}</td>
                    <td><img src="product/{{$product->image}}" class="rounded-crircle" width="40" height="40"></td>
                    <td><a href="product/{{$product->id}}/" class="btn btn-dark btn-sm">Edit</a>
                     
                      <form action="product_delete/{{$product->id}}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">delete</button>
                    </form>
                   </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>