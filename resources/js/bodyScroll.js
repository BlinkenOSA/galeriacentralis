(function (root, factory) {
  if ( typeof define === 'function' && define.amd ) {
    define([], factory(root));
  } else if ( typeof exports === 'object' ) {
    module.exports = factory(root);
  } else {
    root.bodyScroll = factory(root);
  }
})(typeof global !== "undefined" ? global : this.window || this.global, function (root) {
  'use strict';

  var bodyScroll = {};
  var y = 0;

  bodyScroll.lock = () => {
    y = window.scrollY;
    document.body.classList.add('noscroll');
    document.body.style.top = - y + 'px';
  };

  bodyScroll.unlock = () => {
    document.body.classList.remove('noscroll');
    window.scrollTo(0, y);
    document.body.style.top = '';
  };
  
  return bodyScroll;
});