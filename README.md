Стек: PHP7.3, Mysql, Yii2

nginx-конфиг:
server {

    charset utf-8;

    client_max_body_size 128M;



    listen 80; ## listen for ipv4

    #listen [::]:80 default_server ipv6only=on; ## listen for ipv6



    server_name test.local;

    root        /var/www/test/web;

    index       index.php;



    access_log  /var/log/nginx/access.log;

    error_log   /var/log/nginx/error.log;



    location / {

        # Redirect everything that isn't a real file to index.php

        try_files $uri $uri/ /index.php$is_args$args;

    }

   

 

    # deny accessing php files for the /assets directory

    location ~ ^/assets/.*\.php$ {

        deny all;

    }



         location ~ \.php$ {

      fastcgi_split_path_info ^(.+?\.php)(/.*)$;

      fastcgi_pass unix:/run/php/php7.3-fpm.sock;

      fastcgi_index  index.php;

      include fastcgi_params;

      fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;

      fastcgi_param PATH_INFO $fastcgi_path_info;

      fastcgi_read_timeout 600s;

    }



    location ~* /\. {

        deny all;

    }

}
