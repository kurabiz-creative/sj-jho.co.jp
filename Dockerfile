FROM wordpress:php8.3-apache

# パーミッションの設定
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# PHPの設定を追加
RUN echo "upload_max_filesize = 2G" > /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size = 2G" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/uploads.ini

# Apacheの設定やPHPの設定を追加する場合はここに記述

# WordPressの起動
CMD ["apache2-foreground"] 