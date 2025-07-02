FROM php:8.2-cli

# Instala extensões necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev unzip zip git curl libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /app

# Copia o projeto
COPY . .

# Instala dependências
RUN composer install --no-dev --optimize-autoloader

# Gera a chave da aplicação
RUN php artisan key:generate

# Expõe a porta para o Laravel
EXPOSE 8000

# Comando para iniciar o servidor
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
