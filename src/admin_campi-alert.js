window.wp.domReady(( function ( wp ) {
  const unsubscribe = wp.data.subscribe(() => {
    const isReady = wp.data.select('core/editor').__unstableIsEditorReady();

    if (!isReady) return;

    unsubscribe();

    if (wp.data.select('core/editor').getEditedPostSlug() === 'campi') {
      wp.data.dispatch( 'core/notices' ).createNotice(
        'info',
        'Essa página inclui automaticamente uma lista com os Campi cadastrados, logo após o conteúdo.',
        {
          isDismissible: true,
        }
      );
    }
  });
} )( window.wp ));
