<!DOCTYPE html>
<html lang="en">

<head>
    <title>APLIKASI GUDANG BACKEND | LOGIN
    </title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Deranfyzn_ &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="shortcut icon" href="assets/media/telu/D.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body id="kt_body" class="bg-dark">
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14-dark.png">
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <a href="{{ route('login') }}" class="mb-12">
                    <img alt="Logo" src="assets/media/telu/dyfzn.png" class="h-50px" />
                </a>
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <form id="form-login" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="text-center mb-10">
                            <h1 class="text-dark mb-3">Aplikasi Gudang Backend</h1>
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Username</label>
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="textHelp" required>
                            @if($errors->has('username'))
                            <span class="error">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="fv-row mb-10">
                            <label class="form-label fs-6 fw-bolder text-dark">Password</label>
                            <div class="input-group mb-5">
                                <input type="password" class="form-control" class="form-control form-control-solid" id="password" name="password" required aria-label="Recipient's username" aria-describedby="basic-addon2" />
                                <span class="input-group-text" id="show-hide">
                                    <i class="fs-4 bi bi-eye-fill" id="eye"></i>
                                </span>
                            </div>
                            @if($errors->has('password'))
                            <span class="error">{{ $errors->first('password') }}</span>
                            @endif
                            <!-- <div class="form-group mt-3">
                                <div class="form-check form-check-custom form-check-solid form-check-sm">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck" />
                                    <label class="form-check-label" for="rememberPasswordCheck">Remember password
                                    </label>
                                </div>
                            </div> -->
                        </div>
                        <div class="text-center">
                            <button type="submit" id="btn-login" class="btn btn-lg btn-dark w-100 mb-5">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <script src="assets/js/custom/authentication/sign-in/general.js"></script>
    <script>
        $(function() {
            $('#btn-login').click(function() {

                let button = $(this);
                button.prop('disabled', true);
                button.html(
                    "<span class='spinner-border spinner-border-sm me-1' role='status' aria-hidden='true'></span> Please wait..."
                );

                let valid = true;
                let msg = '';
                $('#form-login :input[required]').each(function(index, element) {
                    $(this).removeClass('is-invalid');
                    $(this).next('span').removeClass('is-invalid');
                    if ($(this).val() == '') {
                        $(this).addClass('is-invalid');
                        $(this).next('span').addClass('is-invalid');
                        msg = 'Please complete the data';
                        valid = false;
                    }
                });

                if (valid) {
                    let form_data = new FormData($('#form-login')[0]);

                    $.ajax({
                        type: "POST",
                        url: "{{ route('proses_login') }}",
                        data: form_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: "JSON",
                        success: function(response) {
                            if (response.success) {
                                toastr.success("Login Successful!", "Success", {
                                    progressBar: true
                                });
                                setTimeout(function() {
                                    window.location.href =
                                        "{{ route('dashboard') }}";
                                }, 2000);
                            } else {
                                toastr.error(response.msg, "Failed", {
                                    progressBar: true
                                });
                                button.prop('disabled', false);
                                button.text('Log In');
                            }
                        }
                    });
                } else {
                    toastr.warning(msg, "Warning", {
                        progressBar: true
                    });

                    button.prop('disabled', false);
                    button.text('Log In');
                }
            });

            $('#show-hide').click(function() {
                var inputElement = $('#password');
                if (inputElement.prop('type') === 'password') {
                    inputElement.prop('type', 'text');
                    $('#eye').removeClass('bi-eye-fill').addClass('bi-eye-slash-fill');
                } else {
                    inputElement.prop('type', 'password');
                    $('#eye').removeClass('bi-eye-slash-fill').addClass('bi-eye-fill');
                }
            });

        });
    </script>
</body>

</html>