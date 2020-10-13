(function (root, factory) {
  if ( typeof define === 'function' && define.amd ) {
    define([], factory(root));
  } else if ( typeof exports === 'object' ) {
    module.exports = factory(root);
  } else {
    root.lazyLoad = factory(root);
  }
})(typeof global !== "undefined" ? global : this.window || this.global, function (root) {
  'use strict';

  var lazyLoad = {};

  lazyLoad.objects = document.getElementsByClassName('asyncImage');

  lazyLoad.init = function() {
    Array.from(lazyLoad.objects).map((item) => {
      const img = new Image();
      img.src = item.dataset.src;
      img.onload = () => {
        item.classList.remove('asyncImage');
        //return item.nodeName === 'IMG' ? item.src = item.dataset.src : item.style.backgroundImage = `url(${item.dataset.src})`;
        if (item.nodeName === 'IMG') {
          item.src = item.dataset.src;
        }
        if (item.style.backgroundImage) {
          item.style.backgroundImage = `url(${item.dataset.src})`;
        }
        item.removeAttribute('data-src');
      };
    });
  }
  
  return lazyLoad;
});
