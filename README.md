
# Code Challenge: Ganho de Capital

## Contexto

O objetivo deste exercício é implementar um programa de linha de comando (CLI) que calcula o imposto a
ser pago sobre lucros ou prejuízos de operações no mercado financeiro de ações.

## Exemplo de uso do Ganho de Capital

### Como o programa funciona?

#### Entrada

O programa recebe listas, uma por linha, de operações do mercado financeiro de ações em formato json  através da entrada padrão ( stdin ). Cada operação desta lista contém os seguintes campos:

| Nome | Significado |
| --- | --- |
| operation | List all new or modified files |
| unit-cost | Preço unitário da ação em uma moeda com duas casas decimais |
| quantity | Quantidade de ações negociadas |

Este é um exemplo de entrada:

```
[{"operation":"buy", "unit-cost":10.00, "quantity": 10000},{"operation":"sell", "unit-cost":20.00, "quantity": 5000}] 
[{"operation":"buy", "unit-cost":20.00, "quantity": 10000},{"operation":"sell", "unit-cost":10.00, "quantity": 5000}]
```

#### Saída

Para cada linha da entrada, o programa retorna uma lista contendo o imposto pago para cada operação recebida. Os elementos desta lista são codificados em formato  json  e a saída  é retornada através da saída padrão ( stdout ). O retorno é composto pelo seguinte campo:

| Nome | Significado |
| --- | --- |
| tax | O valor do imposto pago em uma operação |

Este é um exemplo de saída:

```
[{"tax":0}, {"tax":10000}] 
[{"tax":0}, {"tax":0}]
```

## Tecnologias

O projeto foi desenvolvido utilizando php 7.4.

Siga as instruções abaixo para conseguir executar a aplicação.

## Configurar Ambiente Docker

Na raíz do projeto, execute os comandos

```
  docker build -t app .
  docker run -it app
```

Acesse o terminal do container e execute a aplicação.

## Executar Aplicação
Na raíz do projeto, execute o comando

```
  php app/src/index.php
```

## Executar Testes Unitários

Na raíz do projeto, execute o comando

```
  php app/tests/testCalculadorImpostos.php
```

Caso queira alterar as entradas utilizadas no teste, atualize os arquivos "entrada.txt" e "saida.txt" no diretório "app/tests".

## Considerações Finais

### Estrutura de classes

As classes foram organizadas de modo que seja possível separar funcionalidades lógicas e gerenciais. 

### Estrutura de testes

Entendo que a estrutura de testes não é muito robusta, mas isso foi feito propositalmente.

Poderia ser utilizado algum framework de teste, mas isso não foi feito por conta do tamanho da estrutura do projeto, que não justifica importar uma ferramenta de grande porte para utilizar uma fatia pequena.


Caso o projeto cresça, não será problemático adicionar um framework de testes.

Por fim, eu implementei um modelo de teste enxuto, que atende muito bem o estado atual do projeto, onde é possivel:

- Testar todos os exemplos recebidos nas instruções;
- Customizar objetos de teste;

Entendo que centralizar o teste numa única função pode não ser bem visto em alguns contextos, mas nesse caso, é a unica coisa acessível para ser feito teste... Caso seja interessante "aprofundar" mais os testes, é possível focar nas funções "core", porém no momento, isso não se faz necessário.

O objetivo da implementação é atender o projeto na estrutura atual, permitindo utilizar todos os recursos disponíveis e aprofundar mais, caso seja interessante em algum momento.

### Comentários no código

Estou ciente sobre o excesso de comentários utilizado, isso foi feito pensando que não estarei presente quando o avaliador estiver analisando o código, então descrevi cada passo dado ao longo do desenvolvimento. 

Entendo esse excesso possa prejudicar a experiência, mas acredito que em algum momento da análise isso irá contribuir positivamente.