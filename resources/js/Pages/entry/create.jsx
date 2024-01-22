import React, { useState } from 'react';
import Input from '../components/Input';    // 假设 Input 组件的路径
import Textarea from '../components/Textarea'; // 假设 Textarea 组件的路径

const CreateEntryForm = () => {
  const [entry, setEntry] = useState({
    name: '',
    description: '',
    content: ''
  });

  const handleChange = (e) => {
    setEntry({...entry, [e.target.name]: e.target.value});
  };  

  const handleSubmit = (e) => {
    e.preventDefault();
    // 提交表单的逻辑
  };

  return (
    <div className="container mx-auto p-4 dark:bg-gray-900 max-w-7xl">
      <div className="flex flex-wrap -mx-4">
        <div className="w-full px-4">
          <h1 className="text-3xl mb-4 dark:text-white">Create New Entry</h1>
          <h2 className="text-2xl mb-4 dark:text-white">Create new entry, branch, version</h2>

          <form onSubmit={handleSubmit}>
            
            <Input
              value={entry.name}
              onChange={handleChange}
              placeholder="Entry name"
              name="name"
              className="mb-4"
              required
            />

            <Textarea
              value={entry.description}
              onChange={handleChange}
              placeholder="Entry description"
              name="description"
              className="mb-4"
              required
            />

            <Textarea
              value={entry.content}
              onChange={handleChange}
              placeholder="Entry content"
              name="content"
              className="mb-4"
              required
            />

            <button type="submit" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Create Entry
            </button>
          </form>
        </div>
      </div>
    </div>
  );
};

export default CreateEntryForm;
