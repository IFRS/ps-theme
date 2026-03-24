( function( wp ) {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const useBlockProps = (wp.blockEditor && wp.blockEditor.useBlockProps)
    ? wp.blockEditor.useBlockProps
    : () => ({ });
  const { InspectorControls } = wp.blockEditor || wp.editor;
  const { InnerBlocks } = wp.blockEditor || wp.editor;
  const { PanelBody, SelectControl, TextControl, Button } = wp.components;
  const createElement = wp.element.createElement;

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

  registerBlockType('ifrs-ps/cursos-helper', {
    apiVersion: 2,
    title: __('Ajudante de Cursos', 'ifrs-ps-theme'),
    description: __('Cria frases linkadas de envio para a listagem de cursos com a modalidade escolhida.', 'ifrs-ps-theme'),
    icon: 'forms',
    category: 'widgets',
    attributes: {
      title: {
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
      const options = getModalidadeOptions();
      const blockProps = useBlockProps({ className: 'ifrs-ps-cursos-helper-block' });

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
          createElement(TextControl, {
            label: __('Título', 'ifrs-ps-theme'),
            value: title,
            onChange: (value) => setAttributes({ title: value }),
          }),
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
        createElement('div', null,
          createElement('h2', null, title || __('Defina o título no painel lateral', 'ifrs-ps-theme')),
          createElement('div', { className: 'cursos-helper-block__content' },
            createElement(InnerBlocks, {
              template: [
                ['core/paragraph', { placeholder: __('Adicione aqui os parágrafos e outros blocos de conteúdo.', 'ifrs-ps-theme') }],
              ],
              templateLock: false,
            })
          ),
          items.length === 0
            ? createElement('p', null, __('Nenhum link configurado. Use o painel lateral para adicionar.', 'ifrs-ps-theme'))
            : items.map((item, index) => createElement('p', { key: `preview-${index}` },
              createElement('button', {
                type: 'button',
                className: 'btn btn-link',
                disabled: true,
              }, item.frase || __('Defina a frase do link', 'ifrs-ps-theme'))
            ))
        )
      );
    },

    save: () => createElement(InnerBlocks.Content),
  });
}( window.wp ));
