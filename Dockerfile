FROM php:8.2-fpm

# set your user name, ex: user=carlos
ARG user=yourusername
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    ca-certificates \
    cron \
    nano

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Config Cron
#RUN touch /var/log/cron-1.log
#RUN (crontab -l ; echo "* * * * * php artisan schedule:run >> /dev/null 2>&1") | crontab

# entrypoint.sh
#COPY confs/php/entrypoint.sh /etc/cron.d/entrypoint.sh
#RUN chmod +x /etc/cron.d/entrypoint.sh
#CMD ["bash","entrypoint.sh"]

# Set working directory
WORKDIR /var/www

# Copy custom configurations PHP
COPY confs/php/custom.ini /usr/local/etc/php/conf.d/custom.ini
COPY confs/php/cacert.pem /usr/local/etc/php/cacert.pem

USER $user
