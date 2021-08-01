@props(['id'])

{{-- @this.call: {{ $id }}LookupSearch --}}
{{-- $this->dispatchBrowserEvent: {{ $id }}-lookup-list --}}

<div wire:ignore.self x-data="{{ $id }}LookupText"
  x-on:{{ $id }}-lookup-list.window="lookupList"
  x-on:{{ $id }}-lookup-value.window="lookupValue">
  <div wire:ignore>
    <x-jet-input id="{{ $id }}" type="hidden"
      class="{{ $attributes->class ?? 'block w-full mt-1' }} lookup"
      x-ref="input" />
  </div>
  <input type="hidden" x-ref="hidden" {{ $attributes->whereStartsWith('wire:model') }} />
</div>

@push('scripts')
  <script type="text/javascript">
    document.addEventListener('alpine:init', () => {
      Alpine.data('{{ $id }}LookupText', () => ({
        tagify: null,
        init() {
          document.addEventListener('DOMContentLoaded', () => {
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
                  this.$refs.hidden.value = event.detail.value;

                  this.$refs.hidden.dispatchEvent(new Event('input'));
                }
              }
            });
          });
        },
        lookupValue(event) {
          this.tagify.addTags(JSON.parse(event.detail));
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
