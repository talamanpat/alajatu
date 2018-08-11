var products = new Array();
    var step = 1;

    
$(function() {

//------------atributes----------------------
    var cart = $("#cart");
    var time = 1200;
    var timer = null;
//------------functions----------------------
    function countProducts(pId) {
        return products.filter(function(value) {
            return value === pId;
        }).length;
        ;
    }

    function getProduct(ch)
    {
        this.o = ch.parent();
        this.id = this.o.attr('id');
        this.badge = this.o.find(".productBadge");
        this.content = this.o.find(".productContent");
        this.minus = this.o.find(".productMinus");
        this.c = function() {
            return countProducts(this.id);
        };
    }


    function getCart()
    {
        clearTimeout(timer);
        console.log("cart solicited");
        console.log(products);
        cart.html("<h2>Procesando carro...</h2>");

        timer = setTimeout(function()
        {
            $.ajax({
                type: "POST",
                url: "getCart",
                data: {p: products},
                beforeSend: function() {
                    console.log("Requesting cart");
                    console.log(products);
                }

            }).done(function(m) {
                console.log("Got car");
                cart.html(m);
                toggleHelp();
                refreshScriptButtons();
            }).fail(function(m) {
                cart.html("ERROR: " + m);
            });
        }, time);
    }
    
    function toggleHelp(){
        if($('#cart').height()>400 && $(window).width()>900){
            $('article#step1 header').fadeOut();
        }else{
            $('article#step1 header').fadeIn();            
        }
    }

    function refreshScriptButtons() {
        showCorrectButton();
        $('button.next2').click(function() {
            showStep2();
        });

        $('button.previous1').click(function() {
            showStep1();
        });
    }
    function showStep2() {
        $('article#step1').hide();
        $('article#step2').show();
        document.location.href = "#step2";
        step = 2;
        showCorrectButton();
    }
    function showStep1() {
        $('article#step2').hide();
        $('article#step1').show();
        document.location.href = "#step1";
        step = 1;
        showCorrectButton();
    }
//        function showStep2() {
//        $('article#step1').fadeOut();
//        $('article#step2').fadeIn("slow",function(){
//            
//        document.location.href = "#step2";
//        });
//        step = 2;
//        showCorrectButton();
//    }
//    function showStep1() {
//        $('article#step2').fadeOut();
//        $('article#step1').fadeIn("slow",function(){
//            
//        document.location.href = "#step1";
//        });
//        step = 1;
//        showCorrectButton();
//    }
    


    function showCorrectButton() {
        if (step == 1) {
            $('button.next2').show();
            $('button.previous1').hide();

        } else if (step == 2) {
            $('button.previous1').show();
            $('button.next2').hide();
        }
    }




//------------events----------------------

    $("div.productContent").click(function() {
        var p = new getProduct($(this));
        products.push(p.id);
        p.content.addClass("productContent2");
        p.minus.show();
        p.badge.fadeIn();
        p.badge.html(p.c());
        getCart();
    });

    $("div.productMinus").click(function() {
        var p = new getProduct($(this));
        var i = products.indexOf(p.id);
        if (i !== -1)
            products.splice(i, 1);
        p.badge.html(p.c());
        if (p.c() === 0) {
            p.minus.hide();
            p.badge.fadeOut();
            p.content.removeClass("productContent2");
        }
        getCart();
    });


    $('div.product').hover(function() {
        $(this).css('cursor', 'pointer');
    });

    $("a.infoGeneral").click(function() {
        alert("Horarios: Martes a domingo de 18 a 23 hrs.\n\
Formas de Pago: Efectivo (próximamente transbank).\n\
Desapcho: Sólo delivery.")
    });


});
