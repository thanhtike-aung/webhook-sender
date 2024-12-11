<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <title>Products</title>
</head>

<body>
    <div class="main-content">
        <div class="container my-5">
            <h1 class="text-center mb-4">Products</h1>

            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-md-4 col-sm-6">
                        <div class="card h-100 shadow-sm">
                            <!-- Product Image -->
                            <img src="{{ $product['image'] }}" alt="{{ $product['title'] }}" class="card-img-top"
                                style="height: 200px; object-fit: cover;">

                            <!-- Product Details -->
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ \Illuminate\Support\Str::limit($product['title'], 40) }}</h5>
                                <p class="card-text text-muted">
                                    {{ \Illuminate\Support\Str::limit($product['description'], 80) }}</p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span
                                            class="fw-bold text-primary">${{ number_format($product['price'], 2) }}</span>
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="window.location.href='{{ route('product.order', ['product_data' => $product]) }}'">Order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @if (session('toast'))
        <script>
            toastr.success("{{ session('toast') }}")
        </script>
    @endif
</body>

</html>
