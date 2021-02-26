<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GDPRAgreement
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        if (! config('app.gdpr_enabled')) {
            return $response;
        }
        
        if (! $response instanceof Response) {
            return $response;
        }
        
        if (! $this->containsBodyTag($response)) {
            return $response;
        }
        
        return $this->addCookieConsentScriptToResponse($response);
    }
    
    protected function containsBodyTag(Response $response): bool
    {
        return $this->getLastClosingBodyTagPosition($response->getContent()) !== false;
    }
    
    /**
    * @param \Illuminate\Http\Response $response
    *
    * @return $this
    */
    protected function addCookieConsentScriptToResponse(Response $response)
    {
        $content = $response->getContent();
        
        $closingBodyTagPosition = $this->getLastClosingBodyTagPosition($content);
        
        $content = ''
        .substr($content, 0, $closingBodyTagPosition)
        .view('gdpr_index')->render()
        .substr($content, $closingBodyTagPosition);
        
        return $response->setContent($content);
    }
    
    protected function getLastClosingBodyTagPosition(string $content = '')
    {
        return strripos($content, '</body>');
    } 
}
