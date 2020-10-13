(function (root, factory) {
  if ( typeof define === 'function' && define.amd ) {
    define([], factory(root));
  } else if ( typeof exports === 'object' ) {
    module.exports = factory(root);
  } else {
    root.cookie = factory(root); // @todo rename plugin
  }
})(typeof global !== "undefined" ? global : this.window || this.global, function (root) {
  'use strict';
  const cookie = {};
  cookie.set = (cname, cvalue, exdays) => {
      let d = new Date();
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
      let expires = "expires="+d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  };
  cookie.get =  (cname) => {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }
  cookie.clearAll = () => {
    let cookies = document.cookie.split(";");
    for (let i = 0; i < cookies.length; i++) {
      let cookie = cookies[i];
      let eqPos = cookie.indexOf("=");
      let name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
      this.set(name, "", new Date(0));
    }
  }
  cookie.clear = (cname) => {
    let d = new Date();
    d.setTime(d.getTime() - 1000);
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + " " + ";" + expires + ";path=/";
  }

  return cookie;
});