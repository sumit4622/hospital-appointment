<!DOCTYPE html>
<html>
<head>
    <title>Hospital Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="vh-100">

    <div class="container-fluid h-100">
        <div class="row h-100">

            <div class="col-md-4 d-flex align-items-center justify-content-center bg-light">
                <h1 class="text-success text-center">
                    Hospital Appointment System
                </h1>
            </div>

            <div class="col-md-8 d-flex align-items-center justify-content-center">
                @yield('content')
            </div>

        </div>
    </div>

</body>
</html>