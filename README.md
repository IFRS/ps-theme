# IFRS PS Theme

Tema [Wordpress](https://wordpress.org/) para os [Processos Seletivos](http://ingresso.ifrs.edu.br/) do [Instituto Federal do Rio Grande do Sul](http://ifrs.edu.br/).

## Dependências

Esse tema depende obrigatoriamente do plugin [CMB2](https://br.wordpress.org/plugins/cmb2/). Além desse, recomenda-se o uso dos plugins abaixo:

- [Disable Comments](https://br.wordpress.org/plugins/disable-comments/): Plugin que desabilita a funcionalidade de comentários globalmente, já que este tema não suporta comentários.
- [Members](https://br.wordpress.org/plugins/members/): Plugin para gerenciamento de funções dos usuários. Permite escolher mais de uma função para um único usuário.

## Utilização

Para a construção desse projeto são necessárias as seguintes ferramentas:
- [NodeJs](https://nodejs.org/) com [NPM](https://www.npmjs.com/)
- [Gulp CLI](https://gulpjs.com/)

Primeiramente é preciso instalar as dependências:

```
$ npm install
```

Em seguida, para compilar/construir o tema no ambiente de desenvolvimento:

```
$ gulp build
```

*Dessa forma, os arquivos compilados ficam na pasta raiz.*

Para produção:

```
$ gulp build --production
```

*Nesse caso, será criada a pasta `dist/ifrs-ps-theme` com o tema completo e pronto para ser utilizado em produção.*

## Configuração do Wordpress

Recomenda-se utilizar a opção "Nome do post" em "Configurações -> Links permanentes".

## Licença

Esse código é distribuído sob a licença [GNU GPL 3.0](https://www.gnu.org/licenses/gpl-3.0.txt).

A documentação, as imagens e demais mídias são distribuídas sob a licença [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International](https://creativecommons.org/licenses/by-nc-sa/4.0/).
