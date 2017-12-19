# ELectronics Store
## Installation
### Virtual host configuration
You have to use a virtual host to be able to navigate to staff area to add devices to the store.

Here is how you can make a virtual host on Ubuntu.
1. Clone the repo into `~/projects/electornics-store` path
2. Run the following commands to generate a config file for the virtual host
```bash
$ cd /etc/apache2/sites-available
$ sudo touch electronics.conf
$ sudo vim electronics.conf
```
3. Copy and paste the following code in `electornics.conf` and change `YOUR_EMAIL` and `YOUR_USERNAME` to your values
```xml
<VirtualHost *:80>
        ServerName electronics.dev
        ServerAlias staff.electronics.dev

        ServerAdmin YOUR_EMAIL
        DocumentRoot /home/YOUR_USERNAME/projects/electronics-store/public

        <Directory /home/YOUR_USERNAME/projects/electronics-store/public >
                Options -Indexes +FollowSymlinks +MultiViews
                AllowOverride all
                Require all granted
        </Directory>

        ErrorLog ${APACHE_LOG_DIR}/electronics-error.log
        CustomLog ${APACHE_LOG_DIR}/electronics-access.log combined
</VirtualHost>
```
4. Then run following commands to add the domains to the hosts file
```bash
$ sudo vim /etc/hosts
```
5. Add these lines to the end of the file
```text
127.0.0.1	electronics.dev
127.0.0.1	staff.electronics.dev
```
6. Finally run this command to enable the virtual host and reload the apache server
```bash
$ sudo a2ensite electronics.conf
$ sudo systemctl reload apache2
```
### Laravel setup
Navigate to electornics-store repo and configure your .env database variables and add electornics.dev to `APP_URL` variable, then run the following.
```bash
$ sudo chmod -R 777 bootstrap/
$ sudo chmod -R 777 storage/
$ php artisan key:generate
$ composer install
$ php artisan migrate --seed
```
Navigate to [electronics.dev]() to view the frontend website and [staff.electornics.dev]() to view the dashboard.
Use these credentials to login to dashboard
```
Email: admin@admin.com
Password: secret
```