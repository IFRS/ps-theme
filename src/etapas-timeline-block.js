( function( wp ) {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const { InspectorControls } = wp.blockEditor || wp.editor;
  const useBlockProps = (wp.blockEditor && wp.blockEditor.useBlockProps)
    ? wp.blockEditor.useBlockProps
    : () => ({ });
  const { PanelBody, ToggleControl, RangeControl } = wp.components;
  const ServerSideRender = wp.serverSideRender;
  const createElement = wp.element.createElement;

  registerBlockType('ifrs-ps/etapas-timeline', {
    apiVersion: 2,
    title: __('Timeline de Etapas Importantes', 'ifrs-ps-theme'),
    description: __('Mostra os eventos marcados como etapa importante em ordem cronológica.', 'ifrs-ps-theme'),
    icon: 'calendar-alt',
    category: 'widgets',
    attributes: {
      hidePast: {
        type: 'boolean',
        default: true,
      },
      postsPerPage: {
        type: 'number',
        default: 10,
      },
    },

    edit: ( props ) => {
      const { attributes, setAttributes } = props;
      const blockProps = useBlockProps();

      return createElement('div', blockProps,
        createElement(InspectorControls, null,
          createElement(PanelBody, {
            title: __('Configurações', 'ifrs-ps-theme'),
            initialOpen: true,
          },
          createElement(ToggleControl, {
            label: __('Ocultar datas já passadas', 'ifrs-ps-theme'),
            checked: !!attributes.hidePast,
            onChange: (value) => setAttributes({ hidePast: !!value }),
          }),
          createElement(RangeControl, {
            label: __('Quantidade de eventos', 'ifrs-ps-theme'),
            value: attributes.postsPerPage,
            onChange: (value) => setAttributes({ postsPerPage: value }),
            min: 1,
            max: 50,
          }))
        ),
        createElement(ServerSideRender, {
          block: 'ifrs-ps/etapas-timeline',
          attributes,
        })
      );
    },

    save: () => null,
  });
}( window.wp ));
