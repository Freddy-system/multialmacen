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
    && sed -i 's/memory_limit = 128M/memory_limit = 256M/g' "$PHP_INI_DIR/php.ini" \
    && sed -i 's/display_errors = Off/display_errors = On/g' "$PHP_INI_DIR/php.ini"

# Configurar Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html
ENV APACHE_LOG_DIR /var/log/apache2

# Crear directorio de logs
RUN mkdir -p /var/log/apache2

# Copiar configuración personalizada de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Configurar ServerName globalmente
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Exponer puerto 80
EXPOSE 80

WORKDIR /var/www/html

# Copiar archivos de la aplicación
COPY . .

# Establecer permisos correctos
RUN chown -R www-data:www-data . && \
    find . -type f -exec chmod 644 {} \; && \
    find . -type d -exec chmod 755 {} \;

# Dar permisos de escritura a los logs
RUN chown -R www-data:www-data /var/log/apache2

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
