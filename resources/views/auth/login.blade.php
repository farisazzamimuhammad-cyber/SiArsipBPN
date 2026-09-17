<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - SIARSIP BPN</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css">

</head>

<body class="d-flex flex-column">

<div class="page page-center">

    <div class="container container-tight py-4">

        <div class="text-center mb-4">

            <h1>
                SIARSIP BPN
            </h1>

            <p class="text-secondary">
                Sistem Informasi Arsip BPN
            </p>

        </div>


        <div class="card card-md">

            <div class="card-body">

                <h2 class="h2 text-center mb-4">
                    Login
                </h2>


                <form action="{{ route('login') }}"
                      method="POST">

                    @csrf


                    {{-- EMAIL --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan email"
                            value="{{ old('email') }}"
                            required>

                    </div>


                    {{-- PASSWORD --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            required>

                    </div>


                    {{-- ERROR --}}
                    @if ($errors->any())

                        <div class="alert alert-danger">

                            {{ $errors->first() }}

                        </div>

                    @endif


                    <div class="form-footer">

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            Login

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler.min.js">
</script>

</body>

</html>