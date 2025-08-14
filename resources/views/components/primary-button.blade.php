<button {{ $attributes->merge(['type' => 'submit', 'class' => 'admin-button inline-flex items-center px-6 py-3 rounded-lg font-semibold text-white hover:scale-105 transform transition-all duration-200 shadow-lg bg-gradient-to-r from-red-700 to-red-500 hover:from-red-600 hover:to-red-400']) }}>
    {{ $slot }}
</button>
