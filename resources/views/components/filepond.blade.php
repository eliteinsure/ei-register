@props(['accept' => ['*']])

<div
  wire:ignore
  x-data="{{ $attributes->whereStartsWith('wire:model')->first() }}FilePond()"
  x-on:{{ $attributes->whereStartsWith('wire:model')->first() }}-filepond-reset.window="reset">
  <input type="file" x-ref="input" />
</div>

@push('scripts')
  <script type='text/javascript'>
    document.addEventListener('alpine:init', () => {
      Alpine.data('{{ $attributes->whereStartsWith('wire:model')->first() }}FilePond', () => ({
        pond: null,
        init() {
          document.addEventListener('DOMContentLoaded', () => {
            FilePond.setOptions({
              alloweReplace: false,
              server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer,
                  options) => {
                  @this.upload(
                    '{{ $attributes->whereStartsWith('wire:model')->first() }}', file,
                    load, error,
                    progress);
                },
                revert: (filename, load) => {
                  @this.removeUpload(
                    '{{ $attributes->whereStartsWith('wire:model')->first() }}',
                    filename, load);
                }
              }
            });

            this.pond = FilePond.create(this.$refs.input, {
              acceptedFileTypes: @json($accept)
            });
          });
        },
        reset(event) {
          console.log('will reset');
          this.pond.removeFile();
        }
      }));
    });
  </script>
@endpush
