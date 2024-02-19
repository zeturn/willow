import React from 'react';

const Textarea = ({ value, onChange, placeholder, className, error }) => {
  return (
    <div className={`mb-4 ${className}`}>
      <textarea
        value={value}  // 这里使用了 value
        onChange={onChange}  // 这里使用了 onChange
        placeholder={placeholder}
        className={`bg-gray-100 border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 disabled:cursor-not-allowed disabled:opacity-50 ${error ? 'border-red-500' : 'border-gray-300'}`}
      />
      {error && <p className="text-red-500 text-xs italic">{error}</p>}
    </div>
  );
};

export default Textarea;
