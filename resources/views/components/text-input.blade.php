@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed auth-input']) }}>
