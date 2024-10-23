FROM php:8.3-fpm

WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev \
    libicu-dev \
    libldap2-dev \
    supervisor \
    valgrind \
    gcc \
    wget \
    cron

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the entrypoint script into the container
COPY init.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/init.sh

# Copy data to container
COPY . /var/www/html

RUN composer install --no-interaction --ignore-platform-reqs

RUN mkdir ./storage/app/public/results -p || :
RUN mkdir ./storage/app/private -p || :
RUN cd ./storage/app/private && \
    wget -q https://raw.githubusercontent.com/FedorViest/opp_prpr2024/refs/heads/main/Tester/dist.tar.gz && \
    tar xvfz dist.tar.gz --strip-components=1 && \
    mkdir ./tester && \
    cp ./main/* ./tester/ -r && \
    cp ./tester/main ./tester/tester

RUN cp ./tester/* ./storage/app/private/tester/ -r

EXPOSE 8080
ENTRYPOINT ["/usr/local/bin/init.sh"]
