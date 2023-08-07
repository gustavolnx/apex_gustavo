$(document).ready(function () {
  //Get number of columns
  var columns = $(".column").length;
  var maxWidth = 95 / columns;
  console.log(maxWidth, columns);
  //For loop
  for (let index = 0; index < columns; index++) {
    //Set width
    $(".column-" + index).css("width", maxWidth + "%");
  }
  //Get max dots
  var max = $(".max");
  for (let index = 0; index < max.length - 1; index++) {
    // console.log(max[index].style.top);
    el1 = $(max[index]);
    el2 = $(max[index + 1]);

    var off1 = getElementProperty(el1);
    var off2 = getElementProperty(el2);
    // console.log(off1, '|', off2);

    // center of first point
    var dx1 = off1.left + off1.width / 2;
    var dy1 = off1.top + off1.height / 2;
    // console.log(dx1, '|', dy1);

    // center of second point
    var dx2 = off2.left + off2.width / 2;
    var dy2 = off2.top + off1.height / 2;
    // console.log(dx2, '|', dy2);

    // distance
    var length = Math.sqrt(
      (dx2 - dx1) * (dx2 - dx1) + (dy2 - dy1) * (dy2 - dy1)
    );
    // console.log(length);

    // center
    var cx = (dx1 + dx2) / 2 - length / 2;
    var cy = (dy1 + dy2) / 2 - 2 / 2;
    // console.log(cx, '|', cy);

    // angle
    var angle = Math.atan2(dy1 - dy2, dx1 - dx2) * (180 / Math.PI);
    // console.log(angle);
    // // if (index > minday - 2 && index < maxday - 1) {
    $(".column-" + index).append(
      "<section class='connectingLinesGreen line-" +
        index +
        "' style='left:" +
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
    // // }
  }

  //Get mid dots
  var min = $(".min");
  for (let index = 0; index < min.length - 1; index++) {
    // console.log(max[index].style.top);
    el1 = $(min[index]);
    el2 = $(min[index + 1]);

    var off1 = getElementProperty(el1);
    var off2 = getElementProperty(el2);
    // console.log(off1, '|', off2);

    // center of first point
    var dx1 = off1.left + off1.width / 2;
    var dy1 = off1.top + off1.height / 2;
    // console.log(dx1, '|', dy1);

    // center of second point
    var dx2 = off2.left + off2.width / 2;
    var dy2 = off2.top + off1.height / 2;
    // console.log(dx2, '|', dy2);

    // distance
    var length = Math.sqrt(
      (dx2 - dx1) * (dx2 - dx1) + (dy2 - dy1) * (dy2 - dy1)
    );
    // console.log(length);

    // center
    var cx = (dx1 + dx2) / 2 - length / 2;
    var cy = (dy1 + dy2) / 2 - 2 / 2;
    // console.log(cx, '|', cy);

    // angle
    var angle = Math.atan2(dy1 - dy2, dx1 - dx2) * (180 / Math.PI);
    // console.log(angle);

    // Append line to column
    // // if (index > minday - 2 && index < maxday - 1) {
    $(".column-" + index).append(
      "<section class='connectingLinesRed line-" +
        index +
        "' style='left:" +
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
    // // }
  }

  //Get mid dots
  var min = $(".midcon");
  for (let index = 0; index < min.length - 1; index++) {
    // console.log(max[index].style.top);
    el1 = $(min[index]);
    el2 = $(min[index + 1]);

    var off1 = getElementProperty(el1);
    var off2 = getElementProperty(el2);
    // console.log(off1, '|', off2);

    // center of first point
    var dx1 = off1.left + off1.width / 2;
    var dy1 = off1.top + off1.height / 2;
    // console.log(dx1, '|', dy1);

    // center of second point
    var dx2 = off2.left + off2.width / 2;
    var dy2 = off2.top + off1.height / 2;
    // console.log(dx2, '|', dy2);

    // distance
    var length = Math.sqrt(
      (dx2 - dx1) * (dx2 - dx1) + (dy2 - dy1) * (dy2 - dy1)
    );
    // console.log(length);

    // center
    var cx = (dx1 + dx2) / 2 - length / 2;
    var cy = (dy1 + dy2) / 2 - 2 / 2;
    // console.log(cx, '|', cy);

    // angle
    var angle = Math.atan2(dy1 - dy2, dx1 - dx2) * (180 / Math.PI);
    // console.log(angle);

    // Append line to column
    // // if (index > minday - 2 && index < maxday - 1) {
    $(".column-" + index).append(
      "<section class='connectingLinesMidcon line-" +
        index +
        "' style='left:" +
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
    // // }
  }

  //Get all .mid that is visible
  var dot = $(".mid:visible");
  // console.log(dot);
  //For each dot
  for (let index = 0; index < dot.length - 1; index++) {
    el1 = $(dot[index]);
    el2 = $(dot[index + 1]);

    line = createLineMid(el1, el2);

    //Get element classes
    var classes = el1.attr("class").split(" ");
    var column = classes[2].split("-")[1];

    //Append line to column
    $(".column-" + column).append(line);
  }
});
