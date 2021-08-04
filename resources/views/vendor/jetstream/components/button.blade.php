<button
  {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-dsgreen border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-tblue active:bg-shark focus:outline-none focus:border-dsgreen focus:ring focus:ring-lmara disabled:opacity-25 transition']) }}>
  {{ $slot }}
</button>
