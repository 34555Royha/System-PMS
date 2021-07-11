//  $(document).ready(function() {
//   $('#sidebarToggle').on('click', function() {
//     //   alert('hi');
//     $('#layoutSidenav_nav').slideToggle();
//   });
// });

/*!
    * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);

$( "#price" ).keyup(function() {
    var unitprice = document.getElementById("price").value;
    var discount = document.getElementById("discount").value;
    var qty = document.getElementById("qty").value;

    var price = unitprice * qty;

    var discount = price * discount / 100;
    var payment = price - discount;
    document.getElementById("total").value = payment + "$";
    document.getElementById("totals").value = payment + "$";
  });

  $( "#qty" ).keyup(function() {
    var unitprice = document.getElementById("price").value;
    var discount = document.getElementById("discount").value;
    var qty = document.getElementById("qty").value;

    var price = unitprice * qty;

    var discount = price * discount / 100;
    var payment = price - discount;
    document.getElementById("total").value = payment + "$";
    document.getElementById("totals").value = payment + "$";
  });

  $( "#discount" ).keyup(function() {
    var unitprice = document.getElementById("price").value;
    var discount = document.getElementById("discount").value;
    var qty = document.getElementById("qty").value;

    var price = unitprice * qty;

    var discount = price * discount / 100;
    var payment = price - discount;
    document.getElementById("total").value = payment + "$";
    document.getElementById("totals").value = payment + "$";
  });


  $('#product_id').on('change', function() {

    var pdprice = $(this).find('option:selected').attr("pdprice");
    var pddiscount = $(this).find('option:selected').attr("pddiscount");
    
    document.getElementById("price").value = pdprice;
    document.getElementById("discount").value = pddiscount;

    document.getElementById("prices").value = pdprice;
    document.getElementById("discounts").value = pddiscount;

    var unitprice = document.getElementById("price").value;
    var discount = document.getElementById("discount").value;
    var qty = document.getElementById("qty").value;

    var price = unitprice * qty;

    var discount = price * discount / 100;
    var payment = price - discount;
    document.getElementById("total").value = payment + "$";
    document.getElementById("totals").value = payment + "$";
  });


// get value dropdown 
  $(document).ready(function () {
        var  categoryId = $('#categories').attr("categoryId");
        $('#category_id option[value="'+ categoryId +'"]').attr('selected','selected')
        var  Sex = $('#sex').attr("Sex");
        $('#sex option[value="'+ Sex +'"]').attr('selected','selected')
        var  employee_id = $('#employee_id').attr("employee_id");
        $('#employee_id option[value="'+ employee_id +'"]').attr('selected','selected')
        var  customer_id = $('#customer_id').attr("customer_id");
        $('#customer_id option[value="'+ customer_id +'"]').attr('selected','selected')
        var  product_id = $('#product_id').attr("product_id");
        $('#product_id option[value="'+ product_id +'"]').attr('selected','selected')
        var  invoice_id = $('#invoice_id').attr("invoice_id");
        $('#invoice_id option[value="'+ invoice_id +'"]').attr('selected','selected')
    
      });