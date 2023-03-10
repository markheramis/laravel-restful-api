<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} - Authorization</title>
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/auth.css') }}" rel="stylesheet"/>
        <style>
            .passport-authorize .scopes {
                margin-top: 20px;
            }
            .passport-authorize .buttons {
                margin-top: 25px;
                text-align: center;
            }
            .passport-authorize .btn {
                width: 125px;
            }
            .passport-authorize .btn-approve {
                margin-right: 15px;
            }
            .passport-authorize form {
                display: inline;
            }
        </style>
    </head>
    <body class="passport-authorize">
        <div class="auth-container justify-content-center">
            <div class="card">
                <div class="card-header">
                    Authorization Request
                </div>
                <div class="card-body p-4">
                    <!-- Introduction -->
                    <p>
                        <strong>{{ $client->name }}</strong> is requesting permission to access your account.
                    </p>
                    <!-- Scope List -->
                    @if (count($scopes) > 0)
                    <div class="scopes">
                        <p><strong>This application will be able to:</strong></p>
                        <ul class="list-group list-group-flush">
                            @foreach ($scopes as $scope)
                            <li class="list-group-item">
                                {{ $scope->description }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="buttons">
                        <!-- Authorize Button -->
                        <form method="post" action="{{ route('passport.authorizations.approve') }}">
                            @csrf
                            <input type="hidden" name="state" value="{{ $request->state }}">
                            <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                            <input type="hidden" name="auth_token" value="{{ $authToken }}">
                            <button type="submit" class="btn btn-primary btn-approve">Allow</button>
                        </form>

                        <!-- Cancel Button -->
                        <form method="post" action="{{ route('passport.authorizations.deny') }}">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="state" value="{{ $request->state }}">
                            <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                            <input type="hidden" name="auth_token" value="{{ $authToken }}">
                            <button class="btn btn-secondary">Deny</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
