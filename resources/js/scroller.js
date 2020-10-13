(function (root, factory) {
  if ( typeof define === 'function' && define.amd ) {
    define([], factory(root));
  } else if ( typeof exports === 'object' ) {
    module.exports = factory(root);
  } else {
    root.scroller = factory(root);
  }
})(typeof global !== "undefined" ? global : this.window || this.global, function (root) {
  'use strict';

  var scroller = {};

  scroller.scroll = (destination, duration) => {
    destination = destination + window.innerHeight >= document.body.offsetHeight ? document.body.offsetHeight - window.innerHeight : destination;

    var from = window.scrollY,
      thisStep = 0,
      interval = 15,
      stepSize = 1 / Math.round( duration / interval ),
      difference = Math.abs(destination - from),
      easing = function (t) { return t<.5 ? 8*t*t*t*t : 1-8*(--t)*t*t*t },
      isPositive = true;
      (function updateScroll() {
        thisStep += 1;
        isPositive = destination > window.scrollY ? true : false;
        let newPos = isPositive ? from + difference * easing( thisStep * stepSize ) : from - difference * easing( thisStep * stepSize );
        window.scrollTo( 0, newPos );
        Math.round( newPos ) != destination ? setTimeout(updateScroll, interval) : void(0);
      })();
  };
  
  return scroller;
});