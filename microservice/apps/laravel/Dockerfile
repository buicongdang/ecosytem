FROM tdien105/php:7.3-pg

# RUN apt-get update

# RUN apt-get update && apt-get install -y \
#         libfreetype6-dev \
#         libjpeg62-turbo-dev \
#         libpng-dev \
#         libpcre3-dev \
#         libpq-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd

# RUN  docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
#     && docker-php-ext-install pdo pdo_pgsql pgsql \
#     && docker-php-ext-enable pdo pdo_pgsql pgsql 

# RUN docker-php-ext-install pgsql pdo_pgsql
# RUN pecl install oauth 
#     pecl install oauth \
#     pecl install pdo_pgsql
# RUN docker-php-ext-enable mongodb oauth pdo_pgsql
# Set working directory
WORKDIR /var/www/laravel


# Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Add user for laravel application
# RUN groupadd -g 1000 www
# RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/laravel

# Copy existing application directory permissions
COPY --chown=www:www . /var/www/laravel

# Change current user to www
USER www

# Composer install
# RUN composer install
# RUN composer update --no-scripts
# RUN composer dump-autoload



# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

