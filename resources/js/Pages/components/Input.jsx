import React from 'react';

const Input = ({ value, onChange, placeholder, type = 'text', className, error }) => {
  return (
    <div className={`mb-4 ${className}`}>
      <input
        type={type}
        value={value}
        onChange={onChange}
        placeholder={placeholder}
        className={`block mb-2 text-sm font-medium text-gray-900 dark:text-white w-full ${error ? 'border-red-500' : 'border-gray-300'}`}
      />
      {error && <p className="text-red-500 text-xs italic">{error}</p>}
    </div>
  );
};

export default Input;