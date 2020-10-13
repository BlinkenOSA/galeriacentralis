var Parallax = function(selector) {
  let self = Object.create(Parallax.prototype);
  let loopId = null;
  let pos = 0;
  let screen = 0;
  var items = [];
  let pause = true;
  var elems = document.querySelectorAll(selector);

  const loop = window.requestAnimationFrame ||
    window.webkitRequestAnimationFrame ||
    window.mozRequestAnimationFrame ||
    window.msRequestAnimationFrame ||
    window.oRequestAnimationFrame ||
    function(callback){ return setTimeout(callback, 1000 / 60); };

  const transformProp = window.transformProp || (function(){
    var testEl = document.createElement('div');
    if (testEl.style.transform === null) {
      var vendors = ['Webkit', 'Moz', 'ms'];
      for (var vendor in vendors) {
        if (testEl.style[ vendors[vendor] + 'Transform' ] !== undefined) {
          return vendors[vendor] + 'Transform';
        }
      }
    }
    return 'transform';
  })();

  const init = () => {
    screen = window.innerHeight;

    setPos();

    for (var i = 0; i < elems.length; i++) {
      let item = {
        el: elems[i],
        speed: elems[i].getAttribute('data-parallax') ? elems[i].getAttribute('data-parallax') : 3,
        height: elems[i].offsetHeight,
        top: elems[i].getBoundingClientRect().top + pos
      };
      items.push(item);
    }

    animate();

    if (pause) {
      window.addEventListener('resize', init);
      pause = false;
      update();
    }

    
  };

  const setPos = () => {
    let old = pos;
    pos = document.documentElement.scrollTop;
    if (old != pos) {
      return true
    }
    return false;
  };

  const deferredUpdate = () => {
    window.removeEventListener('resize', deferredUpdate);
    window.removeEventListener('orientationchange', deferredUpdate);
    window.removeEventListener('scroll', deferredUpdate);
    window.removeEventListener('wheel', deferredUpdate);
    document.removeEventListener('touchmove', deferredUpdate);

    loopId = loop(update);

  };

  const update = () => {
    if (setPos()) {
      animate();
      loopId = loop(update);
    } else {
      loopId = null;
      window.addEventListener('resize', deferredUpdate);
      window.addEventListener('orientationchange', deferredUpdate);
      window.addEventListener('scroll', deferredUpdate, { passive: true });
      window.addEventListener('wheel', deferredUpdate, { passive: true });
      document.addEventListener('touchmove', deferredUpdate, { passive: true });
    }
  };

  const animate = () => {
    for (let i = items.length - 1; i >= 0; i--) {
      let item = items[i];
      let mult = item.top < screen ? (pos/(item.top + item.height)) : (pos - item.top + screen)/(item.height+screen);
      item.el.style[transformProp] = 'translate3d(0px,' + 1/item.speed*item.height*mult + 'px, 0px)';
    }
  };

  init();

  return self;
};

export default Parallax;