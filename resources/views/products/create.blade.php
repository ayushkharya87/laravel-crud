<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Products | create</title>
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Laravel Crud</h3>
    </div>

    <div class="container">
        {{-- back btn --}}
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark text-white">
                        <h3>Create Product</h3>
                    </div>
                    {{-- -------------- card body ----------- --}}
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- name --}}
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" value="{{ old('name') }}" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name">
                                @error('name')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- sku --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Sku</label>
                                <input type="text" value="{{ old('sku') }}" class="@error('sku') is-invalid @enderror  form-control form-control-lg" placeholder="Sku"
                                    name="sku">
                                    @error('sku')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                            </div>
                            {{-- price --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Price</label>
                                <input type="text" value="{{ old('price') }}" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price"
                                    name="price">
                                    @error('price')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                            </div>
                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <textarea placeholder="Description" class="form-control" name="description" id="" cols="30"
                                    rows="4">{{ old('name') }}</textarea>
                            </div>
                            {{-- image --}}
                            <div class="mb-3">
                                <label for="" class="form-label">Image</label>
                                <input type="file" class="form-control form-control-lg" name="image">
                            </div>
                            {{-- btn --}}
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
