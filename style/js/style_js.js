$(window).on('load',function(){


   console.log("I'm in javascript")

   document.addEventListener('DOMContentLoaded', function() {
    M.AutoInit();
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, options);
  });

  var ingredient_num = 2
  $("#addIngredient").click(function () {
    $(".ingredients").append(`<input type="text" id="ingredient${ingredient_num}" name="ingredient${ingredient_num}" class="ingredient"/>`);
    ingredient_num++;
  });
          
        
      









})