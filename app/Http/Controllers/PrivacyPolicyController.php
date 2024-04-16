<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

class PrivacyPolicyController extends Controller
{
    /**
     * Show the privacy policy for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        try {
            // 获取本地化隐私政策文件的路径
            $policyFile = Jetstream::localizedMarkdownPath('policy.md');
    
            // 读取文件内容，并将其转换为Markdown格式
            $policyMarkdown = file_get_contents($policyFile);
    
            // 将Markdown转换为HTML
            $policyHtml = Str::markdown($policyMarkdown);
    
            // 渲染视图，并传递隐私政策HTML
            return view('policy', [
                'policy' => $policyHtml,
            ]);
        } catch (\Exception $e) {
            // 记录错误信息
            Log::error("Error reading policy file: " . $e->getMessage());
    
            // 可以根据需要返回错误视图或进行其他错误处理
            return abort(500, 'An error occurred while reading the policy file.');
        }
    }
}
