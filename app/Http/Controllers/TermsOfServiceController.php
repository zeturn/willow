<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Laravel\Jetstream\Jetstream;

class TermsOfServiceController extends Controller
{
    /**
     * Show the terms of service for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        try {
            // 获取本地化条款文件的路径
            $termsFile = Jetstream::localizedMarkdownPath('terms.md');
    
            // 读取文件内容，并将其转换为Markdown格式
            $termsMarkdown = file_get_contents($termsFile);
    
            // 将Markdown转换为HTML
            $termsHtml = Str::markdown($termsMarkdown);
    
            // 渲染视图，并传递条款HTML
            return view('terms', [
                'terms' => $termsHtml,
            ]);
        } catch (\Exception $e) {
            // 记录错误信息
            Log::error("Error reading terms file: " . $e->getMessage());
    
            // 可以根据需要返回错误视图或进行其他错误处理
            return abort(500, 'An error occurred while reading the terms file.');
        }
    }
}
