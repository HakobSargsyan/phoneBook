Symfony Standard Edition
========================

**WARNING**: This distribution does not support Symfony 4. See the
[Installing & Setting up the Symfony Framework][15] page to find a replacement
that fits you best.

Welcome to the Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
-------------

<ul>
  <li>Use php bin/console doctrine:database:create to create a database</li>
  <li>Use php bin/console doctrine:schema:update -- force to create a tables</li>
</ul>

<ul>
  <li>Search person with First Name,Last Name and Phone Number via ajax call</li>
  <li>Search person with First Name,Last Name and Phone Number without ajax call</li>
  <li>Main route is`[base_url]/person</li>
  <li>Bundle:Hs\PhoneBookBundle is used for app </li>
  <li>Bootstrap css is used for all styles </li>
</ul>


<h3>Nginx configuration for phoneBook app is</h3> 

   server{
  
    listen  80;
    
	server_name phonebook.loc;
	
	root /home/sargsyan/projects/phoneBook/web/;
	
    location / {
        # try to serve file directly, fallback to app.php
        try_files $uri /app_dev.php$is_args$args;
    }
    # DEV
    # This rule should only be placed on your development environment
    # In production, don't include this and don't deploy app_dev.php or config.php
    location ~ ^/(app_dev|config)\.php(/|$) {
        fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        # Prevents URIs that include the front controller. This will 404:
        # http://domain.tld/app.php/some-path
        # Remove the internal directive to allow URIs like this
        internal;
    }
    # PROD
    location ~ ^/(app_dev|config)\.php(/|$) {
        fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        # Prevents URIs that include the front controller. This will 404:
        # http://domain.tld/app.php/some-path
        # Remove the internal directive to allow URIs like this
        internal;
    }

    error_log /var/log/nginx/project_error.log;
    access_log /var/log/nginx/project_access.log;
}
