FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# Configurar y instalar extensiones PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    zip \
    pdo \
    pdo_mysql \
    mysqli \
    gd

# Habilitar módulos de Apache necesarios
RUN a2enmod rewrite headers

# Configurar PHP
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 64M/g' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/post_max_size = 8M/post_max_size = 64M/g' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/memory_limit = 128M/memory_limit = 256M/g' "$PHP_INI_DIR/php.ini"

# Configurar Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Crear configuración personalizada de Apache
RUN echo '\
<VirtualHost *:80>\
    DocumentRoot ${APACHE_DOCUMENT_ROOT}\
    DirectoryIndex index.php\
\
    <Directory ${APACHE_DOCUMENT_ROOT}>\
        Options -Indexes +FollowSymLinks\
        AllowOverride All\
        Require all granted\
    </Directory>\
\
    <FilesMatch "\.php$">\
        SetHandler application/x-httpd-php\
    </FilesMatch>\
\
    AddType text/javascript .js\
    AddType text/css .css\
    AddType image/svg+xml .svg\
    AddType application/x-font-woff .woff\
    AddType application/x-font-woff2 .woff2\
    AddType application/x-font-ttf .ttf\
    AddType application/x-font-eot .eot\
\
    <LocationMatch "\.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$">\
        Header set Cache-Control "max-age=31536000"\
    </LocationMatch>\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Copiar archivos de la aplicación
COPY . .

# Establecer permisos correctos
RUN chown -R www-data:www-data . && \
    find . -type f -exec chmod 644 {} \; && \
    find . -type d -exec chmod 755 {} \;

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
