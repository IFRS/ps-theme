( function( wp ) {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const useBlockProps = (wp.blockEditor && wp.blockEditor.useBlockProps)
    ? wp.blockEditor.useBlockProps
    : () => ({ });
  const { InspectorControls } = wp.blockEditor || wp.editor;
  const { InnerBlocks, RichText } = wp.blockEditor || wp.editor;
  const { PanelBody, SelectControl, TextControl, Button } = wp.components;
  const createElement = wp.element.createElement;

  const STEPS = [
    { text: __('Escolha um Campus e Curso', 'ifrs-ps-theme'), link_text: 'Lista de Cursos' },
    { text: __('Leia atentamente o Edital e faça sua Inscrição', 'ifrs-ps-theme'), link_text: 'Editais' },
    { text: __('Realize a Prova ou acompanhe o Sorteio', 'ifrs-ps-theme'), link_text: null },
    { text: __('Acompanhe os Resultados', 'ifrs-ps-theme'), link_text: 'Resultados' },
    { text: __('Faça sua Pré-matrícula', 'ifrs-ps-theme'), link_text: null },
  ];

  const getModalidadeOptions = () => {
    const terms = Array.isArray(window.ifrsPsModalidadesTerms)
      ? window.ifrsPsModalidadesTerms
      : [];

    return [
      { label: __('Selecione uma modalidade', 'ifrs-ps-theme'), value: '' },
      ...terms.map((term) => ({
        label: term.name,
        value: term.slug,
      })),
    ];
  };
  const renderSvg = (children) => createElement(
    'svg',
    {
      viewBox: '0 0 24 24',
      fill: 'none',
      stroke: 'currentColor',
      'stroke-width': '1',
      'stroke-linecap': 'round',
      'stroke-linejoin': 'round',
      focusable: 'false',
      'aria-hidden': 'true',
    },
    ...children
  );

  const renderStepIcon = (stepIndex) => {
    switch (stepIndex) {
      case 0:
        return renderSvg([
          createElement('path', { d: 'M8 19h-3a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v11a1 1 0 0 1 -1 1', key: 'p1' }),
          createElement('path', { d: 'M11 16m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z', key: 'p2' }),
        ]);
      case 1:
        return renderSvg([
          createElement('path', { d: 'M14 3v4a1 1 0 0 0 1 1h4', key: 'p1' }),
          createElement('path', { d: 'M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z', key: 'p2' }),
          createElement('path', { d: 'M9 9l1 0', key: 'p3' }),
          createElement('path', { d: 'M9 13l6 0', key: 'p4' }),
          createElement('path', { d: 'M9 17l6 0', key: 'p5' }),
        ]);
      case 2:
        return renderSvg([
          createElement('path', { d: 'M14 3v4a1 1 0 0 0 1 1h4', key: 'p1' }),
          createElement('path', { d: 'M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z', key: 'p2' }),
          createElement('path', { d: 'M10 18l5 -5a1.414 1.414 0 0 0 -2 -2l-5 5v2h2z', key: 'p3' }),
        ]);
      case 3:
        return renderSvg([
          createElement('path', { d: 'M4 4m0 1a1 1 0 0 1 1 -1h14a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-14a1 1 0 0 1 -1 -1z', key: 'p1' }),
          createElement('path', { d: 'M4 8h16', key: 'p2' }),
          createElement('path', { d: 'M8 4v4', key: 'p3' }),
          createElement('path', { d: 'M9.5 14.5l1.5 1.5l3 -3', key: 'p4' }),
        ]);
      case 4:
        return renderSvg([
          createElement('path', { d: 'M14 20h-8a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12v5', key: 'p1' }),
          createElement('path', { d: 'M11 16h-5a2 2 0 0 0 -2 2', key: 'p2' }),
          createElement('path', { d: 'M15 16l3 -3l3 3', key: 'p3' }),
          createElement('path', { d: 'M18 13v9', key: 'p4' }),
        ]);
    }
  };

  registerBlockType('ifrs-ps/intro-helper', {
    apiVersion: 2,
    title: __('Ajudante de Introdução ao Processo Seletivo', 'ifrs-ps-theme'),
    description: __('Cria frases linkadas de envio para a listagem de cursos com a modalidade escolhida.', 'ifrs-ps-theme'),
    icon: 'forms',
    category: 'widgets',
    attributes: {
      title: {
        type: 'string',
        default: '',
      },
      linksTitle: {
        type: 'string',
        default: '',
      },
      items: {
        type: 'array',
        default: [],
      },
    },

    edit: ( props ) => {
      const { attributes, setAttributes } = props;
      const items = Array.isArray(attributes.items) ? attributes.items : [];
      const title = attributes.title || '';
      const linksTitle = attributes.linksTitle || '';
      const options = getModalidadeOptions();
      const blockProps = useBlockProps();

      const updateItem = (index, field, value) => {
        const nextItems = items.map((item, itemIndex) => {
          if (itemIndex !== index) {
            return item;
          }

          return {
            ...item,
            [field]: value,
          };
        });

        setAttributes({ items: nextItems });
      };

      const addItem = () => {
        setAttributes({
          items: [
            ...items,
            {
              modalidade: '',
              frase: '',
            },
          ],
        });
      };

      const removeItem = (index) => {
        setAttributes({
          items: items.filter((item, itemIndex) => itemIndex !== index),
        });
      };

      return createElement('div', blockProps,
        createElement(InspectorControls, null,
          createElement(PanelBody, {
            title: __('Configuração dos links', 'ifrs-ps-theme'),
            initialOpen: true,
          },
          items.map((item, index) => createElement('div', {
            key: `item-${index}`,
          },
          createElement(SelectControl, {
            label: __('Modalidade', 'ifrs-ps-theme'),
            value: item.modalidade || '',
            options,
            onChange: (value) => updateItem(index, 'modalidade', value),
          }),
          createElement(TextControl, {
            label: __('Frase do link', 'ifrs-ps-theme'),
            value: item.frase || '',
            onChange: (value) => updateItem(index, 'frase', value),
          }),
          createElement(Button, {
            variant: 'secondary',
            isDestructive: true,
            onClick: () => removeItem(index),
          }, __('Remover link', 'ifrs-ps-theme'))
          )),
          createElement(Button, {
            variant: 'primary',
            onClick: addItem,
          }, __('Adicionar link', 'ifrs-ps-theme'))
          )
        ),
        createElement('div', { className: 'intro-helper-block' },
          createElement(RichText, {
            tagName: 'h2',
            className: 'wp-block-heading intro-helper-block__title',
            value: title,
            allowedFormats: [],
            placeholder: __('Adicione o título do bloco', 'ifrs-ps-theme'),
            onChange: (value) => setAttributes({ title: value }),
          }),
          createElement('div', { className: 'intro-helper-block__steps' },
            STEPS.map((step, index) => createElement('article', {
              className: 'intro-helper-block__step',
              key: `step-${index}`,
            },
            createElement('div', { className: 'intro-helper-block__step-content' },
              createElement('span', { className: 'intro-helper-block__step-number' }, `${index + 1}`),
              createElement('div', { className: 'intro-helper-block__step-icon' }, renderStepIcon(index)),
              createElement('p', { className: 'intro-helper-block__step-text' }, step.text),
            ),
            step.link_text &&createElement('a',
              {
                'aria-disabled': true,
                tabIndex: -1,
                className: 'intro-helper-block__step-link',
              },
              step.link_text || 'Link'
            )
          ))),
          createElement(RichText, {
            tagName: 'h3',
            className: 'wp-block-heading intro-helper-block__links-title',
            value: linksTitle,
            allowedFormats: [],
            placeholder: __('Adicione o título da seção de links', 'ifrs-ps-theme'),
            onChange: (value) => setAttributes({ linksTitle: value }),
          }),
          createElement('div', { className: 'intro-helper-block__content' },
            createElement(InnerBlocks, {
              template: [
                ['core/paragraph', { placeholder: __('Adicione aqui os parágrafos e outros blocos de conteúdo.', 'ifrs-ps-theme') }],
              ],
              templateLock: false,
            })
          ),
          items.length === 0
            ? createElement('p', { className: 'intro-helper-block__no-items' }, __('Nenhum link configurado. Use o painel lateral para adicionar.', 'ifrs-ps-theme'))
            : createElement('div', { className: 'intro-helper-block__links' }, items.map((item, index) => createElement('form', { key: `preview-${index}` },
              createElement('button', {
                type: 'button',
                className: 'btn btn-link',
                disabled: true,
              }, item.frase || __('Defina a frase do link', 'ifrs-ps-theme'))
            )))
        )
      );
    },

    save: () => createElement(InnerBlocks.Content),
  });
}( window.wp ));
