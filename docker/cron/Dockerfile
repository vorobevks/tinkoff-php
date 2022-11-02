FROM php:8.0-cli

RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        nano \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
	libpng-dev \
	libonig-dev \
	libzip-dev \
	libmcrypt-dev \
    cron \
        && pecl install mcrypt-1.0.4 \
    && pecl install grpc \
	&& docker-php-ext-enable mcrypt \
        && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd

# Copy hello-cron file to the cron.d directory
COPY cron-list /etc/cron.d/cron-list

# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/cron-list

# Apply cron job
RUN crontab /etc/cron.d/cron-list

# Create the log file to be able to run tail
RUN touch /var/log/cron.log

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

WORKDIR /var/www/backend

# Run the command on container startup
CMD cron && tail -f /var/log/cron.log
