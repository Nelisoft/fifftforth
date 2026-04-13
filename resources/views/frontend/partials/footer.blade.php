    <!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '6d90462125303ac1f3f2496b8f105297a6cfdeef';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>

    <footer id="colophon" class="site-footer">
      <div class="container">
        <div style="display: grid; place-items: center">
          <img src="{{ $settings && $settings->logo ? asset('public/storage/' . $settings->logo) : asset('assets/img/default-logo.png') }}" alt="logo" style="height: 35px; width: auto" />
        </div>
        <ul class="footer_menu">
          <li class="footer_menu__item active"><a href="{{ route('home') }}">Home</a></li>
          <li class="footer_menu__item"><a href="{{ route('home') }}">About Us</a></li>
          <li class="footer_menu__item"><a href="{{ route('contact') }}">Contacts</a></li>
          <li class="footer_menu__item"><a href="{{ route('faq') }}">FAQ</a></li>
        </ul>
      </div>
    </footer>