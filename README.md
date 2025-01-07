# 🛠️📋 Gerenciador de Projetos Complementar ao Redmine

## 📝 Descrição do Projeto

Este projeto, denominado **AgilMine**, foi desenvolvido como parte do Trabalho de Conclusão de Curso do 🏫 Instituto Federal Catarinense. Ele tem como objetivo criar um sistema complementar ao 🛠️ Redmine, oferecendo suporte a metodologias ágeis, especialmente para atender às necessidades da 🧪 FabTec, laboratório voltado para desenvolvimento de soluções em 💻 software e 🖥️ hardware.

A proposta visa superar as limitações do 🛠️ Redmine, como a ausência de suporte nativo para metodologias ágeis, integrando funcionalidades como gestão de 🏃 sprints, gráficos de 📉 burndown, relatórios detalhados e outros recursos indispensáveis ao gerenciamento ágil de projetos.

## 🎯 Objetivos do Projeto

- **Objetivo Geral:**
  Desenvolver uma aplicação 🌐 web para complementar o 🛠️ Redmine, oferecendo suporte às práticas ágeis.

- **🎯 Objetivos Específicos:**

  1️⃣ Analisar e compreender os métodos ágeis 📜 SCRUM e Extreme Programming;
  2️⃣ Mapear o processo atual de desenvolvimento de projetos na 🧪 FabTec;
  3️⃣ Identificar e definir histórias de usuário para guiar o desenvolvimento;
  4️⃣ Projetar, desenvolver e implementar a aplicação em cenários reais;
  5️⃣ Avaliar a eficácia da solução proposta.

## 🚀 Principais Funcionalidades

- **Integração com Redmine:**
  - Consumo da 🌐 API para gerenciar 📂 projetos, 📝 tarefas e 👥 usuários.
- **Gestão Ágil:**
  - Organização de 📝 tarefas em 🏃 sprints.
  - Geração de gráficos de 📉 burndown e 📈 burnup.
  - Gerenciamento de 🏷️ releases e 🗂️ backlog.
- **Relatórios e Indicadores:**
  - Estatísticas gerais e 📊 métricas de desempenho.
  - Relatórios imprimíveis com gráficos detalhados.
- **Usabilidade e Gestão de Usuários:**
  - Criação, habilitação e desabilitação de 👤 contas.
  - Configurações avançadas para 👩‍💻 administradores.

## 🛠️ Tecnologias Utilizadas

- **Backend:** Laravel 🐘
- **Frontend:** Blade templates e Bootstrap 🖌️
- **Banco de Dados:** MySQL 🗄️
- **Integração:** Redmine API 🔗
- **Controle de Versão:** Git 🌳

## ⚙️ Configuração e Instalação

1️⃣ Clone o repositório:
   ```bash
   git clone <url-do-repositorio>
   ```

2️⃣ Instale as dependências:
   ```bash
   composer install
   npm install
   ```

3️⃣ Configure o arquivo `.env` com os dados do banco e a URL da API do 🛠️ Redmine.

4️⃣ Execute as migrações e seeders:
   ```bash
   php artisan migrate --seed
   ```

5️⃣ Inicie o servidor de desenvolvimento:
   ```bash
   php artisan serve
   ```

6️⃣ **Credenciais do Administrador do Redmine:**
   - Após a configuração, o sistema Redmine estará disponível com um usuário administrador padrão:
     - **Usuário:** `admin`
     - **Senha:** `12345678`

## ✅ Testes

Para garantir a qualidade do sistema, foram definidos critérios de aceitação com base nas histórias de usuário. Para executar os testes automatizados, utilize o comando:

```bash
php artisan test
```

## 📜 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

## 🙏 Agradecimentos

Este projeto foi realizado com o apoio do 🏫 Instituto Federal Catarinense e do laboratório 🧪 FabTec, que proporcionaram o ambiente e os recursos necessários para sua execução.

## 📧 Contato

Para dúvidas ou sugestões, entre em contato pelo email: henrique.10agr\@gmail.com.
