<button
  {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-shark uppercase tracking-widest shadow-sm hover:text-tblue focus:outline-none focus:border-dsgreen focus:ring focus:ring-lmara active:text-lmara active:bg-gray-50 disabled:opacity-25 transition']) }}>
  {{ $slot }}
</button>
