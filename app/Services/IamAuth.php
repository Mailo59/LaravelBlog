<?php

namespace App\Services;

use Aws\Rds\AuthTokenGenerator;
use Aws\Credentials\CredentialProvider;
use Aws\Sdk;

class IamAuth
{
    public static function generateAuthToken()
    {
        $region = env('AWS_DEFAULT_REGION', 'us-east-1');
        $host = env('DB_HOST');
        $port = env('DB_PORT', 3306);
        $username = env('DB_USERNAME');

        $provider = CredentialProvider::defaultProvider();
        $rdsAuthGenerator = new AuthTokenGenerator($provider);

        return $rdsAuthGenerator->createToken("{$host}:{$port}", $region, $username);
    }
}
