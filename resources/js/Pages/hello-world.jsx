import React, { useState } from 'react';
import Input from './components/Input/Input';
import Textarea from './components/Textarea/Textarea';

import LargeButton from './components/Button/LargeButton';
import SmallButton from './components/Button/SmallButton';
import BaseButton from './components/Button/BaseButton';

import PrimaryCheckbox from './components/Checkbox/PrimaryCheckbox';
import SecondaryCheckbox from './components/Checkbox/SecondaryCheckbox';

import PrimaryBasicBaseToggle from './components/Toggle/PrimaryBasicBaseToggle';
import PrimaryBasicLargeToggle from './components/Toggle/PrimaryBasicLargeToggle';
import SecondaryBasicBaseToggle from './components/Toggle/SecondaryBasicBaseToggle';
import SecondaryBasicLargeToggle from './components/Toggle/SecondaryBasicLargeToggle';

const MyFormComponent = () => {
  const [value, setValue] = useState('');
  const [error, setError] = useState('');

  const handleChange = (event) => {
    setValue(event.target.value);
    // 在这里添加验证逻辑并设置错误消息
    if (event.target.value.length < 10) {
      setError('输入内容过短');
    } else {
      setError('');
    }
  };

  return (
    <div>
    <a>11111111</a>
        <Input
        value={value}
        onChange={handleChange}
        placeholder="请输入更多内容"
        error={error}
      />

      <Textarea
        value={value}
        onChange={handleChange}
        placeholder="请输入更多内容"
        error={error}
      />

      <LargeButton></LargeButton>
      <BaseButton></BaseButton>
      <SmallButton></SmallButton>

      <PrimaryCheckbox></PrimaryCheckbox>
      <SecondaryCheckbox></SecondaryCheckbox>

      <PrimaryBasicBaseToggle></PrimaryBasicBaseToggle>
      <PrimaryBasicLargeToggle></PrimaryBasicLargeToggle>
      <SecondaryBasicBaseToggle></SecondaryBasicBaseToggle>
      <SecondaryBasicLargeToggle></SecondaryBasicLargeToggle>
      

      {/* 其他组件和内容 */}
    </div>
  );
};

export default MyFormComponent;
