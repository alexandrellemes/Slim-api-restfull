# Slim Micro Framework Case
Exemplo de uso do micro framework Slim para de desenvolvimento de API's. Tal exemplo faz uso da classe PDO para conexões com o banco de dados.

###### Como testar?
Os testes podem ser feitos com uso do **Postman** ou qualquer *REST client* conhecido no mercado.

###### Sobre o banco de dados usado
Para aproveitar ao máximo o repositório no quesito das statements desenvolvidas no arquivo ***"Pessoa.php"*** basta executar em seu *mysql client* a query abaixo:

```sql
CREATE DATABASE api;

USER api;

CREATE TABLE pessoa (
  pessoa_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome  VARCHAR(40),
  email VARCHAR(50),
  data_de_cadastro  DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO pessoa (nome, email) VALUES ('Pessoa teste', 'teste@gmail.com');
