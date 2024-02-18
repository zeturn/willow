@props(['disabled' => false])

<!--
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) !!}>  
-->
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg--gray-300 border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 disabled:cursor-not-allowed disabled:opacity-50']) !!}>
