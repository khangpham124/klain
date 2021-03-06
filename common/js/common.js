/*-----------------------------------------------------------
jquery-rollover.js
jquery-opacity-rollover.js
-------------------------------------------------------------*/

/*-----------------------------------------------------------
jquery-rollover.js　※「_on」画像を作成し、class="over"を付ければOK
-------------------------------------------------------------*/

function initRollOverImages() {
    var image_cache = new Object();
    $("img.over").each(function(i) {
        var imgsrc = this.src;
        var dot = this.src.lastIndexOf('.');
        var imgsrc_on = this.src.substr(0, dot) + '_on' + this.src.substr(dot, 4);
        image_cache[this.src] = new Image();
        image_cache[this.src].src = imgsrc_on;
        $(this).hover(
            function() { this.src = imgsrc_on; },
            function() { this.src = imgsrc; });
    });
}

$(document).ready(initRollOverImages);



$(document).ready(function(){
    $("input[data-type='number']").keyup(function(event){
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
      }
      var $this = $(this);
      var num = $this.val().replace(/,/gi, "").split("").reverse().join("");
      
      var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
      
      $(this).val(num2);
      // the following line has been simplified. Revision history contains original.
    //   mask.text(num2);
  });
});

function RemoveRougeChar(convertString){
    
    
    if(convertString.substring(0,1) == ","){
        
        return convertString.substring(1, convertString.length)            
        
    }
    return convertString;
    
}


// $('.btnSubmit').click(function() {
//     $(this).addClass('disable');
// });

function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

$('.formatNumb').on('keyup', function(e){
    
});


$('#getData').click(function() {
    $(this).addClass('disable');
});

/*-----------------------------------------------------------
jquery-opacity-rollover.js　※class="opa"を付ければOK
-------------------------------------------------------------*/

$(document).ready(function() {
    $("img.opa").fadeTo(0, 1.0);
    $("img.opa").hover(function() {
            $(this).fadeTo(200, 0.5);
        },
        function() {
            $(this).fadeTo(200, 1.0);
        });
});


$('.iconShow').click(function() {
    $('.hideSide').css('right', 0);
});

$('.iconClose').click(function() {
    $('.hideSide').css('right', '-100%');
});

function formatNumber (num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}
/*=====================================================
meta: {
  title: "jquery-opacity-rollover.js",
  version: "2.1",
  copy: "copyright 2009 h2ham (h2ham.mail@gmail.com)",
  license: "MIT License(http://www.opensource.org/licenses/mit-license.php)",
  author: "THE HAM MEDIA - http://h2ham.seesaa.net/",
  date: "2009-07-21"
  modify: "2009-07-23"
}
=====================================================*/
(function($) {

    $.fn.opOver = function(op, oa, durationp, durationa) {

            var c = {
                op: op ? op : 1.0,
                oa: oa ? oa : 0.2,
                durationp: durationp ? durationp : 'fast',
                durationa: durationa ? durationa : 'fast'
            };


            $(this).each(function() {
                $(this).css({
                    opacity: c.op,
                    filter: "alpha(opacity=" + c.op * 100 + ")"
                }).hover(function() {
                    $(this).fadeTo(c.durationp, c.oa);
                }, function() {
                    $(this).fadeTo(c.durationa, c.op);
                })
            });
        },

        $.fn.wink = function(durationp, op, oa) {

            var c = {
                durationp: durationp ? durationp : 'slow',
                op: op ? op : 1.0,
                oa: oa ? oa : 0.8
            };

            $(this).each(function() {
                $(this).css({
                    opacity: c.op,
                    filter: "alpha(opacity=" + c.op * 100 + ")"
                }).hover(function() {
                    $(this).css({
                        opacity: c.oa,
                        filter: "alpha(opacity=" + c.oa * 100 + ")"
                    });
                    $(this).fadeTo(c.durationp, c.op);
                }, function() {
                    $(this).css({
                        opacity: c.op,
                        filter: "alpha(opacity=" + c.op * 100 + ")"
                    });
                })
            });
        }

})(jQuery);