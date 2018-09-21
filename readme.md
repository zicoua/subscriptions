## Install
1. Copy .env.example to .env and set DB configs. Set MAIL_DRIVER to 'log' or configure email
2. composer install
3. php artisan key:generate
4. php artisan migrate --seed

<p>Admin panel: /admin</p>
<p>Login(user in seeder): admin@example.com / password</p>

<p>You can change some configs in config/subscriptions.php</p>
