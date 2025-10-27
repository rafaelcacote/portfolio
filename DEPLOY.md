# Guia de Deploy - Portfólio Laravel

Este guia apresenta diferentes opções para publicar seu portfólio Laravel online.

## 1. Deploy no Heroku (Gratuito/Pago)

### Pré-requisitos
- Conta no Heroku
- Heroku CLI instalado
- Git configurado

### Passos

1. **Prepare o projeto:**
   ```bash
   echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
   ```

2. **Configure o banco de dados no `.env`:**
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=${DB_HOST}
   DB_PORT=${DB_PORT}
   DB_DATABASE=${DB_DATABASE}
   DB_USERNAME=${DB_USERNAME}
   DB_PASSWORD=${DB_PASSWORD}
   ```

3. **Crie a aplicação no Heroku:**
   ```bash
   heroku create nome-do-seu-portfolio
   heroku addons:create heroku-postgresql:mini
   ```

4. **Configure as variáveis de ambiente:**
   ```bash
   heroku config:set APP_KEY=$(php artisan --no-ansi key:generate --show)
   heroku config:set APP_ENV=production
   heroku config:set APP_DEBUG=false
   heroku config:set APP_URL=https://nome-do-seu-portfolio.herokuapp.com
   ```

5. **Deploy:**
   ```bash
   git add .
   git commit -m "Deploy inicial"
   git push heroku main
   heroku run php artisan migrate --force
   ```

## 2. Deploy no DigitalOcean (Pago)

### Usando DigitalOcean App Platform

1. **Conecte seu repositório GitHub**
2. **Configure as variáveis de ambiente:**
   - `APP_KEY`: Gere com `php artisan key:generate --show`
   - `APP_ENV`: `production`
   - `APP_DEBUG`: `false`
   - `APP_URL`: URL da sua aplicação
   - Configurações de banco de dados

3. **Configure o banco de dados:**
   - Crie um cluster PostgreSQL ou MySQL
   - Configure as variáveis DB_* com os dados do cluster

4. **Build e Deploy automático**

### Usando Droplet (VPS)

1. **Crie um Droplet Ubuntu 22.04**

2. **Configure o servidor:**
   ```bash
   # Atualize o sistema
   sudo apt update && sudo apt upgrade -y
   
   # Instale dependências
   sudo apt install nginx mysql-server php8.1-fpm php8.1-mysql php8.1-xml php8.1-mbstring php8.1-curl php8.1-zip unzip git -y
   
   # Instale Composer
   curl -sS https://getcomposer.org/installer | php
   sudo mv composer.phar /usr/local/bin/composer
   
   # Instale Node.js
   curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
   sudo apt-get install -y nodejs
   ```

3. **Configure o MySQL:**
   ```bash
   sudo mysql_secure_installation
   sudo mysql -u root -p
   ```
   ```sql
   CREATE DATABASE portfolio;
   CREATE USER 'portfolio_user'@'localhost' IDENTIFIED BY 'senha_segura';
   GRANT ALL PRIVILEGES ON portfolio.* TO 'portfolio_user'@'localhost';
   FLUSH PRIVILEGES;
   EXIT;
   ```

4. **Clone e configure o projeto:**
   ```bash
   cd /var/www
   sudo git clone https://github.com/seu-usuario/portfolio-laravel.git
   sudo chown -R www-data:www-data portfolio-laravel
   cd portfolio-laravel
   sudo -u www-data composer install --optimize-autoloader --no-dev
   sudo -u www-data cp .env.example .env
   sudo -u www-data php artisan key:generate
   ```

5. **Configure o Nginx:**
   ```bash
   sudo nano /etc/nginx/sites-available/portfolio
   ```
   ```nginx
   server {
       listen 80;
       server_name seu-dominio.com;
       root /var/www/portfolio-laravel/public;
       
       add_header X-Frame-Options "SAMEORIGIN";
       add_header X-Content-Type-Options "nosniff";
       
       index index.php;
       
       charset utf-8;
       
       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }
       
       location = /favicon.ico { access_log off; log_not_found off; }
       location = /robots.txt  { access_log off; log_not_found off; }
       
       error_page 404 /index.php;
       
       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
       }
       
       location ~ /\.(?!well-known).* {
           deny all;
       }
   }
   ```

6. **Ative o site:**
   ```bash
   sudo ln -s /etc/nginx/sites-available/portfolio /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl reload nginx
   ```

## 3. Deploy no Vultr (Pago)

Similar ao DigitalOcean, mas com preços mais competitivos:

1. **Crie uma instância Ubuntu**
2. **Siga os mesmos passos do DigitalOcean Droplet**
3. **Configure SSL com Let's Encrypt:**
   ```bash
   sudo apt install certbot python3-certbot-nginx
   sudo certbot --nginx -d seu-dominio.com
   ```

## 4. Deploy no Shared Hosting

Para hospedagens compartilhadas (como Hostinger, GoDaddy):

1. **Prepare o projeto localmente:**
   ```bash
   composer install --optimize-autoloader --no-dev
   npm run build
   ```

2. **Faça upload dos arquivos:**
   - Envie todos os arquivos exceto a pasta `public`
   - Envie o conteúdo da pasta `public` para a pasta `public_html`

3. **Configure o `.env`:**
   - Use as configurações de banco fornecidas pela hospedagem

4. **Ajuste o `index.php`:**
   ```php
   require __DIR__.'/../portfolio-laravel/vendor/autoload.php';
   $app = require_once __DIR__.'/../portfolio-laravel/bootstrap/app.php';
   ```

## 5. Deploy com Docker

### Dockerfile
```dockerfile
FROM php:8.1-fpm

