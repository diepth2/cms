<?php

if (!class_exists('CacheUtilities'))
{
	class CacheUtilities extends dmWidgetPluginView {
	
	    public static function getCacheCustom($widget) {
	        if ($widget->isCachable() && $cache = $widget->getCache()) {
	            return $cache;
	        }
	        else
	            return;
	    }
	
	    public static function setCacheCustom($widget, $html, $lifetime) {
	        if ($widget->isCachable()) {
	            return $widget->getService('cache_manager')->getCache($widget->getCacheName())->set($widget->generateCacheKey(), $html, $lifetime);
	        }
	        else
	            return;
	    }
  }
}
