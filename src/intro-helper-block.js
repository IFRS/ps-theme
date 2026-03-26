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
    __('Escolha um Campus e Curso', 'ifrs-ps-theme'),
    __('Leia atentamente o Edital e faça sua Inscrição', 'ifrs-ps-theme'),
    __('Realize a Prova ou acompanhe o Sorteio', 'ifrs-ps-theme'),
    __('Acompanhe os Resultados', 'ifrs-ps-theme'),
    __('Faça sua Pré-matrícula', 'ifrs-ps-theme'),
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
      viewBox: '0 0 48 48',
      focusable: 'false',
      'aria-hidden': 'true',
    },
    ...children
  );

  const renderStepIcon = (stepIndex) => {
    switch (stepIndex) {
      case 0:
        return renderSvg([
          createElement('path', { d: 'M12 18h24v16H12z', key: 'p1' }),
          createElement('path', { d: 'M18 18v-4h12v4', key: 'p2' }),
          createElement('path', { d: 'M24 25l3 2 5-5', key: 'p3' }),
          createElement('path', { d: 'M16 10h16', key: 'p4' }),
        ]);
      case 1:
        return renderSvg([
          createElement('path', { d: 'M16 10h16l4 4v24H12V10z', key: 'p1' }),
          createElement('path', { d: 'M18 20h12', key: 'p2' }),
          createElement('path', { d: 'M18 26h12', key: 'p3' }),
          createElement('path', { d: 'M18 32h8', key: 'p4' }),
          createElement('path', { d: 'M31 11v5h5', key: 'p5' }),
        ]);
      case 2:
        return renderSvg([
          createElement('path', { d: 'M12 16h24v20H12z', key: 'p1' }),
          createElement('path', { d: 'M18 10v8', key: 'p2' }),
          createElement('path', { d: 'M30 10v8', key: 'p3' }),
          createElement('path', { d: 'M12 22h24', key: 'p4' }),
          createElement('path', { d: 'M20 29l3 3 6-7', key: 'p5' }),
        ]);
      case 3:
        return renderSvg([
          createElement('path', { d: 'M14 34V20', key: 'p1' }),
          createElement('path', { d: 'M24 34V14', key: 'p2' }),
          createElement('path', { d: 'M34 34V24', key: 'p3' }),
          createElement('path', { d: 'M10 38h28', key: 'p4' }),
        ]);
      case 4:
        return renderSvg([
          createElement('path', { d: 'M24 11a6 6 0 1 1 0 12a6 6 0 0 1 0-12Z', key: 'p1' }),
          createElement('path', { d: 'M14 37a10 10 0 0 1 20 0', key: 'p2' }),
          createElement('path', { d: 'M31 30l3 3 6-7', key: 'p3' }),
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
            className: 'intro-helper-block__title',
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
            createElement('span', { className: 'intro-helper-block__step-number' }, `${index + 1}`),
            createElement('div', { className: 'intro-helper-block__step-icon' }, renderStepIcon(index)),
            createElement('p', { className: 'intro-helper-block__step-text' }, step)
            ))
          ),
          createElement(RichText, {
            tagName: 'h3',
            className: 'intro-helper-block__links-title',
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
