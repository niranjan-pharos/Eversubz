// Import Workbox
importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.5.4/workbox-sw.js');

// Cache version
const CACHE_VERSION = "cache-v3.8";

// Static assets to precache
const STATIC_ASSETS = [
    // Core pages
    'https://eversabz.com/offline',
    'https://eversabz.com/contactus',
    
    // Images
    'https://eversabz.com/main_assets/images/favicon.png',
    'https://eversabz.com/storage/placeholder-image.webp',
    'https://eversabz.com/assets/images/icons/spriticon.png',
    'https://eversabz.com/assets/images/icons/spriticoncategory.png',
    
    // JavaScript libraries
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
    
    // CSS stylesheets
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
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.2/css/fileinput.min.css'
];

// URLs that should never be cached (exact matches)
const EXCLUDED_URLS = [
    // Authentication & Login
    'https://eversabz.com/admin/login',
    'https://eversabz.com/login',
    'https://eversabz.com/process-login',
    'https://eversabz.com/logout',
    
    // User Dashboard & Profile
    'https://eversabz.com/info',
    'https://eversabz.com/dashboard',
    'https://eversabz.com/profile',
    'https://eversabz.com/basic-info',
    'https://eversabz.com/billing-info',
    'https://eversabz.com/shipping-info',
    'https://eversabz.com/delete-account',
    
    // Business Management
    'https://eversabz.com/list-business-products',
    'https://eversabz.com/business/products/create',
    'https://eversabz.com/enquiries/business',
    'https://eversabz.com/professionals',
    
    // NGO Management
    'https://eversabz.com/ngo-address-info',
    'https://eversabz.com/ngo-other-info',
    'https://eversabz.com/ngo-social-info',
    'https://eversabz.com/ngo-info',
    'https://eversabz.com/ngo-team-members',
    
    // Fundraising
    'https://eversabz.com/fundraising',
    'https://eversabz.com/fundraising/create',
    
    // Wishlist & Cart
    'https://eversabz.com/wishlist/list',
    'https://eversabz.com/cart',
    'https://eversabz.com/checkout',
    
    // Ads & Events
    'https://eversabz.com/ad-post',
    'https://eversabz.com/ad-post/create',
    'https://eversabz.com/user-events-list',
    'https://eversabz.com/user-event-add',
    
    // sabz-future URL
    'https://eversabz.com/sabz-future'
];

// URL prefixes that should never be cached
const EXCLUDED_PREFIXES = [
    'https://eversabz.com/fundraising-support/',
    'https://eversabz.com/fundraising-details/',
    'https://eversabz.com/business/',
    'https://eversabz.com/admin/',
    'https://eversabz.com/api/'
];

// Helper function to check if URL should be excluded from caching
function shouldExcludeFromCache(url) {
    const fullUrl = url.href;
    
    // Check exact URL matches
    if (EXCLUDED_URLS.includes(fullUrl)) {
        return true;
    }
    
    // Check URL prefixes
    if (EXCLUDED_PREFIXES.some(prefix => fullUrl.startsWith(prefix))) {
        return true;
    }
    
    // Additional checks for query parameters that indicate dynamic content
    if (url.searchParams.has('token') || 
        url.searchParams.has('session') || 
        url.searchParams.has('auth')) {
        return true;
    }
    
    return false;
}

// Enable navigation preload if supported
if (workbox.navigationPreload.isSupported()) {
    workbox.navigationPreload.enable();
}

// Service Worker Event Listeners
self.addEventListener('message', (event) => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
});

// Install event - precache static assets
self.addEventListener('install', (event) => {
    console.log('Service Worker installing...');
    event.waitUntil(
        caches.open(CACHE_VERSION)
            .then(cache => {
                console.log('Precaching static assets');
                return cache.addAll(STATIC_ASSETS);
            })
            .catch(error => {
                console.error('Precaching failed:', error);
            })
    );
});

// Activate event - cleanup old caches
self.addEventListener('activate', (event) => {
    console.log('Service Worker activating...');
    const currentCaches = [CACHE_VERSION];
    
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (!currentCaches.includes(cacheName)) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => {
            console.log('Service Worker activated');
            return self.clients.claim();
        })
    );
});

// Workbox Routing Strategies

