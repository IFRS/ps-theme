# IFRS PS Theme

Tema WordPress moderno para os Processos Seletivos do IFRS com componentes Vue 3, Bootstrap 5 e Vite como build tool. Suporta custom post types (cursos, chamadas, eventos, publicações) e taxonomies (campus, forma de ingresso, trilhas).

## Tech Stack

- **Linguagens:** PHP 8.x, JavaScript ES2020+, HTML5, SCSS
- **Frameworks:** WordPress 7.1+, Vue 3, Bootstrap 5
- **Ferramentas:** Vite, ESLint, StyleLint, Node.js 18+
- **Dependências principais:** vite, vue@3, bootstrap@5, axios, sass-embedded, dayjs, masonry-layout, list.js

## Directory Structure

```
theme/              - Templates PHP (templates do tema, partials, blocks)
src/                - Código-fonte JavaScript e Vue (componentes, módulos, scripts)
sass/               - Estilos SCSS (base, components, blocks, layout, config)
build/              - Saída compilada (gerada por Vite, não commitada)
public/             - Assets estáticos (imagens, ícones)
theme/inc/          - Funções PHP (configurações, post-types, taxonomies, menus)
eslint.config.mjs   - Configuração ESLint (es2020, globals browser)
vite.config.mjs     - Configuração Vite (build para theme/assets, watch theme/)
```

## Setup & Development

```bash
# Instalar dependências
npm install

# Modo desenvolvimento com watch automático
npm run dev

# Build para produção (minificado, sourcemap desabilitado)
npm run build

# Lint JavaScript
npm run lint:js

# Lint SCSS
npm run lint:css

# Lint tudo
npm run lint

# Corrigir style automaticamente
npm run lint:fix
```

## Code Style & Conventions

- **Indentação:** 2 espaços (JS/SCSS), PSR-12 (PHP)
- **Naming:** kebab-case arquivos/componentes Vue, camelCase variáveis JS, snake_case funções PHP
- **JavaScript:** ES2020 target, ESLint recomendado, ignore underscore params
- **SCSS:** Bootstrap 5 variables, evite hardcoding cores/espacos
- **PHP:** WordPress coding standards, usar hooks/actions, sanitizar inputs
- **Vue:** Single-File Components (.vue), Composition API preferido
- **Assets:** Vite gera hash de contenthash, use `wp_enqueue_script()` com dependências corretas

## Architecture Notes

- **Tema Block-based:** WordPress Full Site Editing (theme.json v3) com configuração Bootstrap integrada
- **Separação:** theme/ (views PHP) + src/ (lógica JS/Vue) + sass/ (estilos) + theme/inc/ (controllers)
- **Custom Post Types:** curso, publicação, chamada, evento, pergunta (em theme/inc/post-types/)
- **Enqueuing:** Assets enfileirados em theme/inc/assets.php com dependências, versioning e conditionals

## Common Tasks

```bash
# Criar novo bloco Gutenberg
# 1. Adicionar em theme/inc/blocks/
# 2. Registrar em theme/inc/theme-config.php
# 3. Compilar com Vite

# Adicionar novo custom post type
# 1. Criar arquivo em theme/inc/post-types/novo.php
# 2. Importar em theme/functions.php
# 3. Adicionar templates correspondentes em theme/

# Adicionar novo componente Vue
# 1. Criar em src/modules/NomeComponente.vue
# 2. Importar e registrar em src/ps.js
# 3. Usar em templates PHP via data-app="nome"
```

## Git Workflow

- **Branch naming:** `feature/nome`, `fix/nome`, `chore/nome`, `docs/nome`
- **Commits:** Conventional Commits (feat:, fix:, chore:, refactor:, style:, docs:)
- **Build:** Jamais commitar `/build/`, use `.gitignore` para `/node_modules/` e arquivos sensíveis

## Security Considerations

- **Nunca commitar:** `.env`, `/secrets`, credenciais WordPress, chaves API
- **Sanitização:** Sempre escapar output PHP com `esc_html()`, `esc_url()`, `wp_kses_post()`
- **Nonces:** Usar nonces WordPress para formulários (quando aplicável)
- **Validação:** Validar POST/GET data do lado do servidor, não confiar em dados do frontend

## Anti-Patterns

- Não importar tudo do Bootstrap em SCSS (causa bloat), customize variables
- Não hardcod URLs, usar `home_url()`, `get_template_directory_uri()`
- Não acumular componentes Vue sem splitting de código
- Não fazer lógica complexa em templates PHP, mover para theme/inc/
- Não ignorar erros ESLint/StyleLint, corrigir ou documentar exceções

## Links & Documentation

- [README.md](./README.md) - Visão geral e dependências externas
- [theme/theme.json](./theme/theme.json) - Configuração Full Site Editing
- [theme/functions.php](./theme/functions.php) - Ponto de entrada do tema
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Vue 3 Documentation](https://vuejs.org/)
- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.1/)
