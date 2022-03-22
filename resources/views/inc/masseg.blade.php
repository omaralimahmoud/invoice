 <style>
   #ff{
       font-size: 32px;
       font-weight: 900;
   }
 </style>
@if (session('msg'))
<div id="ff" class=" alert  alert-info font-weight-bold text-center">
{{session('msg')}}
</div>
@endif

