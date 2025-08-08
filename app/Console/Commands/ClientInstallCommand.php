<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use function Laravel\Prompts\info;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

class ClientInstallCommand extends Command
{
    protected $signature = 'client:install';

    protected $description = 'Install all the files and settings required for this starter kit';

    public function handle(): void
    {
        info('First we will add the FluxUI credentials');

        $username = text(
            label: 'Your FluxUI username (email)',
            required: true
        );

        $userPassword = password(
            label: 'Your FluxUI licence key',
            required: true
        );

        $data = [
            'http-basic' => [
                'composer.fluxui.dev' => [
                    'username' => $username,
                    'password' => $userPassword,
                ],
            ],
        ];

        $jsonPath = base_path('auth.json');

        file_put_contents(
            $jsonPath,
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );

        info('Licence installed successfully.');

        info('Next we will add the SSO credentials');

        $clientId = text('Enter PASSPORT_CLIENT_ID', required: true);
        $clientSecret = password('Enter PASSPORT_CLIENT_SECRET', required: true);
        $loginUrl = text('Enter PASSPORT_LOGIN_URL', required: true);
        $userEndpoint = text('Enter PASSPORT_USER_ENDPOINT', required: true);

        $this->setEnvValue('PASSPORT_CLIENT_ID', $clientId);
        $this->setEnvValue('PASSPORT_CLIENT_SECRET', $clientSecret);
        $this->setEnvValue('PASSPORT_LOGIN_URL', $loginUrl);
        $this->setEnvValue('PASSPORT_USER_ENDPOINT', $userEndpoint);

        info('SSO installed successfully.');

    }

    protected function setEnvValue(string $key, string $value): void
    {
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        // Escape characters to safely insert
        $value = str_replace('"', '\"', $value);

        $pattern = "/^{$key}=.*$/m";

        if (preg_match($pattern, $envContent)) {
            // Replace the existing line
            $envContent = preg_replace($pattern, "{$key}=\"{$value}\"", $envContent);
        } else {
            // Append new key=value
            $envContent .= "\n{$key}=\"{$value}\"";
        }

        file_put_contents($envPath, $envContent);
    }
}
