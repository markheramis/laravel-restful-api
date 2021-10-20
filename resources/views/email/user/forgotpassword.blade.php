<!DOCTYPE html>
<html>
    <head>
        <title>Forgot Password</title>
        <style type="text/css">
            body {
                background-color: #fff;
                font-family: Arial, Helvetica, sans-serif;
            }

            *, *:before, *:after {
                box-sizing: border-box;
            }
            .container {
                width: 100%;
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
            }
            .m-auto {
                margin: auto;
            }
            h2, p {
                color: #fff;
            }
            .text-center {
                text-align: center;
            }
            .p-body {
                line-height: 2;
            }
            .btn {
                text-decoration: none;
                display: inline-block;
                font-weight: 400;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                border: 1px solid transparent;
                padding: .375rem .75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: .25rem;
                transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            }
            .btn-primary {
                color: #fff;
                background-color: #007bff;
                border-color: #007bff;
            }
            .btn-primary:hover {
                color: #fff;
                background-color: #0069d9;
                border-color: #0062cc;
            }
            .mt-3 {
                margin-top: 1rem!important;
            } 
            .mb-3 {
                margin-bottom: 1rem!important;
            }
            .mt-5 {
                margin-top: 3rem!important;
            }
            .mb-5 {
                margin-bottom: 3rem!important;
            }
            .card {
                background-color: #2d3a4b;
                position: relative;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-orient: vertical;
                -webkit-box-direction: normal;
                -ms-flex-direction: column;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-clip: border-box;
                border: 1px solid rgba(0,0,0,.125);
                border-radius: .25rem;
            }
            .card-body {
                -webkit-box-flex: 1;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                padding: 1.25rem;
            }

            @media (min-width: 992px) {
                .col-lg-9 {
                    -ms-flex: 0 0 58.333333%;
                    flex: 0 0 58.333333%;
                    max-width: 58.333333%;
                }
            }
            @media (min-width: 768px) {
                .col-md-9 {
                    -ms-flex: 0 0 58.333333%;
                    flex: 0 0 58.333333%;
                    max-width: 58.333333%;
                }
            }
            @media (min-width: 576px) {
                .col-sm-9 {
                    -ms-flex: 0 0 58.333333%;
                    flex: 0 0 58.333333%;
                    max-width: 58.333333%;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="col-lg-9 col-md-9 col-sm-9 m-auto">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="mb-5 text-center">Forgot Password</h2>
                        <p class="mb-5">Hello, {{ $email }}</p>
                        <p class="mb-3 p-body">We received a request to reset your password.  To begin the password reset process for your account, click the link below</p>
                        <hr/>
                        <a href="{{ $url }}" class="btn btn-primary mt-3">Reset Password</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>