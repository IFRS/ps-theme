# IFRS PS Theme

Tema moderno para [WordPress](https://wordpress.org/) dos [Processos Seletivos](http://ingresso.ifrs.edu.br/) do [Instituto Federal do Rio Grande do Sul (IFRS)](http://ifrs.edu.br/).

Construído com **Vue 3**, **Bootstrap 5**, **SCSS** e **Vite** para desenvolvimento rápido e produção otimizada.

## Sumário

- [Visão Geral](#visão-geral)
- [Pré-requisitos](#pré-requisitos)
- [Instalação](#instalação)
- [Desenvolvimento](#desenvolvimento)
- [Build & Produção](#build--produção)
- [Linting](#linting)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Plugins Necessários](#plugins-necessários)
- [Configuração do WordPress](#configuração-do-wordpress)
- [Licença](#licença)

## Visão Geral

Este é um tema WordPress full-site-editing moderno com suporte para:

- **Custom Post Types**: Cursos, Chamadas, Eventos, Publicações, Perguntas
- **Custom Taxonomies**: Campus, Forma de Ingresso, Trilhas
- **Componentes Vue 3**: Integração completa de componentes interativos
- **Vite Build Tool**: Compilação rápida e sourcemaps em desenvolvimento
- **Padrões Modernos**: ESLint, StyleLint, SCSS e Bootstrap 5

## Pré-requisitos

- **Node.js** 18+ com **NPM**
- **WordPress** 7.1+
- **PHP** 8.x

## Instalação

Clone o repositório e instale as dependências:

```bash
npm install
```

## Desenvolvimento

Para iniciar o modo desenvolvimento com watch automático:

```bash
npm run dev
```

Ou, alternativamente:

```bash
npm start
```

O Vite observará mudanças em `src/`, `sass/` e `theme/` e compilará automaticamente os arquivos na pasta `build/`.

## Build & Produção

Para gerar a build otimizada para produção (minificada, sem sourcemaps):

```bash
npm run build
```

Os arquivos compilados serão salvos em `build/` e estarão prontos para deploy.

## Linting

Verificar qualidade do código JavaScript:

```bash
npm run lint:js
```

Verificar estilos SCSS:

```bash
npm run lint:css
```

Executar ambos os linters:

```bash
npm run lint
```

Corrigir problemas automaticamente:

```bash
npm run lint:fix
```

## Estrutura do Projeto

```
theme/                    # Templates PHP e configurações do tema
├── inc/                  # Funções PHP (post-types, taxonomies, assets)
├── partials/            # Partials PHP reutilizáveis
├── parts/               # Blocos/partes do tema
└── theme.json           # Configuração Full Site Editing

src/                      # Código-fonte JavaScript/Vue
├── modules/             # Componentes Vue 3
└── blocks/              # Blocos Gutenberg customizados

sass/                     # Estilos SCSS
├── base/                # Base e reset
├── components/          # Componentes SCSS
├── blocks/              # Estilos de blocos
├── layout/              # Layout e grid
└── config/              # Configurações e variáveis

build/                    # Saída compilada (gerada, não commitada)
├── assets/              # JavaScript e CSS compilados
└── [arquivos PHP]       # Templates compilados
```

## Plugins Necessários

### Obrigatório
- **[CMB2](https://br.wordpress.org/plugins/cmb2/)** - Metaboxes e custom fields

### Recomendado
- **[Disable Comments](https://br.wordpress.org/plugins/disable-comments/)** - Desabilita comentários globalmente (tema não suporta comentários)
- **[Members](https://br.wordpress.org/plugins/members/)** - Gerenciamento avançado de funções e permissões

## Configuração do WordPress

Recomenda-se configurar a opção de **permalinks** como:

**Configurações → Links permanentes → Nome do post**

Isso garante URLs amigáveis e consistentes com a estrutura do tema.

## Convenções de Código

- **Indentação**: 2 espaços (JS/SCSS), PSR-12 (PHP)
- **JavaScript**: ES2020, ESLint configurado
- **SCSS**: Bootstrap 5 variables, variáveis customizadas
- **Vue**: Single-File Components, Composition API preferido
- **PHP**: WordPress coding standards

## Licença

Este código é distribuído sob a licença [GNU GPL 3.0](https://www.gnu.org/licenses/gpl-3.0.txt).

A documentação, imagens e demais mídias são distribuídas sob a licença [Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International](https://creativecommons.org/licenses/by-nc-sa/4.0/).
