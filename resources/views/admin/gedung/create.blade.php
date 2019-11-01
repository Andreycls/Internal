@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
   

    <h3 class="page-title">@lang('quickadmin.gedung.title')</h3>
           
    


    {!! Form::open(array('method' => 'POST','id'=>'add_name','name'=>'add_name', 'route' => 'admin.gedung.store')) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
                <table class="table" id="dynamic_field">  
                    <tr>  
                        <td>
                        
                    {!! Form::label('kota', trans('quickadmin.gedung.fields.city'), ['class' => 'control-label']) !!}
                    {!! Form::select('kota[0]',$kotas, old('nama_kota'), ['class' => 'form-control', 'placeholder' => '', 'required' => '','id' => 'selectCity']) !!}
                    
                    </td>  
                    </tr>    

                    <tr>  
                    <td>
                    {!! Form::label('nama_gedung', trans('quickadmin.gedung.fields.hall').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nama_gedung[0]', old('nama_gedung'), ['class' => 'form-control', 'placeholder' => 'Nama Gedung', 'required' => '']) !!}
                    
                    <!-- {!! Form::label('alamat', trans('quickadmin.gedung.fields.room'), ['class' => 'control-label']) !!}
                    {!! Form::number('alamat[0]', old('alamat'), ['class' => 'form-control', 'placeholder' => 'Alamat Gedung', 'required' => '']) !!}
                     -->
                    
                    {!! Form::label('alamat', trans('quickadmin.gedung.fields.address'), ['class' => 'control-label']) !!}
                    {!! Form::text('alamat[0]', old('alamat'), ['class' => 'form-control', 'placeholder' => 'Alamat Gedung', 'required' => '']) !!}
                    
                    {!! Form::label('alamat', trans('quickadmin.gedung.fields.room'), ['class' => 'control-label']) !!}
                    {!! Form::text('banyak_ruangan[0]', old('banyak_ruangan'), ['class' => 'form-control', 'placeholder' => 'Alamat Gedung', 'required' => '']) !!}
                    
                    
                    
                    <input type=hidden name="kode_gedung[0]" value="GD-SPSB-{{$max+1}}">
                    
                    </td>  
                    </tr>    
                        
                        
                    
                      
                </table>
                <tr>
                <td>
                <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                </td>
                </tr>
                      
        <div class="panel-body">
        <!-- <div class="row">
      
                <div class="col-xs-12 form-group">
                    {!! Form::label('kota', trans('quickadmin.gedung.fields.city'), ['class' => 'control-label']) !!}
                    {!! Form::select('kota',$kotas, old('nama_kota'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nama_gedung', trans('quickadmin.gedung.fields.hall').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nama_gedung', old('nama_gedung'), ['class' => 'form-control', 'placeholder' => 'Nama Gedung', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div> -->
            
            
            <!-- <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('alamat', trans('quickadmin.gedung.fields.address'), ['class' => 'control-label']) !!}
                    {!! Form::text('alamat', old('alamat'), ['class' => 'form-control', 'placeholder' => 'Alamat Gedung', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div> -->

            
            
          <!-- <input type=submit>
         -->
        </div>
        
    </div>
    
    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!} 
    <script type="text/javascript">
      var max = "<?php echo $max ?>";   
    $(document).ready(function(){      
      var postURL = "<?php echo url('addmore'); ?>";
      var i=<?php echo $max+1 ?>;  
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
    



@stop

