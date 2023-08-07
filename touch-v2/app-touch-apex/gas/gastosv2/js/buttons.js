$(document).ready(function () {
  //CHEVRON BACK BTN
  $("#back_btn").click(function () {
    //History back
    window.history.back();
  });
  //GAS
  $(".btn-gas").click(function () {
    buttonAnimate.call(this, "#");
    $(".scene-3").hide(0);
    $(".scene-1").hide(0);
    $(".scene-2").fadeIn(500);
  });
  //POWER
  $(".btn-power").click(function () {
    buttonAnimate.call(this, "#");
    $(".scene-3").hide(0);
    $(".scene-2").hide(0);
    $(".scene-1").fadeIn(500);
  });
  //SPENDINGS
  $(".btn-spendings").click(function () {
    buttonAnimate.call(this, "#");
    $(".scene-1").hide(0);
    $(".scene-2").hide(0);
    $(".scene-3").fadeIn(500);
  });
  $(".scene-1").hide();
  $(".scene-2").hide();
  $(".loading").hide();
  $(".scene-3").fadeIn(500);
});
