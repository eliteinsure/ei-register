@props(['id', 'model'])

{{-- @this.call: {{ $id }}LookupSearch --}}
{{-- $this->dispatchBrowserEvent: {{ $id }}-lookup-list --}}

<div wire:ignore x-data="{{ $id }}LookupText"
  x-on:{{ $id }}-lookup-list.window="lookupList">
  <x-jet-input id="{{ $id }}" type="hidden"
    class="mt-1 block w-full lookup" x-ref="input" />
</div>

@push('scripts')
  <script type="text/javascript">
    document.addEventListener('alpine:init', () => {
      Alpine.data('{{ $id }}LookupText', () => ({
        tagify: null,
        init() {
          window.onload = () => {
            this.tagify = new window.Tagify(this.$refs.input, {
              dropdown: {
                enabled: 1,
                mapValueTo: 'label',
                searchKeys: [],
              },
              mode: 'select',
              tagTextProp: 'label',
              callbacks: {
                'focus': () => {
                  this.lookupSearch('');
                },
                'input': _.debounce((event) => {
                  this.lookupSearch(event.detail.value);
                }, 250),
                'change': (event) => {
                  var value = event.detail.value;

                  if (value) {
                    var data = JSON.parse(value);

                    this.$wire.set('{{ $model }}', data[0].value);
                  } else {
                    this.$wire.set('{{ $model }}', null);
                  }
                }
              }
            });
          }
        },
        lookupSearch(search) {
          var controller;

          this.tagify.whitelist = null;

          controller && conroller.abort();

          controller = new AbortController();

          this.tagify.loading(true).dropdown.hide();

          this.$wire.{{ $id }}LookupSearch(search);
        },
        lookupList(event) {
          this.tagify.whitelist = event.detail;

          this.tagify.loading(false).dropdown.show();
        }
      }));
    });
  </script>
@endpush
