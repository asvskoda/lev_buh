FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Install system dependencies
RUN sed -i \
        -e 's|http://deb.debian.org/debian-security|https://snapshot.debian.org/archive/debian-security/20260831T235959Z|' \
        -e 's|http://deb.debian.org/debian|https://snapshot.debian.org/archive/debian/20260831T235959Z|' \
        /etc/apt/sources.list \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get -o Acquire::Check-Valid-Until=false update \
    && apt-get install -y \
    sudo \
    git \
    curl \
    libmcrypt-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    libpq5 \
    libpq-dev \
    libjpeg-dev \
    libxpm-dev \
    libpng-dev \
    libfreetype6-dev \
    libicu-dev \
    unzip \
    libreoffice \
    supervisor \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
#----------------------#

# Install xdebug
RUN pecl install xdebug-2.9.0 \
    && docker-php-ext-enable xdebug
#----------------------#

# Install PHP extensions
RUN docker-php-ext-configure intl && docker-php-ext-configure gd \
    --with-freetype=/usr/include/ \
    --with-jpeg=/usr/include/ \
    --with-xpm=/usr/include

RUN pecl install mcrypt-1.0.4 && \
    docker-php-ext-enable mcrypt

RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd soap sockets intl zip

# Get latest Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
#---------------------#

# Set working directory
WORKDIR /var/www

RUN useradd -G www-data,root,sudo -u $uid -p $(openssl passwd -1 '123') -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

USER $user
