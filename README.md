# Agilmine

**Agilmine** é uma extensão para o Redmine projetada para aprimorar o suporte a metodologias ágeis no gerenciamento de projetos. O sistema otimiza a organização de *sprints*, *releases*, reuniões e métricas, suprindo as lacunas do Redmine para times que utilizam metodologias ágeis.

## ⚙️ Configuração e Instalação

Siga os passos abaixo para instalar e configurar o Agilmine no seu ambiente de desenvolvimento:

1️⃣ **Clone o repositório**:

```bash
git clone <url-do-repositorio>
```

2️⃣ **Instale as dependências do Composer**:

```bash
composer install
```

3️⃣ **Crie o arquivo `.env`**:

```bash
cp .env.example .env
```

4️⃣ **Gere a chave da aplicação**:

```bash
php artisan key:generate
```

5️⃣ **Inicie os contêineres do Laravel Sail**:

```bash
./vendor/bin/sail up -d
```

6️⃣ **Execute as migrações e seeders**:

```bash
./vendor/bin/sail artisan migrate:refresh --seed
```

7️⃣ **Acesse o sistema**:

- **Agilmine:** [http://localhost:8080](http://localhost:8080)  
  - Usuário administrador: `admin@email.com`  
  - Senha: `1a2s3d4f`  

- **Redmine:** [http://localhost:9934](http://localhost:9934)  
  - Usuário administrador: `admin`  
  - Senha: `1a2s3d4f`  

---

## 🛠️ Tecnologias Utilizadas

O **Agilmine** foi desenvolvido utilizando:

- **PHP 8.3** e **Laravel 10** como *backend*
- **MySQL 8.0** para armazenamento de dados
- **Bootstrap 5** e **Laravel Livewire 3** para a interface dinâmica
- **Laravel Sail** para ambiente de desenvolvimento com Docker
- **Redmine API** para integração e gerenciamento de projetos

## 📜 Licença

Este projeto está licenciado sob a **MIT License**.

## 🙏 Agradecimentos

Este projeto foi realizado com o apoio do **🏫 Instituto Federal Catarinense** e do laboratório **🧪 FabTec**, que proporcionaram o ambiente e os recursos necessários para sua execução.

## 📧 Contato

Para dúvidas ou sugestões, entre em contato pelo email: **henrique.10agr@gmail.com**.