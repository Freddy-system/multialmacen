FROM php:8.2-apache

# Instalar dependencias y extensiones PHP
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    zip \
    pdo \
    pdo_mysql \
    mysqli \
    gd \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# Configurar PHP
RUN cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Configurar Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Crear archivo de configuración de Apache
RUN { \
    echo '<VirtualHost *:80>'; \
    echo '    DocumentRoot /var/www/html'; \
    echo '    DirectoryIndex index.php'; \
    echo '    <Directory /var/www/html>'; \
    echo '        Options Indexes FollowSymLinks'; \
    echo '        AllowOverride All'; \
    echo '        Require all granted'; \
    echo '    </Directory>'; \
    echo '</VirtualHost>'; \
} > /etc/apache2/sites-available/000-default.conf

# Exponer puerto 80
EXPOSE 80

# Copiar archivos de la aplicación
COPY . /var/www/html/

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

