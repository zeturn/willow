import React from 'react';

const Textarea = ({ value, onChange, placeholder, className, error }) => {
  return (
    <div className={`mb-4 ${className}`}>
      <textarea
        value={value}
        onChange={onChange}
        placeholder={placeholder}
        className={`block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ${error ? 'border-red-500' : 'border-gray-300'}`}
      />
      {error && <p className="text-red-500 text-xs italic">{error}</p>}
    </div>
  );
};

export default Textarea;
