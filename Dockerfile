FROM php:8.2-apache

# Instala extensões necessárias
RUN docker-php-ext-install mysqli

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copia arquivos do projeto
COPY . /var/www/html/

WORKDIR /var/www/html

# Instala dependências PHP (PHPMailer, Dotenv)
RUN composer install || true

RUN chown -R www-data:www-data /var/www/html

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 8090