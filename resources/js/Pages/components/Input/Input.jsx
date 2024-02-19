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
        className={`bg-gray-100 border rounded-md border-neutral-300 ring-offset-background placeholder:text-neutral-500 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400 disabled:cursor-not-allowed disabled:opacity-50 ${error ? 'border-red-500' : 'border-gray-300'}`}
      />
      {error && <p className="text-red-500 text-xs italic">{error}</p>}
    </div>
  );
};

export default Input;
