# Projeto - Atualiza Membros

## Sobre
Este repositório contém arquivos para um sistema de atualização cadastral de membros de uma igreja.

## Estrutura do Projeto
```
diretório-raiz/
├── app/
│   ├── public/
│   │   ├── index.php
│   │   ├── api/
│   │   │   └── membro.php
│   │   └── assets/
│   │       ├── css/
│   │       │   └── appStyle.css
│   │       ├── js/
│   │       │   ├── app.js
│   │       │   ├── mask.js
│   │       │   └── toggleField.js
│   │       └── img/
|   |
│   ├── src/
│   |    ├── App.php
│   |    ├── Bootstrap.php
│   |    └── Database.php
│   |
|   ├── database/
│   |   └── schema.sql => Modelo da database a ser importada na aplicação
|   |
|   ├── docker/
│   |   ├── .env.example
│   |   ├── atualiza_membros.dockerfile
│   |    └── dc-atualiza_membros.yaml
|   |
|   ├── README.md
|   └── .gitignore
|
└── database/ => Arquivos do container de banco de dados
```

## Criação do Ambiente

1. **Crie os diretórios necessários**  
   Antes de tudo, crie os diretórios `app` e `database` dentro do seu diretório-raiz:

   ```sh
   mkdir -p diretório-raiz/app
   mkdir -p diretório-raiz/database
   ```

   ```
   diretório-raiz/
   ├── app/
   ├── database/
   ```

2. **Clone o repositório**  
   Clone o projeto dentro do diretório `app`:

   ```sh
   cd diretório-raiz/
   git clone https://github.com/mafpbiaggi/atualiza-membros.git app
   ```

3. **Configuração do arquivo `.env`**  
   O arquivo de variáveis de ambiente de exemplo está em `docker/.env.example`.  
   Copie ou renomeie este arquivo para `docker/.env`:

   ```sh
   cd app/docker
   cp .env.example .env
   ```

   > **Importante:**  
   > O arquivo `.env` deve permanecer no diretório `docker/`.  
   > As informações já preenchidas neste arquivo **não devem ser alteradas** caso o arquivo `docker/dc-atualiza_membros.yaml` não seja modificado.

4. **Inicie os containers com Docker Compose**  
   No diretório `docker/`, execute:

   ```sh
   docker compose -f dc-atualiza_membros.yaml up -d --build
   ```

   Isso irá criar e iniciar os containers do banco de dados e da aplicação, mapeando os diretórios conforme especificado.

5. **Popule a base de dados em produção**  
   Após os containers estarem em execução, execute os comandos abaixo para importar o schema do banco de dados:

   ```sh
   docker cp app/database/schema.sql db_atualiza_membros:/var/lib/mysql
   docker exec -i db_atualiza_membros bash -c 'mariadb -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE < /var/lib/mysql/schema.sql'
   ```

   Isso irá copiar o arquivo `schema.sql` para dentro do container do banco de dados e executar o script de criação/importação das tabelas.

### Observações
- O banco de dados será armazenado em `diretório-raiz/database` para que os dados sejam mantidos caso o container seja recriado.
- O código-fonte da aplicação deve estar em `diretório-raiz/app`.
- O arquivo `docker/dc-atualiza_membros.yaml` define os serviços, volumes e variáveis de ambiente utilizadas.
- Para acessar a aplicação, utilize a porta definida em `PORT_MAPPING` no arquivo `.env`.

## Dados da Equipe
**Nome**: Marco Aurélio Biaggi ([@mafpbiaggi](https://github.com/mafpbiaggi))  
**E-mail**: mafpbiaggi@gmail.com | ti.ipvilaprudente@gmail.com
