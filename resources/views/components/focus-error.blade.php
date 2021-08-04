<div x-data="focusError" x-on:focus-error.window="focusInput"></div>

@push('scripts')
  <script type="text/javascript">
    document.addEventListener('alpine:init', () => {
      Alpine.data('focusError', () => ({
        focusInput(event) {
          let inputError = document.querySelector('.input-error');

          if (!inputError) return;

          let formInput = inputError.closest('.form-input');

          let input = formInput.querySelector(
            '.tagify__input, input:not([type=\'hidden\']), textarea, select, [tabindex]:not([tabindex=\'-1\']'
          );

          if (!input) return;

          setTimeout(() => {
            input.focus();
          }, 100);
        }
      }));
    });
  </script>
@endpush
