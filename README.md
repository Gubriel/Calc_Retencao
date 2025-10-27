## 🧩 Calculadora de Retenção — Guia de Instalação e Configuração

Este projeto é uma aplicação desenvolvida em Laravel para consulta e gerenciamento de informações financeiras de clientes, integrando-se a endpoints externos para exibir dados como numero de faturas não pagas, listar contratos do clinte e realizar calculos para decidir se é vantajoso oferecer opções de retençaõ paar os clientes.O projeto pode ser instalado em qualquer ambiente que suporte PHP e Composer.
Abaixo estão as instruções completas para configurar o ambiente e executar o projeto localmente.


## 🚀 Pré-requisitos

Antes de começar, verifique se possui as seguintes ferramentas instaladas:

- `PHP >= 8.1`
- Composer 2.8.12
- NPM 10.9.3
- Git
- Um servidor local como Laravel Sail, XAMPP, Laragon ou Docker

## 📦 Instalação

1. Clone o repositório
```bash
git clone https://github.com/Gubriel/Calc_Retencao.git
cd Calc_Retencao
```

2. Instale as dependências do PHP
```bash
composer install
```

3. Instale as dependências do front-end
```bash
npm install
```

4. Crie o arquivo de ambiente
```bash
cp .env.example .env
```

5. Gere a chave da aplicação
```bash
php artisan key:generate
```

6. Execute as migrações
```bash
php artisan migrate
```

## 🔒 Configurando credenciais da API do IXC

- No arquivo .env adicione as vareaveis:
```bash
IXC_API_URL="https://ixc.ampernet.com.br/webservice/v1"
IXC_API_AUTH="sua:credencial"
```

## 💻 Executando o servidor

1. Inicie o servidor de desenvolvimento com:
```bash
php artisan serve
```

2. E inicie o suporte a CSS com vite:
```bash
npm run dev
```

3. Acesse `http://127.0.0.1:8000/` no seu navegador

***

📅 Ano: 2025 \
📖 Framework: [Laravel](https://laravel.com/ "Laravel Homepage") \
📃 Licença MIT
