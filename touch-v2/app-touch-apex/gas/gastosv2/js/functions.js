function createLineGasMid(el1, el2) {
  var off1 = getElementProperty(el1);
  var off2 = getElementProperty(el2);
  // center of first point
  var dx1 = off1.left + off1.width / 2;
  var dy1 = off1.top + off1.height / 2;
  // center of second point
  var dx2 = off2.left + off2.width / 2;
  var dy2 = off2.top + off1.height / 2;
  // distance
  var length = Math.sqrt((dx2 - dx1) * (dx2 - dx1) + (dy2 - dy1) * (dy2 - dy1));
  // center
  var cx = (dx1 + dx2) / 2 - length / 2;
  var cy = (dy1 + dy2) / 2 - 2 / 2;
  // angle
  var angle = Math.atan2(dy1 - dy2, dx1 - dx2) * (180 / Math.PI);
  // draw line

  return (
    "<section class='connectingLinesYellow' style='left:" +
    cx +
    "px; top:" +
    cy +
    "px; width:" +
    length +
    "px; -webkit-transform:rotate(" +
    angle +
    "deg); transform:rotate(" +
    angle +
    "deg);'></section>"
  );
}

function createLineMid(el1, el2) {
  var off1 = getElementProperty(el1);
  var off2 = getElementProperty(el2);
  // center of first point
  var dx1 = off1.left + off1.width / 2;
  var dy1 = off1.top + off1.height / 2;
  // center of second point
  var dx2 = off2.left + off2.width / 2;
  var dy2 = off2.top + off1.height / 2;
  // distance
  var length = Math.sqrt((dx2 - dx1) * (dx2 - dx1) + (dy2 - dy1) * (dy2 - dy1));
  // center
  var cx = (dx1 + dx2) / 2 - length / 2;
  var cy = (dy1 + dy2) / 2 - 2 / 2;
  // angle
  var angle = Math.atan2(dy1 - dy2, dx1 - dx2) * (180 / Math.PI);
  // draw line

  return (
    "<section class='connectingLinesWhite' style='left:" +
    cx +
    "px; top:" +
    cy +
    "px; width:" +
    length +
    "px; -webkit-transform:rotate(" +
    angle +
    "deg); transform:rotate(" +
    angle +
    "deg);'></section>"
  );
}

function getElementProperty(el) {
  var dx = 0;
  var dy = 0;
  var width = el.width() | 0;
  var height = el.height() | 0;

  dx += el.position().left;
  dy += el.position().top;

  return {
    top: dy,
    left: dx,
    width: width,
    height: height,
  };
}

function buttonAnimate(href) {
  //Get position
  var button = $(this);
  var width = button.width();
  var height = button.height();
  //If button is not :animated
  if (!button.is(":animated")) {
    $(this).animate(
      {
        width: "+=10px",
        height: "+=10px",
      },
      400,
      function () {
        $(this).animate(
          {
            width: "-=10px",
            height: "-=10px",
          },
          400
        );
      }
    );
  }
  setTimeout(function () {
    window.location.href = href;
  }, 875);
}
