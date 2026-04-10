(function (wp) {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const { InspectorControls } = wp.blockEditor || wp.editor;
  const useBlockProps = (wp.blockEditor && wp.blockEditor.useBlockProps)
    ? wp.blockEditor.useBlockProps
    : () => ({});
  const { PanelBody, RangeControl, TextControl } = wp.components;
  const ServerSideRender = wp.serverSideRender;
  const createElement = wp.element.createElement;

  registerBlockType('ifrs-ps/publicacoes-list', {
    apiVersion: 2,
    title: __('Lista de Publicações', 'ifrs-ps-theme'),
    description: __('Lista as últimas publicações e editais para destaque.', 'ifrs-ps-theme'),
    icon: 'media-document',
    category: 'widgets',
    attributes: {
      title: {
        type: 'string',
        default: __('Últimas Publicações', 'ifrs-ps-theme'),
      },
      postsPerPage: {
        type: 'number',
        default: 5,
      },
    },

    edit: (props) => {
      const { attributes, setAttributes } = props;
      const blockProps = useBlockProps();

      return createElement('div', blockProps,
        createElement(InspectorControls, null,
          createElement(PanelBody, {
            title: __('Configurações', 'ifrs-ps-theme'),
            initialOpen: true,
          },
            createElement(TextControl, {
              label: __('Título', 'ifrs-ps-theme'),
              value: attributes.title,
              onChange: (value) => setAttributes({ title: value }),
            }),
            createElement(RangeControl, {
              label: __('Quantidade de publicações', 'ifrs-ps-theme'),
              value: attributes.postsPerPage,
              onChange: (value) => setAttributes({ postsPerPage: value }),
              min: 1,
              max: 50,
            }))
        ),
        createElement(ServerSideRender, {
          block: 'ifrs-ps/publicacoes-list',
          attributes,
        })
      );
    },

    save: () => null,
  });
}(window.wp));
