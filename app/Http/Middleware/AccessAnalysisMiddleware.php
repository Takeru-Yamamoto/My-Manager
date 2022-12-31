<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccessAnalysisMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!config("access.time") && !config("access.path") && !config("access.method") && !config("access.user_agent") && !config("access.ip") && !config("access.memory")) return $next($request);
        // if (!config("access.event") && strpos($request->getRequestUri(), "api/event") !== false) return $next($request);

        dividerLog();
        infoLog("アクセス解析開始");
        emptyLog();

        $start = microtime(true);
        $res = $next($request);
        $stop = microtime(true);

        emptyLog();
        if (config("access.time")) infoLog("実行時間計測結果: " . (($stop - $start) * cubed(10)) . "ms");
        if (config("access.path")) infoLog("リクエストルート: " . e($request->getRequestUri()));
        if (config("access.method")) infoLog("HTTPメソッド: " . $request->method());
        if (config("access.user_agent")) infoLog("User Agent: " . $request->userAgent());
        if (config("access.ip")) infoLog("アクセスIPアドレス: " . $request->ip());
        if (config("access.memory")) infoLog("メモリ最大使用量: " . memory_get_peak_usage() / (1024 * 1024) . " MB (" . memory_get_peak_usage() . " byte)");

        dividerLog();

        return $res;
    }
}
