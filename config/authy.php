<?php
return [
    "app_id" => env("AUTHY_APP_ID", ""),
    "app_secret" => env("AUTHY_APP_SECRET", ""),
    "webhook" => [
        "app_api_key" => env("AUTHY_WEBHOOK_API_KEY", ""),
        "access_key" => env("AUTHY_WEBHOOK_ACCESS_KEY", ""),
        "api_signing_key" => env("AUTHY_WEBHOOK_API_SIGNING_KEY", "")
    ],
    "test_user" => env("AUTHY_TEST_USERS", "")
];
