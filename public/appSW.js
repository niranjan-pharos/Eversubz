importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.5.4/workbox-sw.js');

const CA = "cache-v3.7";

const OPG = [
  'https://eversabz.com/offline',
  'https://eversabz.com/contactus',
  'https://eversabz.com/main_assets/images/favicon.png',
  'https://eversabz.com/storage/placeholder-image.webp',
  'https://eversabz.com/assets/images/icons/spriticon.png',
  'https://eversabz.com/assets/images/icons/spriticoncategory.png',
  'https://code.jquery.com/jquery-3.7.1.min.js',
  'https://eversabz.com/main_assets/js/uikit.min.js',
  'https://eversabz.com/main_assets/js/simplebar.js',
  'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
  'https://eversabz.com/assets/js/vendor/popper.min.js',
  'https://eversabz.com/assets/js/vendor/bootstrap.min.js',
  'https://eversabz.com/assets/js/vendor/slick.min.js',
  'https://eversabz.com/assets/js/custom/slick.js',
  'https://eversabz.com/assets/js/custom/main.js',
  'https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js',
  'https://js.pusher.com/7.0/pusher.min.js',
  'https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.min.js',
  'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/js/fileinput.min.js',
  'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/themes/fa/theme.min.js',
  'https://eversabz.com/main_assets/css/tailwind_org.css',
  'https://eversabz.com/main_assets/css/style.css',
  'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css',
  'https://eversabz.com/assets/fonts/flaticon/flaticon.css',
  'https://eversabz.com/assets/css/vendor/slick.min.css',
  'https://eversabz.com/assets/css/vendor/bootstrap.min.css',
  'https://eversabz.com/assets/css/custom/main.css',
  'https://eversabz.com/assets/css/custom/index.css',
  'https://eversabz.com/assets/css/custom/my_style.css',
  'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
  'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css',
  'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css',
];

const OPG_EXCLUDE = [
  'https://eversabz.com/admin/login',
  'https://eversabz.com/login',
  'https://eversabz.com/process-login',
  'https://eversabz.com/info',
  'https://eversabz.com/dashboard',
  'https://eversabz.com/profile',
  'https://eversabz.com/list-business-products',
  'https://eversabz.com/business/products/create',
  'https://eversabz.com/enquiries/business',
  'https://eversabz.com/wishlist/list',
  'https://eversabz.com/ngo-address-info',
  'https://eversabz.com/ngo-other-info',
  'https://eversabz.com/ngo-social-info',
  'https://eversabz.com/ngo-info',
  'https://eversabz.com/ngo-team-members',
  'https://eversabz.com/fundraising',
  'https://eversabz.com/fundraising/create',
  'https://eversabz.com/billing-info',
  'https://eversabz.com/shipping-info',
  'https://eversabz.com/basic-info',
  'https://eversabz.com/ad-post',
  'https://eversabz.com/ad-post/create',
  'https://eversabz.com/user-events-list',
  'https://eversabz.com/user-event-add',
  'https://eversabz.com/logout',
  'https://eversabz.com/cart',
  'https://eversabz.com/checkout',
  'https://eversabz.com/delete-account',
  'https://eversabz.com/professionals',
  'https://eversabz.com/business/'
];

const OPG_EXCLUDE_PREFIX = [
  'https://eversabz.com/fundraising-support/',
  'https://eversabz.com/fundraising-details/',
];

self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});

self.addEventListener('install', async (e) => {
  e.waitUntil(
    caches.open(CA).then((cache) => cache.addAll(OPG))
  );
});

if (workbox.navigationPreload.isSupported()) {
  workbox.navigationPreload.enable();
}

function isExcludedUrl(url) {
  const fullUrl = url.href;
  if (OPG_EXCLUDE.includes(fullUrl)) {
    return true;
  }
  if (OPG_EXCLUDE_PREFIX.some(prefix => fullUrl.startsWith(prefix))) {
    return true;
  }
  if (fullUrl.includes('/fundraising-support/')) {
    return true;
  }
  return false;
}

workbox.routing.registerRoute(
  ({ url, request }) => {
    const fullUrl = url.href;
    return url.origin === 'https://eversabz.com' && 
           (fullUrl.includes('/fundraising-support/') || 
            url.pathname.startsWith('/fundraising-support/'));
  },
  new workbox.strategies.NetworkOnly(),
  'GET'
);

workbox.routing.registerRoute(
  ({ url }) => {
    const fullUrl = url.href;
    const shouldExclude = OPG_EXCLUDE.includes(fullUrl) || 
                         OPG_EXCLUDE_PREFIX.some(prefix => fullUrl.startsWith(prefix));
    return url.origin === 'https://eversabz.com' && shouldExclude;
  },
  new workbox.strategies.NetworkOnly(),
  'GET'
);

workbox.routing.registerRoute(
  ({ url }) => {
    const fullUrl = url.href;
    const shouldCache = url.origin === 'https://eversabz.com' && 
                       !isExcludedUrl(url);
    return shouldCache;
  },
  new workbox.strategies.StaleWhileRevalidate({
    cacheName: CA,
    plugins: [
      new workbox.expiration.ExpirationPlugin({
        maxEntries: 50,
        maxAgeSeconds: 24 * 60 * 60, 
      }),
    ],
  }),
  'GET'
);

workbox.routing.setDefaultHandler(
  new workbox.strategies.NetworkOnly()
);

self.addEventListener('activate', (event) => {
  const currentCaches = [CA];
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (!currentCaches.includes(cacheName)) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});

self.addEventListener('fetch', (event) => {
  const url = new URL(event.request.url);
  if (url.origin === 'https://eversabz.com' && url.pathname.includes('fundraising-support')) {
  }
});
