<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">Login</h3>

                    <form action="{{route('login') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input 
                            type="text"
                            name="username"
                            class="form-control @error('username') is-invalid @enderror"
                            value="{{ old('username') }}" required>

                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input 
                            type="password"
                            name="password"
                            id="password"
                            class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>