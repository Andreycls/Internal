@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="Stylesheet"
        type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

    
    <meta name="csrf-token" content="{{ csrf_token() }}">
   

    <h3 class="page-title">@lang('quickadmin.jadwal.title')</h3>
           
    <form id="testForm">
    <input class="checkbox" name="one" type="checkbox">
    <input class="checkbox" name="two" type="checkbox">
    <input class="checkbox" name="three" type="checkbox">
        <button>Send</button>
</form>
<script>
var form = document.getElementById('testForm');

try {
    form.addEventListener("submit", submitFn, false);
} catch(e) {
    form.attachEvent("onsubmit", submitFn); //IE8
}

function submitFn(event) {
    event.preventDefault();
    var boxes = document.getElementsByClassName('checkbox');
    var checked = [];
    for(var i=0; boxes[i]; ++i){
      if(boxes[i].checked){
        checked.push(boxes[i].name);
      }
    }
    
    var checkedStr = checked.join(',');
    
    alert(checkedStr);
    
    return false;
}
</script>


    {!! Form::open(array('method' => 'POST','id'=>'add_name','name'=>'add_name', 'route' => 'admin.gedung.store')) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
                <table class="table" id="dynamic_field">  
                    <tr>  
                    <td>
                    {!! Form::label('kota', trans('quickadmin.jadwal.fields.tahun'), ['class' => 'control-label']) !!}
                    <input id="year" class="year form-control" type="text" />
                    
                    </td>  
                    </tr>    

                    <tr>  
                    <td>
                    {!! Form::label('nama_gedung', trans('quickadmin.jadwal.fields.periode').'*', ['class' => 'control-label']) !!}
                    
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="date form-control" id="buka" name="buka" type="text">
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="date form-control" id="buka" name="tutup" type="text">
                        </div>
                       
                    </div>
                    
                    {!! Form::label('nama_gedung', trans('quickadmin.jadwal.fields.registrasiOnline').'*', ['class' => 'control-label']) !!}
                    
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="date form-control" id="buka" name="buka" type="text">
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="date form-control" id="buka" name="tutup" type="text">
                        </div>
                    </div>
                    {!! Form::label('nama_gedung', trans('quickadmin.jadwal.fields.registrasiLangsung').'', ['class' => 'control-label']) !!}
                    
                    <input class="date form-control" id="buka" name="tutup" type="text">
                    </td>  
                    </tr>
                    <tr>
                    <td>
                    
                  
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.registrasiTest'), ['class' => 'control-label']) !!}
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="date form-control" id="buka" name="buka" type="text">
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="date form-control" id="buka" name="tutup" type="text">
                        </div>
                    </div>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.registrasiFinal'), ['class' => 'control-label']) !!}
                    <input class="date form-control" id="buka" name="tutup" type="text">
                    
                    
                    </td>  
                    </tr>
                    <tr>
                    <td>
                    
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.tesPsikologi'), ['class' => 'control-label']) !!}
                    <input class="date form-control" id="buka" name="tutup" type="text">
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.tesInterview'), ['class' => 'control-label']) !!}
                    <div class="row">
                        <div class="col-sm-4">              
                            <input class="date form-control" id="buka" name="buka" type="text">
                        </div>
                        <div class="col-sm-1">
                            Sampai
                        </div>  
                        <div class="col-sm-4">
                            <input class="date form-control" id="buka" name="tutup" type="text">
                        </div>
                    </div>
                    </td>
                    </tr>

                    <tr>
                    <td>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.pengumumanTesAkademik'), ['class' => 'control-label']) !!}
                    <input class="date form-control" id="buka" name="tutup" type="text">
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.pengumumanFinal'), ['class' => 'control-label']) !!}
                    <input class="date form-control" id="buka" name="tutup" type="text">
                    
                    </td>
                    </tr>
                    <tr>
                    <td>
                    {!! Form::label('alamat', trans('quickadmin.jadwal.fields.kota'), ['class' => 'control-label']) !!}
                    <br>
                    @foreach($kota as $kota)
                    <input type="checkbox" name="{{ $kota->nama_kota }}" value="{{ $kota->nama_kota }}">{{ $kota->nama_kota }}<br>
                    @endforeach 

                </td>

                    </tr>
          
                </table>
                      
        <div class="panel-body">
        
        </div>
             
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!} 
    <script type="text/javascript">
    	$( "#start_date" ).datepicker(
	
    { 
        maxDate: '0', 
        beforeShow : function()
        {
            jQuery( this ).datepicker({  maxDate: 0 });
        },
        altFormat: "dd/mm/yy", 
        dateFormat: 'dd/mm/yy'
        
    }
    
);

$( "#end_date" ).datepicker( 

    {
        maxDate: '0', 
        beforeShow : function()
        {
            jQuery( this ).datepicker('option','minDate', jQuery('#start_date').val() );
        } , 
        altFormat: "dd/mm/yy", 
        dateFormat: 'dd/mm/yy'
        
    }
    
);

    </script>

    <script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "<?php echo url('addmore'); ?>";
      var i=1;  
      $('#selectCity').on('change', function(){
         $('#myinput').val($(this).val());
         var val = $('#selectCity').val();
        })

        // init
        $('#selectCity').change();

      $('#add').click(function(){  
            //{!! Form::number("alamat[1]", old("alamat"), ["class" => "form-control name_list", "placeholder" => "Banyak ruangan", "required" => ""]) !!}
            var val = $('#selectCity').val();

           $('#dynamic_field').append('<tr id="row'+i+' " class="dynamic-added"><td><input type=hidden name="kode_gedung['+i+']" value="GD-SPSB-'+(i+1)+'"><input class="form-control" type=hidden value="'+(val)+'" name="kota['+i+']" readonly >{!! Form::label("nama_gedung", trans("quickadmin.gedung.fields.hall")."*", ["class" => "control-label"]) !!}<input class="form-control" type=text name="nama_gedung['+i+']" >{!! Form::label("alamat", trans("quickadmin.gedung.fields.address")."*", ["class" => "control-label"]) !!}<input class="form-control" type=text name="alamat['+i+']" >{!! Form::label("alamat", trans("quickadmin.gedung.fields.room"), ["class" => "control-label"]) !!}<input class="form-control" type=number name="banyak_ruangan['+i+']" ></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
           i++;
      });  
      
                    

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $('#submit').click(function(){            
           $.ajax({  
                url:postURL,  
                method:"POST",  
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)  
                {
                    if(data.error){
                        printErrorMsg(data.error);
                    }else{
                        i=1;
                        $('.dynamic-added').remove();
                        $('#add_name')[i].reset();
                        $(".print-success-msg").find("ul").html('');
                        $(".print-success-msg").css('display','block');
                        $(".print-error-msg").css('display','none');
                        $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
                    }
                }  
           });  
      });  


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
</script>

    <script>

var today = new Date();
$("#year").datepicker({  
    format: "yyyy",
    startView: "years", 
    minViewMode: "years",
    minDate:today
 });
 $("#datepicker").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
 $('.date').datepicker({  
format: 'dd-mm-yyyy',
minDate: today
}); 
var dateToday = new Date();
$("#from, #to").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});

</script>
@stop

