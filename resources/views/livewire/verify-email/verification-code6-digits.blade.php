<div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
    <div class="card-body">
        @if ($step === 1)  
                <div class = "text-gray-800" x-data="otpInput()" x-init="OTPInput()">
                    <h1 class="text-3xl font-bold text-center text-gray-800">邮箱验证</h1>
                    <p class="text-gray-600 text-center">请输入邮件中的6位数字密钥</P>
                    <form id="otpForm">
                        <div class="container mx-auto flex justify-center items-center">
                            <div class="card p-2 text-center text-blue-400">
                                <div id="otp" class="flex flex-row justify-center -mx-1">
                                    <template x-for="(input, index) in inputs" :key="index">
                                        <input
                                            x-model="input.value"
                                            class="m-2 text-center form-input rounded w-10"
                                            type="text"
                                            :id="'otp' + index"
                                            maxlength="1"
                                            @input="moveFocus($event, index)"
                                            @paste="pasteOTP($event)"
                                        />
                                    </template>
                                </div>
                                <input
                                    type="text"
                                    class="m-2 text-center form-input rounded w-64 mt-4 hidden"
                                    x-model="combinedOTP"
                                    wire:model="key" 
                                    readonly
                                />
                            </div>
                        </div>
                    </form>
                


                @error('key') <span class="text-red-500">{{ $message }}</span> @enderror
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4" 
                        wire:click="verify(combinedOTP)"
                >提交</button>

                </div>

                <script>
                    function otpInput() {
                        return {
                            inputs: Array.from({ length: 6 }, () => ({ value: '' })),
                            combinedOTP: '',

                            OTPInput() {
                                this.$watch('inputs', () => {
                                    this.combinedOTP = this.inputs.map(input => input.value).join('');
                                }, { deep: true });
                            },

                            moveFocus(event, index) {
                                if (!event.target.value || event.target.value === '') {
                                    if (document.getElementById(`otp${index - 1}`)) {
                                        document.getElementById(`otp${index - 1}`).focus();
                                    }
                                } else if (document.getElementById(`otp${index + 1}`)) {
                                    document.getElementById(`otp${index + 1}`).focus();
                                }
                            },

                            pasteOTP(event) {
                                event.preventDefault();
                                const pasteData = event.clipboardData.getData('text').split('');
                                if (pasteData.length > 0) {
                                    this.inputs.forEach((input, index) => {
                                        input.value = pasteData[index] || '';
                                    });
                                    this.combinedOTP = pasteData.slice(0, 6).join('');
                                }
                            },

                        };
                    }
                </script>
                
                
                @if ($error)
                    <div class="text-red-500 mt-4">{{ $error }}</div>
                @endif
            

        @elseif ($step === 2)
            <div class="text-green-500">验证成功~</div>
            <p class="text-gray-600">现在，memedevise的大门向你敞开！</P>
            <a href="{{ route('workstation.index') }}" class="text-gray-600 text-center">点击此处去往workstation，开始你的旅程吧！</a>
        @endif
    </div>
</div>
