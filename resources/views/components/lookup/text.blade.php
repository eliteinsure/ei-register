@props(['id', 'model'])

{{-- @this.call: {{ $id }}LookupList --}}
{{-- $this->dispatchBrowserEvent: {{ $id }}LookupList --}}

<div wire:ignore>
  <x-jet-input id="{{ $id }}" type="hidden"
    class="mt-1 block w-full lookup" />
</div>

@push('scripts')
  <script type="text/javascript">
    window.onload = () => {
      var input_{{ $id }} = document.querySelector('#{{ $id }}');

      var tagify_{{ $id }} = new Tagify(input_{{ $id }}, {
        dropdown: {
          enabled: 1,
          mapValueTo: 'label',
          searchKeys: [],
        },
        mode: 'select',
        tagTextProp: 'label',
      });

      var controller;

      const tagify_{{ $id }}LookupList = (search) => {
        tagify_{{ $id }}.whitelist = null;

        controller && controller.abort();

        controller = new AbortController();

        tagify_{{ $id }}.loading(true).dropdown.hide();

        @this.call('{{ $id }}LookupList', search);
      }

      tagify_{{ $id }}.on('focus', (event) => {
        tagify_{{ $id }}LookupList('');
      });

      tagify_{{ $id }}.on('input', _.debounce((event) => {
        tagify_{{ $id }}LookupList(event.detail.value);
      }, 250));

      window.addEventListener('{{ $id }}LookupList', (event) => {
        tagify_{{ $id }}.whitelist = event.detail;

        tagify_{{ $id }}.loading(false).dropdown.show();
      });

      tagify_{{ $id }}.on('change', (event) => {
        var data = JSON.parse(event.detail.value);

        @this.set('{{ $model }}', data[0].value);
      });
    }
  </script>
@endpush