# Instalar dependências
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Instalar extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Configurar diretório de trabalho
WORKDIR /var/www

# Copiar arquivos
COPY . /var/www

# Instalar dependências
RUN composer install --optimize-autoloader --no-dev
RUN npm install && npm run build

# Configurar permissões
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage

EXPOSE 9000
CMD ["php-fpm"]
```

### docker-compose.yml
```yaml
version: '3.8'
services:
  app:
    build: .
    container_name: portfolio-app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - ./:/var/www
    networks:
      - portfolio-network

  webserver:
    image: nginx:alpine
    container_name: portfolio-nginx
    restart: unless-stopped
    ports:
      - "80:80"
    volumes:
      - ./:/var/www
      - ./docker/nginx:/etc/nginx/conf.d
    networks:
      - portfolio-network

  db:
    image: mysql:8.0
    container_name: portfolio-db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: portfolio
      MYSQL_ROOT_PASSWORD: root_password
      MYSQL_USER: portfolio_user
      MYSQL_PASSWORD: user_password
    volumes:
      - dbdata:/var/lib/mysql
    networks:
      - portfolio-network

volumes:
  dbdata:

networks:
  portfolio-network:
    driver: bridge
```

## Configurações Importantes

### Variáveis de Ambiente Essenciais
```env
APP_NAME="Seu Portfolio"
APP_ENV=production
APP_KEY=base64:sua-chave-aqui
APP_DEBUG=false
APP_URL=https://seu-dominio.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=usuario
DB_PASSWORD=senha

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu-email@gmail.com
MAIL_FROM_NAME="Seu Nome"
```

### Comandos Pós-Deploy
```bash
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

### SSL/HTTPS
Para qualquer deploy, configure SSL:

**Com Let's Encrypt (gratuito):**
```bash
sudo certbot --nginx -d seu-dominio.com
```

**Com Cloudflare (gratuito):**
1. Adicione seu domínio ao Cloudflare
2. Configure os DNS records
3. Ative o SSL/TLS

## Monitoramento e Manutenção

### Logs
- Monitore os logs em `storage/logs/`
- Configure log rotation
- Use serviços como Sentry para monitoramento de erros

### Backup
Configure backup automático:
```bash
# Crontab para backup diário
0 2 * * * mysqldump -u usuario -p senha portfolio > /backups/portfolio_$(date +\%Y\%m\%d).sql
```

### Atualizações
1. Sempre faça backup antes de atualizar
2. Teste em ambiente de desenvolvimento
3. Use deployment tools como Deployer ou Envoyer

## Domínio Personalizado

1. **Registre um domínio** (Namecheap, GoDaddy, Registro.br)
2. **Configure os DNS records:**
   - A record: `@` → IP do servidor
   - CNAME record: `www` → seu-dominio.com
3. **Configure SSL**
4. **Teste a configuração**

## Suporte

Para problemas específicos de deploy:
- Verifique os logs do servidor
- Teste as configurações localmente
- Consulte a documentação da plataforma escolhida
- Entre em contato através dos canais de suporte

