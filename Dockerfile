# Use a imagem base do PHP 8.1.25
FROM php:8.1.25-cli

# Instale as dependências necessárias para o PHP, Laravel e SQLite
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    curl \
    libsqlite3-dev \
    && docker-php-ext-install zip pdo pdo_sqlite

# Instale o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Defina o diretório de trabalho
WORKDIR /var/www/html

# Copie os arquivos da aplicação
COPY . .

# Instale as dependências do Laravel
RUN composer install

# Exponha a porta 9091 para o servidor web
EXPOSE 9091

# Comando para iniciar o servidor Laravel na porta 9091
CMD php artisan serve --host=0.0.0.0 --port=9091
