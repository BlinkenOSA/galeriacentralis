(function (root, factory) {
  if ( typeof define === 'function' && define.amd ) {
    define([], factory(root));
  } else if ( typeof exports === 'object' ) {
    module.exports = factory(root);
  } else {
    root.breakPoint = factory(root);
  }
})(typeof global !== "undefined" ? global : this.window || this.global, function (root) {
  'use strict';
  
  var breakPoint = {};

  breakPoint.before = window.getComputedStyle(document.body, ':before');
  breakPoint.get = () => {
   return breakPoint.before.fontFamily;
  };

  breakPoint.isMobile = () => {
    let screen = breakPoint.get();
    let mobile = ['xs', 'small', 'medium'];
    return mobile.indexOf(screen) > -1;
  };

  return breakPoint;
});