# Documentação do Portfólio Profissional

## Estrutura do Projeto

### Diretórios Principais

```
portfolio-laravel/
├── app/
│   ├── Http/Controllers/        # Controllers da aplicação
│   │   ├── Admin/              # Controllers administrativos
│   │   ├── HomeController.php
│   │   ├── PortfolioController.php
│   │   ├── BlogController.php
│   │   └── ContactController.php
│   └── Models/                 # Models Eloquent
│       ├── User.php
│       ├── Project.php
│       ├── BlogPost.php
│       └── ContactMessage.php
├── database/
│   └── migrations/             # Migrations do banco de dados
├── resources/
│   ├── views/                  # Templates Blade
│   │   ├── layouts/           # Layouts base
│   │   ├── home/              # Páginas públicas
│   │   ├── portfolio/
│   │   ├── blog/
│   │   ├── contact/
│   │   └── admin/             # Área administrativa
│   ├── css/                   # Estilos CSS
│   └── js/                    # JavaScript
├── public/                    # Arquivos públicos
└── routes/                    # Definição de rotas
```

### Banco de Dados

O projeto utiliza as seguintes tabelas:

#### Tabela `projects`
- `id`: ID único do projeto
- `title`: Título do projeto
- `slug`: URL amigável
- `short_description`: Descrição curta
- `description`: Descrição completa
- `image`: Imagem principal
- `gallery`: Galeria de imagens (JSON)
- `technologies`: Tecnologias utilizadas (JSON)
- `project_url`: URL do projeto
- `github_url`: URL do repositório GitHub
- `demo_url`: URL de demonstração
- `status`: Status (planned, in_progress, completed, cancelled)
- `featured`: Projeto em destaque
- `active`: Projeto ativo
- `order`: Ordem de exibição
- `completion_date`: Data de conclusão

#### Tabela `blog_posts`
- `id`: ID único do post
- `title`: Título do post
- `slug`: URL amigável
- `excerpt`: Resumo
- `content`: Conteúdo completo
- `featured_image`: Imagem destacada
- `status`: Status (draft, published)
- `featured`: Post em destaque
- `published_at`: Data de publicação
- `tags`: Tags (JSON)
- `meta_description`: Meta descrição para SEO

#### Tabela `contact_messages`
- `id`: ID único da mensagem
- `name`: Nome do contato
- `email`: E-mail
- `phone`: Telefone
- `company`: Empresa
- `subject`: Assunto
- `message`: Mensagem
- `project_type`: Tipo de projeto
- `budget_range`: Faixa de orçamento
- `timeline`: Prazo desejado
- `status`: Status (new, read, replied, archived)
- `read_at`: Data de leitura
- `admin_notes`: Notas administrativas
- `ip_address`: IP do remetente
- `user_agent`: User agent

## Área Administrativa

### Acesso
- URL: `/admin/dashboard`
- Requer autenticação

### Funcionalidades

#### Dashboard
- Estatísticas gerais (projetos, posts, mensagens)
- Gráficos mensais
- Atividades recentes
- Ações rápidas

#### Gerenciamento de Projetos
- **Listar:** `/admin/projects`
- **Criar:** `/admin/projects/create`
- **Editar:** `/admin/projects/{id}/edit`
- **Visualizar:** `/admin/projects/{id}`
- **Excluir:** Botão na listagem

**Campos do formulário:**
- Título
- Descrição curta e completa
- Imagem principal
- Galeria de imagens
- Tecnologias (separadas por vírgula)
- URLs (projeto, GitHub, demo)
- Status e configurações

#### Gerenciamento do Blog
- **Listar:** `/admin/blog`
- **Criar:** `/admin/blog/create`
- **Editar:** `/admin/blog/{id}/edit`
- **Visualizar:** `/admin/blog/{id}`
- **Excluir:** Botão na listagem

**Campos do formulário:**
- Título
- Resumo e conteúdo
- Imagem destacada
- Status (rascunho/publicado)
- Tags
- Meta descrição

#### Gerenciamento de Mensagens
- **Listar:** `/admin/messages`
- **Visualizar:** `/admin/messages/{id}`
- **Marcar como lida**
- **Marcar como respondida**
- **Excluir**

### Criando um Usuário Administrador

Para criar um usuário administrador, execute:

```bash
php artisan tinker
```

Dentro do Tinker:

```php
User::create([
    'name' => 'Seu Nome',
    'email' => 'seu-email@exemplo.com',
    'password' => Hash::make('sua-senha-segura')
]);
```

## Personalização

### Cores e Design
As cores principais podem ser alteradas no arquivo `resources/css/app.css`:

```css
:root {
    --primary-color: #3b82f6;    /* Azul principal */
    --secondary-color: #8b5cf6;  /* Roxo secundário */
    --accent-color: #f59e0b;     /* Amarelo de destaque */
    --text-color: #1f2937;       /* Cor do texto */
    --bg-color: #f9fafb;         /* Cor de fundo */
}
```

### Informações Pessoais
Edite os seguintes arquivos para personalizar as informações:

- `resources/views/layouts/app.blade.php`: Informações gerais
- `resources/views/home/index.blade.php`: Página inicial
- `resources/views/contact/index.blade.php`: Informações de contato

### Integrações Sociais
Configure os links das redes sociais em:
- `resources/views/layouts/app.blade.php` (rodapé)
- `resources/views/contact/index.blade.php` (seção de contato)

## Configurações de E-mail

Para que o formulário de contato funcione, configure o e-mail no arquivo `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu-email@gmail.com
MAIL_FROM_NAME="Seu Nome"
```

## SEO e Performance

### Meta Tags
As meta tags são configuradas automaticamente em cada página. Para personalizar:

- Edite o arquivo `resources/views/layouts/app.blade.php`
- Adicione meta descriptions específicas em cada view

### Sitemap
Para gerar um sitemap, você pode usar pacotes como `spatie/laravel-sitemap`:

```bash
composer require spatie/laravel-sitemap
```

### Cache
Para melhor performance em produção:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Backup e Manutenção

### Backup do Banco de Dados
```bash
# MySQL
mysqldump -u usuario -p nome_do_banco > backup.sql

# SQLite
cp database/database.sqlite backup_database.sqlite
```

### Logs
Os logs da aplicação ficam em `storage/logs/laravel.log`.

### Atualizações
Para atualizar o projeto:

1. Faça backup do banco de dados
2. Execute `git pull` para puxar as atualizações
3. Execute `composer install` e `npm install`
4. Execute `php artisan migrate` se houver novas migrations
5. Execute `npm run build` para recompilar os assets

## Solução de Problemas

### Erro 500
- Verifique os logs em `storage/logs/`
- Certifique-se de que as permissões estão corretas
- Verifique se o arquivo `.env` está configurado

### Imagens não aparecem
- Execute `php artisan storage:link`
- Verifique as permissões da pasta `storage`

### Formulário de contato não funciona
- Verifique as configurações de e-mail no `.env`
- Teste com `php artisan tinker` e `Mail::raw('teste', function($m) { $m->to('email@teste.com'); })`

## Suporte

Para suporte técnico ou dúvidas sobre o projeto, entre em contato através dos canais disponíveis na seção de contato do site.

