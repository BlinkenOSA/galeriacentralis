(function (root, factory) {
  if ( typeof define === 'function' && define.amd ) {
    define([], factory(root));
  } else if ( typeof exports === 'object' ) {
    module.exports = factory(root);
  } else {
    root.myPlugin = factory(root); // @todo rename plugin
  }
})(typeof global !== "undefined" ? global : this.window || this.global, function (root) {
  'use strict';

  var myPlugin = {};
  var supports = !!document.querySelector && !!root.addEventListener;
  var settings;
  var defaults = {
  };
  
  function forEach(collection, callback, scope) {
    if (Object.prototype.toString.call(collection) === '[object Object]') {
      for (var prop in collection) {
        if (Object.prototype.hasOwnProperty.call(collection, prop)) {
          callback.call(scope, collection[prop], prop, collection);
        }
      }
    } else {
      for (var i = 0, len = collection.length; i < len; i++) {
        callback.call(scope, collection[i], i, collection);
      }
    }
  };
  function extend( defaults, options ) {
    var extended = {};
    forEach(defaults, function (value, prop) {
      extended[prop] = defaults[prop];
    });
    forEach(options, function (value, prop) {
      extended[prop] = options[prop];
    });
    return extended;
  };

  myPlugin.destroy = function() {
    if ( !settings ) return;
    document.documentElement.classList.remove( settings.initClass );
    // @todo Undo any other init functions...
    document.removeEventListener('click', eventHandler, false);
    settings = null;
  };
  myPlugin.init = function(options) {
    if ( !supports ) return;
    myPlugin.destroy();
    settings = extend( defaults, options || {} );
    document.documentElement.classList.add( settings.initClass );
    // @todo Do something...
  };

  return myPlugin;
});