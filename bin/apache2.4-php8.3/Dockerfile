FROM php:apache

# Surpresses debconf complaints of trying to install apt packages interactively
# https://github.com/moby/moby/issues/4032#issuecomment-192327844
 
ARG DEBIAN_FRONTEND=noninteractive

# Update
RUN apt-get -y update --fix-missing && \
    apt-get upgrade -y && \
    apt-get --no-install-recommends install -y apt-utils && \
    rm -rf /var/lib/apt/lists/*

# Install useful tools and install important libaries
RUN apt-get -y update && \
    apt-get -y --no-install-recommends install nano vim wget dialog libsqlite3-dev libsqlite3-0 && \
    apt-get -y --no-install-recommends install default-mysql-client zlib1g-dev libzip-dev libicu-dev && \
    apt-get -y --no-install-recommends install --fix-missing apt-utils build-essential git curl libonig-dev && \ 
    apt-get install -y iputils-ping && \
    apt-get -y --no-install-recommends install --fix-missing libcurl4 libcurl4-openssl-dev zip openssl && \
    rm -rf /var/lib/apt/lists/* && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install xdebug
RUN pecl install xdebug-3.3.1 && \
    docker-php-ext-enable xdebug && \
    mkdir /var/log/xdebug

# Install redis
RUN pecl install redis-6.0.2 && \
    docker-php-ext-enable redis

# Install imagick
RUN apt-get update && \
    apt-get -y --no-install-recommends install --fix-missing libmagickwand-dev && \
    rm -rf /var/lib/apt/lists/*

# Imagick Commit to install
# https://github.com/Imagick/imagick
ARG IMAGICK_COMMIT="28f27044e435a2b203e32675e942eb8de620ee58"

RUN cd /usr/local/src && \
    git clone https://github.com/Imagick/imagick && \
    cd imagick && \
    git checkout ${IMAGICK_COMMIT} && \
    phpize && \
    ./configure && \
    make && \
    make install && \
    cd .. && \
    rm -rf imagick && \
    docker-php-ext-enable imagick

# Other PHP8 Extensions
RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install pdo_sqlite && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install curl && \
    docker-php-ext-install zip && \
    docker-php-ext-install -j$(nproc) intl && \
    docker-php-ext-install mbstring && \
    docker-php-ext-install gettext && \
    docker-php-ext-install calendar && \
    docker-php-ext-install exif

# Install Freetype 
RUN apt-get -y update && \
    apt-get --no-install-recommends install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

# Enable SSL support
RUN a2enmod ssl && \
    a2enmod rewrite && \
    a2enmod headers

COPY cert-gen.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/cert-gen.sh
    
# Enable vhosts aliases
RUN a2enmod vhost_alias
COPY create-vhosts.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/create-vhosts.sh

# Create UID, GID and shared folder
ARG USER_ID
ARG GROUP_ID
ARG UNAME

RUN groupadd -g ${GROUP_ID} ${UNAME} && \
    useradd -m -u ${USER_ID} -g ${GROUP_ID} ${UNAME}

RUN mkdir -p /shared/www && \
    chown ${UNAME}:${UNAME} /shared/www

# Install node / npm / yarn / gulp-cli
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    npm install --global gulp-cli && \
    npm install -g yarn


# Add splash screen
COPY bash-dockbox /etc

RUN bash -c "$(curl -fsSL https://raw.githubusercontent.com/ohmybash/oh-my-bash/master/tools/install.sh)" --prefix=/usr/local && \
    sed -i 's/OSH_THEME=.*/OSH_THEME="zork"/' /usr/local/share/oh-my-bash/bashrc && \
    echo '. /etc/bash-dockbox' >> /usr/local/share/oh-my-bash/bashrc && \
    cp /usr/local/share/oh-my-bash/bashrc ~/.bashrc && \ 
    cp /usr/local/share/oh-my-bash/bashrc /home/${UNAME}/.bashrc

# Cleanup and permissions
RUN rm -rf /usr/src/*
CMD ["/bin/bash", "-c", "/usr/local/bin/create-vhosts.sh && exec apache2ctl -D FOREGROUND"]
WORKDIR /shared/www
