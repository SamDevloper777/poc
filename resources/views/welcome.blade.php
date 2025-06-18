<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tabler Demo</title>
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/css/tabler.min.css" />
</head>

<body>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="card-title mb-3">Login Info</h3>
                    
                    <p class="mb-1"><strong>Email:</strong> sam@gmail.com</p>
                    <p class="mb-3"><strong>Password:</strong> 123456789</p>

                    <a href="{{ route('login') }}" class="btn btn-primary w-100">
                        <i class="ti ti-login me-1"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

  
  <script
    src="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/js/tabler.min.js">
  </script>
</body>

</html>