// 1. Route for excluded URLs - Always use network
workbox.routing.registerRoute(
    ({ url }) => {
        return url.origin === 'https://eversabz.com' && shouldExcludeFromCache(url);
    },
    new workbox.strategies.NetworkOnly({
        plugins: [{
            requestWillFetch: async ({ request }) => {
                console.log('Network-only request:', request.url);
                return request;
            }
        }]
    }),
    'GET'
);

// 2. Route for API endpoints - Always use network with timeout
workbox.routing.registerRoute(
    ({ url }) => url.pathname.startsWith('/api/'),
    new workbox.strategies.NetworkOnly({
        networkTimeoutSeconds: 10,
        plugins: [{
            requestDidFail: async () => {
                console.log('API request failed');
            }
        }]
    })
);

// 3. Route for images - Cache first with fallback
workbox.routing.registerRoute(
    ({ request }) => request.destination === 'image',
    new workbox.strategies.CacheFirst({
        cacheName: 'images-cache',
        plugins: [
            new workbox.expiration.ExpirationPlugin({
                maxEntries: 100,
                maxAgeSeconds: 7 * 24 * 60 * 60, // 7 days
                purgeOnQuotaError: true
            }),
            new workbox.cacheableResponse.CacheableResponsePlugin({
                statuses: [0, 200]
            })
        ]
    })
);

// 4. Route for CSS and JS files - Stale while revalidate
workbox.routing.registerRoute(
    ({ request }) => 
        request.destination === 'style' || 
        request.destination === 'script',
    new workbox.strategies.StaleWhileRevalidate({
        cacheName: 'static-resources',
        plugins: [
            new workbox.expiration.ExpirationPlugin({
                maxEntries: 50,
                maxAgeSeconds: 24 * 60 * 60, // 24 hours
                purgeOnQuotaError: true
            })
        ]
    })
);

// 5. Route for HTML pages - Network first with cache fallback
workbox.routing.registerRoute(
    ({ url, request }) => {
        return url.origin === 'https://eversabz.com' && 
               request.destination === 'document' &&
               !shouldExcludeFromCache(url);
    },
    new workbox.strategies.NetworkFirst({
        cacheName: 'pages-cache',
        networkTimeoutSeconds: 5,
        plugins: [
            new workbox.expiration.ExpirationPlugin({
                maxEntries: 30,
                maxAgeSeconds: 12 * 60 * 60, // 12 hours
                purgeOnQuotaError: true
            }),
            new workbox.cacheableResponse.CacheableResponsePlugin({
                statuses: [0, 200]
            })
        ]
    })
);

// 6. Route for other same-origin requests - Stale while revalidate
workbox.routing.registerRoute(
    ({ url }) => {
        return url.origin === 'https://eversabz.com' && !shouldExcludeFromCache(url);
    },
    new workbox.strategies.StaleWhileRevalidate({
        cacheName: CACHE_VERSION,
        plugins: [
            new workbox.expiration.ExpirationPlugin({
                maxEntries: 100,
                maxAgeSeconds: 24 * 60 * 60, // 24 hours
                purgeOnQuotaError: true
            })
        ]
    }),
    'GET'
);

// Default handler for all other requests
workbox.routing.setDefaultHandler(
    new workbox.strategies.NetworkOnly({
        plugins: [{
            requestWillFetch: async ({ request }) => {
                console.log('Default handler - Network request:', request.url);
                return request;
            }
        }]
    })
);

// Offline fallback
workbox.routing.setCatchHandler(({ event }) => {
    switch (event.request.destination) {
        case 'document':
            return caches.match('/offline');
        case 'image':
            return caches.match('/storage/placeholder-image.webp');
        default:
            return Response.error();
    }
});

// Background sync for failed requests
if (workbox.backgroundSync.isSupported()) {
    const bgSyncPlugin = new workbox.backgroundSync.BackgroundSyncPlugin('failed-requests', {
        maxRetentionTime: 24 * 60 // 24 hours
    });

    workbox.routing.registerRoute(
        ({ url }) => url.pathname.startsWith('/api/'),
        new workbox.strategies.NetworkOnly({
            plugins: [bgSyncPlugin]
        }),
        'POST'
    );
}

// Performance monitoring
self.addEventListener('fetch', (event) => {
    // Log performance metrics for debugging
    if (event.request.url.includes('eversabz.com')) {
        console.log('Fetch event for:', event.request.url);
    }
});

console.log('Service Worker loaded successfully');
