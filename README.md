# Teste Comerc
---

Para o desenvolvimento desse teste foi utilizado o framework `Laravel` em sua versão 11 e o projeto inteiro foi desenvolvido sobre o `Docker`.

### Executar o Projeto
---

Para executar o projeto, basta executar o comando `sh config.sh`, pois ele já tem todos os passos necessários para colocar a aplicação de pé, incluindo massa de dados para teste.

### Acesso a API
---

Na raiz do projeto há um arquivo `Comerc.postman_collection.json` que contém todos os endpoints que a `API` possui.

### Testes
---

Para executar a bateria de testes que vem com o coverage, basta executar `sh coverage.sh` e será gerado arquivos dentro de `coverage`, há um arquivo `index.html` dentro dessa pasta, basta o abrir em qualquer navegador e haverá o coverage do projeto.
