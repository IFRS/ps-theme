(function (wp) {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const useBlockProps = (wp.blockEditor && wp.blockEditor.useBlockProps)
    ? wp.blockEditor.useBlockProps
    : () => ({});
  const { InspectorControls } = wp.blockEditor || wp.editor;
  const { InnerBlocks, RichText } = wp.blockEditor || wp.editor;
  const { PanelBody, SelectControl, TextControl, Button } = wp.components;
  const createElement = wp.element.createElement;

  const getSteps = () => {
    const config = window.ifrsPsIntroHelperConfig || {};
    const steps = Array.isArray(config.steps) ? config.steps : [];

    return steps.map((step) => ({
      text: step && step.text ? step.text : '',
      link_text: step && step.link_text ? step.link_text : null,
      icon_paths: Array.isArray(step && step.icon_paths) ? step.icon_paths : [],
    }));
  };

  const getModalidadeOptions = () => {
    const config = window.ifrsPsIntroHelperConfig || {};
    const terms = Array.isArray(config.modalidades)
      ? config.modalidades
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

  const renderStepIcon = (iconPaths = []) => {
    if (!Array.isArray(iconPaths) || iconPaths.length === 0) {
      return null;
    }

    return renderSvg(iconPaths.map((path, index) => createElement('path', {
      d: path,
      key: `p${index}`,
    })));
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

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const items = Array.isArray(attributes.items) ? attributes.items : [];
      const title = attributes.title || '';
      const linksTitle = attributes.linksTitle || '';
      const steps = getSteps();
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
            steps.map((step, index) => createElement('article', {
              className: 'intro-helper-block__step',
              key: `step-${index}`,
            },
              createElement('div', { className: 'intro-helper-block__step-content' },
                createElement('span', { className: 'intro-helper-block__step-number' }, `${index + 1}`),
                createElement('div', { className: 'intro-helper-block__step-icon' }, renderStepIcon(step.icon_paths)),
                createElement('p', { className: 'intro-helper-block__step-text' }, step.text),
              ),
              step.link_text && createElement('a',
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
}(window.wp));
