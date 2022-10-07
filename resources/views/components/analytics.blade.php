@props(['pagina' => null, 'fornecedor' => null, 'produto' => null])

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ env('ANALYTICS_VIEW_ID') }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '{{ env('ANALYTICS_VIEW_ID') }}', {
    'custom_map': {
      {!! !is_null($pagina) ? "'dimension1': 'pagina'," : "" !!}
      {!! !is_null($fornecedor) ? "'dimension2': 'fornecedor'," : "" !!}
      {!! !is_null($produto) ? "'dimension3': 'produto'," : "" !!}
    }
  });

  // Sends the custom dimension to Google Analytics.
  gtag('event', 'evt_page', @json(collect(['pagina' => $pagina, 'fornecedor' => $fornecedor, 'produto' => $produto])->filter()));
</script>
