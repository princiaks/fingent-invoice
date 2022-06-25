  $(".add_more").click(function (e) {
  
    e.preventDefault;
    var html="";
    html += `<tr class="formrow">   <td> <input type="text" class="form-control" placeholder="Name" name="name[]" value="" required></td>
    <td><input type="number" class="form-control itqty" placeholder="Qty" name="quantity[]" value="0" required step="1"></td>
    <td><input type="number" class="form-control itprice" placeholder="Unit Price" name="price[]" value="0.00" required step="0.01"></td>
    <td><input type="number" class="form-control ittax" placeholder="Tax" name="tax[]" value="0" required step="0.01"></td>
    <td><input type="number" disabled class="form-control linetot" placeholder="Total" name="total[]" value="0.00" required>
    <input type="hidden" name="acttot[]" class="lineacttot" value="0.00"></td>
    <td>
   <input
   type="button"
   id="removebtn"
   name="add"
   value="-"
   class=" p-1 form-control text-white remove" style="max-width: 40px; background-color:pink"
   />
   </td></tr>`;
  $(".repeat_field").append(html);
  
  });

  $(".repeat_field").on('click', '.remove', function (e) {
    e.preventDefault;
      $(this).closest('.formrow').remove();
  });
  $(".repeat_field").on('keyup', '.itqty,.itprice,.ittax', function (e) {
    e.preventDefault();
    if($(this).val()){
      var arr = new Array(0,1,5,10);
      if($(this).hasClass('ittax'))
      {
        if ($.inArray(parseFloat($(this).val()), arr) != -1)
        {
          var tot=parseFloat($(this).closest('tr').find('.itqty').val())* parseFloat($(this).closest('tr').find('.itprice').val());
          var taxval=parseFloat(tot) * (parseFloat($(this).closest('tr').find('.ittax').val())/100);
          $(this).closest('tr').find('.linetot').val((tot+taxval).toFixed(2));
        }
        else
        {
          swal("Please enter valid tax value(eg:0,1,5,10)");
        }
      }
      else{
          var tot=parseFloat($(this).closest('tr').find('.itqty').val())* parseFloat($(this).closest('tr').find('.itprice').val());
          var taxval=parseFloat(tot) * (parseFloat($(this).closest('tr').find('.ittax').val())/100);
          $(this).closest('tr').find('.linetot').val((tot+taxval).toFixed(2));
      }
    
    }
    else
    {
      $(this).closest('tr').find('.linetot').val(0.00);
      $(this).closest('tr').find('.lineacttot').val(0.00);
    }
    });

    $('#additem').submit(function(e){
      e.preventDefault();
      var data=new FormData(this);
      ajaxcall(data,'add-item',function(data)
      {
        swaltext(data);
      });
    });

    $('#disctype').change(function(e){
      calcGrandTotal();
    })
    $(".discount").on('keyup',function(e){
      calcGrandTotal();
    });

   
    function calcGrandTotal()
    {
      var discount=0;
      var subwithtax = 0.00;
      if($('#discount').val())
      {
      discount=parseFloat($('.discount').val());  
      subwithtax= parseFloat($('#subwithtax').val());
      if($('#disctype').is(':checked'))
      {
        var calc=parseFloat((subwithtax)-(subwithtax*discount/100)).toFixed(2);
        $('.grandtotal').html(`$`+calc);
      }
      else
      {
      $('.grandtotal').html(`$`+((subwithtax)-discount).toFixed(2));
      }
      }
      else
      {
        console.log('no discount');
      }

    }





    function ajaxcall(formElem,ajaxurl,handle)
    {
      $.ajax({
        url: base_url+ajaxurl,
        type: 'POST',
        data:formElem,
        processData:false,
        contentType:false,
        cache:false,
        async:false,
        success: function(data) {
          handle(data);
        }
    });
    }

    function swaltext(data)
    {
      var data=JSON.parse(data);
      swal(data.title,data.msg,data.status);
      if(data.redirect){window.location.href=base_url+data.redirect}
    }


