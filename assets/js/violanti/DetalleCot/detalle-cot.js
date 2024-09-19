$(document).ready(function (){

  $('#mns_procesando').addClass('card-body display-none');
  $(document).on('click','#detalle_cot',function(){
      $('#mns_procesando').removeClass('display-none');
      $('#mns_detalle_1').addClass('card-body display-none');
      $('#mns_detalle_2').addClass('card-body display-none');
      $('#mns_detalle_3').addClass('card-body display-none');
      $('#mns_detalle_4').addClass('card-body display-none');
      $('#mns_detalle_5').addClass('card-body display-none');
      $('#mns_detalle_6').addClass('card-body display-none');
      
      
  });
});