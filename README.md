# INBOX Agency
This is a project build for INBOX Agency.

Let's begin:

### Database setup

Just go in the main folder and run the "initDatabase.sql" on your MySQL server.
Now go in 'config' folder and open the db.php and put your server information
```
'dsn' => 'mysql:host=localhost;dbname=inbox',
'username' => 'root',
'password' => '',
```

### Server configurations

If you don't want to do any configuration you can access the project with this address 
```
http://localhost/inbox/web/index.php
```
* Recommended Apache Configuration
Use the following configuration in Apache's httpd.conf file or within a virtual host configuration. Note that you should replace path/to/inbox/web with the actual path for inbox/web.

```
# Set document root to be "inbox/web"
DocumentRoot "path/to/inbox/web"

<Directory "path/to/inbox/web">
    # use mod_rewrite for pretty URL support
    RewriteEngine on
    # If a directory or a file exists, use the request directly
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    # Otherwise forward the request to index.php
    RewriteRule . index.php

    # if $showScriptName is false in UrlManager, do not allow accessing URLs with script name
    RewriteRule ^index.php/ - [L,R=404]

    # ...other settings...
</Directory>
```

* Recommended Nginx Configuration
To use Nginx, you should install PHP as an FPM SAPI. You may use the following Nginx configuration, replacing path/to/inbox/web with the actual path for inbox/web and mysite.test with the actual hostname to serve.

```
server {
    charset utf-8;
    client_max_body_size 128M;

    listen 80; ## listen for ipv4
    #listen [::]:80 default_server ipv6only=on; ## listen for ipv6

    server_name mysite.test;
    root        /path/to/inbox/web;
    index       index.php;

    access_log  /path/to/inbox/log/access.log;
    error_log   /path/to/inbox/log/error.log;

    location / {
        # Redirect everything that isn't a real file to index.php
        try_files $uri $uri/ /index.php$is_args$args;
    }

    # uncomment to avoid processing of calls to non-existing static files by Yii
    #location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
    #    try_files $uri =404;
    #}
    #error_page 404 /404.html;

    # deny accessing php files for the /assets directory
    location ~ ^/assets/.*\.php$ {
        deny all;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass 127.0.0.1:9000;
        #fastcgi_pass unix:/var/run/php5-fpm.sock;
        try_files $uri =404;
    }

    location ~* /\. {
        deny all;
    }
}
```

### Mailer

If you want to send real email, you need to configure the web.php file, change the "useFileTransport" to false and fix the transport configuration.
If you don't want to setup a production mailer you can access the sent email in "\runtime\mail" folder, you can open the archive with a nodePad.
```
'mailer' => [
    'class' => 'yii\swiftmailer\Mailer',
    // to send production emails you need to change the "useFileTransport" to FALSE and fix the transport configurations.
    'useFileTransport' => true,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'sub4.mail.dreamhost.com',
        'username' => 'tnt@lbbdev.studio',
        'password' => 'password',
        'port' => '587',
        'encryption' => 'tls',
    ],
],
```

#### If you have any question, please don't hesitate to contact me.
##### My email is surfjzo@gmail.com