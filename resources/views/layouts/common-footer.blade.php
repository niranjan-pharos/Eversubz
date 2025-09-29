<script>const reg = (e)=>navigator.serviceWorker.register(e).catch((e) => {});
    ('serviceWorker' in navigator) ? reg('https://eversabz.com/appSW.js'): console.log('not supported')</script>