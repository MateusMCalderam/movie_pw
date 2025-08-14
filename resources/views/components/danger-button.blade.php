<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-red-600/20 border border-red-500/30 rounded-lg font-semibold text-red-400 hover:bg-red-600/30 hover:border-red-500/50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 hover:scale-105 transform']) }}>
    {{ $slot }}
</button>
