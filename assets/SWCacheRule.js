'use strict';

(function () {
  'use strict';
    /**
    * Service Worker Toolbox caching
    */

    var cacheVersion = '-toolbox-v1';
    var dynamicVendorCacheName = 'dynamic-vendor' + cacheVersion;
    var staticVendorCacheName = 'static-vendor' + cacheVersion;
    var staticAssetsCacheName = 'static-assets' + cacheVersion;
    var contentCacheName = 'content' + cacheVersion;
    var maxEntries = 50;


    self.importScripts('usr/themes/RAW/assets/sw-toolbox.js');

    self.toolbox.options.debug = false;

    // 缓存本站静态文件
    self.toolbox.router.get('/usr/(.*)', self.toolbox.cacheFirst, {
        cache: {
          name: staticAssetsCacheName,
          maxEntries: maxEntries
        }
    });

	// 缓存 Gravatar 头像
    self.toolbox.router.get('/avatar/(.*)', self.toolbox.cacheFirst, {
        origin: /(secure\.gravatar\.com)/,
        cache: {
          name: staticVendorCacheName,
          maxEntries: maxEntries
        }
    });

    // immediately activate this serviceworker
    self.addEventListener('install', function (event) {
        return event.waitUntil(self.skipWaiting());
    });

    self.addEventListener('activate', function (event) {
        return event.waitUntil(self.clients.claim());
    }); 

})();