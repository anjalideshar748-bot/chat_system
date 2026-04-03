@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-200 focus:border-teal-500 focus:ring-teal-500 rounded-xl shadow-sm']) }}>
