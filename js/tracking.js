// Enhanced consent‑based tracking loader with localStorage persistence
(function(){
  // IDs used in the HTML banner
  var consentBanner = document.getElementById('cookie-consent');
  var acceptBtn = document.getElementById('accept-cookies');
  var declineBtn = document.getElementById('decline-cookies');

  // Function that actually injects the analytics scripts
  function loadAnalytics(){
    // Load GA4 if ID is set
    if(window.GA_MEASUREMENT_ID){
      var gaScript = document.createElement('script');
      gaScript.async = true;
      gaScript.src = 'https://www.googletagmanager.com/gtag/js?id=' + window.GA_MEASUREMENT_ID;
      document.head.appendChild(gaScript);
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', window.GA_MEASUREMENT_ID);
    }
    // Load Meta Pixel if ID is set
    if(window.META_PIXEL_ID){
      !function(f,b,e,v,n,t,s){
        if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', window.META_PIXEL_ID);
      fbq('track', 'PageView');
    }
  }

  // ----- Consent handling -----
  var consent = localStorage.getItem('cookie_consent');
  if(consent=== 'accepted'){
    if(consentBanner) consentBanner.style.display='none';
    loadAnalytics();
  } else if(consent=== 'declined'){
    if(consentBanner) consentBanner.style.display='none';
    // do nothing – no tracking
  } else {
    // consent not set – show banner (default is visible in HTML)
    if(consentBanner) consentBanner.style.display='flex';
  }

  if(acceptBtn){
    acceptBtn.addEventListener('click', function(){
      localStorage.setItem('cookie_consent', 'accepted');
      if(consentBanner) consentBanner.style.display='none';
      loadAnalytics();
    });
  }
  if(declineBtn){
    declineBtn.addEventListener('click', function(){
      localStorage.setItem('cookie_consent', 'declined');
      if(consentBanner) consentBanner.style.display='none';
      // No tracking loaded
    });
  }
})();
