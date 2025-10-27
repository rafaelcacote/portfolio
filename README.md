# Portfólio Profissional em Laravel

Este é um projeto de portfólio profissional completo desenvolvido em Laravel, com o objetivo de apresentar trabalhos, captar projetos de freelances e compartilhar conteúdo.

## 🚀 Tecnologias Utilizadas

- [Laravel](https://laravel.com/)
- PHP
- MySQL, PostgreSQL ou SQLite
- Tailwind CSS
- Vite
- JavaScript

## ✨ Funcionalidades

- Página Inicial: Apresentação, serviços e banner.
- Portfólio: Listagem de projetos com detalhes.
- Contato: Formulário para orçamentos com integração de e-mail.
- Blog: Área para artigos e novidades.
- Área Administrativa: Gerenciamento de projetos, posts e mensagens.
- Integrações: LinkedIn, WhatsApp e GitHub.
- Design: Moderno, responsivo e profissional.

## 📁 Estrutura do Projeto

- `app/` - Código principal da aplicação
- `resources/views/` - Templates Blade
- `public/` - Arquivos públicos (imagens, CSS, JS)
- `routes/` - Rotas da aplicação

## 📦 Requisitos

- PHP >= 8.1
- Composer
- Node.js & NPM
- Banco de dados (MySQL, PostgreSQL ou SQLite)

## ⚙️ Como Rodar Localmente

1.  **Clone o repositório:**

    ```bash
    git clone https://github.com/seu-usuario/portfolio-laravel.git
    cd portfolio-laravel
    ```

2.  **Instale as dependências:**

    ```bash
    composer install
    npm install
    ```

3.  **Configure o ambiente:**

    ```bash
    cp .env.example .env
    # Edite o .env conforme necessário
    ```

4.  **Gere a chave da aplicação:**

    ```bash
    php artisan key:generate
    ```

5.  **Execute as migrations:**

    ```bash
    php artisan migrate
    ```

6.  **Compile os assets:**

    ```bash
    npm run dev
    ```

7.  **Inicie o servidor:**

    ```bash
    php artisan serve
    ```

8.  **Acesse o site:**

    Abra o navegador e acesse `http://localhost:8000`.

## ☁️ Como Publicar Online

Para publicar o projeto online, utilize serviços como Heroku, DigitalOcean, Vultr, ou qualquer outro provedor de hospedagem que suporte PHP e Laravel.

### Passos Gerais

1.  Configure o servidor (PHP, Composer, Node.js, banco de dados).
2.  Envie os arquivos (Git ou FTP).
3.  Configure o ambiente de produção (`.env`).
4.  Otimize o projeto:

    ```bash
    composer install --optimize-autoloader --no-dev
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

5.  Execute as migrations:

    ```bash
    php artisan migrate --force
    ```

6.  Configure as permissões das pastas `storage` e `bootstrap/cache`.

## 🤝 Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests.

## 👤 Autor

- RafaelCacote(https://github.com/rafaelcacote)

---

Sinta-se à vontade para contribuir, sugerir melhorias ou reportar problemas!
