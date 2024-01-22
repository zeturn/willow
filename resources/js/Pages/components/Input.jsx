import React from 'react';

const Input = ({
  value,
  onChange,
  placeholder,
  type = 'text', // 已有默认值
  className,
  error,
  maxLength = 255, // 新增，默认值为 255
  readOnly = false, // 新增，默认值为 false
  size, // 新增，无默认值
  id, // 新增，无默认值
  name // 新增，无默认值
}) => {
  return (
    <div className={`mb-4 ${className}`}>
      <input
        type={type}
        value={value}
        onChange={onChange}
        placeholder={placeholder}
        maxLength={maxLength}
        readOnly={readOnly}
        size={size}
        id={id}
        name={name}
        className={`block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 ${error ? 'border-red-500' : 'border-gray-300'}`}
      />
      {error && <p className="text-red-500 text-xs italic">{error}</p>}
    </div>
  );
};

export default Input;
