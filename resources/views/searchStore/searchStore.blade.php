@extends('layouts.master')
@section('css')
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">المخزن</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <!-- /row -->

    <!-- row -->


    <!-- /row -->
    @include('inc.masseg')
    <!-- row -->

<div class="row row-sm">
    <!--start table-->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">الاستعلام</h4>

                </div>
               <form action="{{ url('/storehouse/search') }}">
                <div class="row">
                <div class="col-md-3">
                    <label for=""  class=" text-primary">كود  الصنف</label>
                    <input  class=" form-control mt-2 " id="itemCodeAstielam" type="number">
                </div>
                <div class="col-md-3">
                    <label for=""  class=" text-primary">اسم  الصنف</label>
                    <input   class=" form-control mt-2 " id="itemNameAstielam" type="text">

                    <input type="hidden" name="id" id="itemSearchIdAstielam">
                    <div id="ajaxItemSearchAstielamErrors" class=" bg-danger text-center font-weight-bolder"></div>
                    <div class="d-none" id="itemAstielamSearchMenu">
                        <div class="form-group ">
                            <select class="form-control" id="itemAstielamSearchSelector">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for=""  class=" text-primary"> من تاريخ</label>
                    <input class=" form-control mt-2" name="from"  type="date">
                </div>
                <div class="col-md-3">
                    <label for=""  class=" text-primary">الى تاريخ</label>
                    <input class=" form-control mt-2" name="to"  type="date">
                </div>
                <div class="col-md-3">
                    <input class=" form-control mt-2"  type="submit">
                </div>
                </div>

               </form>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">مسلسل</th>
                                <th class="wd-15p border-bottom-0">كود المخزن</th>
                                <th class="wd-15p border-bottom-0">اسم المخزن</th>
                                <th class="wd-15p border-bottom-0">كود المورد</th>
                                <th class="wd-15p border-bottom-0"> اسم المورد</th>
                                <th class="wd-15p border-bottom-0">  كود الصنف</th>
                                <th class="wd-15p border-bottom-0">اسم الصنف </th>
                                <th class="wd-20p border-bottom-0">الكميه</th>
                                <th class="wd-15p border-bottom-0">سعر الشراء </th>
                                <th class="wd-10p border-bottom-0">سعر البيع</th>
                                <th class="wd-25p border-bottom-0">السعر النهائي</th>
                                <th class="wd-25p border-bottom-0"> تاريخ الشراء</th>
                                <th class="wd-25p border-bottom-0"> الرصيد  الافتتحاي</th>
                                <th class="wd-15p border-bottom-0">ملاحظات</th>
                                <th class="wd-15p border-bottom-0">تعديل</th>
                                <th class="wd-15p border-bottom-0">حذف</th>



                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($storehouses as $storehouse)


                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$storehouse->item->cat->storeCode}}</td>
                                <td>{{$storehouse->item->cat->StoreName}}</td>
                                 <td>{{$storehouse->supplier->SupplierCode}}</td>
                                 <td>{{$storehouse->supplier->SupplierName}}</td>
                                 <td>{{$storehouse->item->itemProductCode}}</td>
                                 <td>{{$storehouse->item->itemProductName}}</td>
                                <td>{{$storehouse->quantity}}</td>
                                <td>{{$storehouse->PurchasingBrice}}</td>
                                <td>{{$storehouse->sellingBrice}}</td>
                                <td>{{$storehouse->finalBriceEnd}}</td>
                                <td>{{$storehouse->purchasedDate}}</td>
                                <td>{{$storehouse->openingBalance}}</td>
                                <td>{{$storehouse->storehouseNotes}}</td>
                                <td>  <button  type="button" class="btn btn-info edit-btn"   data-id="{{$storehouse->id}}" data-storeCode="{{$storehouse->item->cat->storeCode}}"    data-StoreName="{{$storehouse->item->cat->StoreName}}"     data-SupplierCode="{{$storehouse->supplier->SupplierCode}}"   data-SupplierName="{{$storehouse->supplier->SupplierName}}"  data-itemProductCode="{{$storehouse->item->itemProductCode}}"    data-itemProductName="{{$storehouse->item->itemProductName}}" data-quantity="{{$storehouse->quantity}}" data-PurchasingBrice="{{$storehouse->PurchasingBrice}}"  data-sellingBrice="{{$storehouse->sellingBrice}}"  data-finalBriceEnd="{{$storehouse->finalBriceEnd}}"    data-purchasedDate="{{$storehouse->purchasedDate}}" data-openingBalance="{{$storehouse->openingBalance}}" data-storehouseNotes="{{$storehouse->storehouseNotes}}"   data-target="#edit-model" data-toggle="modal">
                                    <i class="fas fa-edit"></i>
                                   </button></td>
                                <td>  <a href="{{url("/storehouse/delete/$storehouse->id")}}" class=" btn  btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                   </a></td>

                            </tr>

                            @endforeach





                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!--end table-->
</div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->


    <!-- End Small Modal -->

    <!-- Large Modal -->


////////////////////////////////////////
<!--start update -->
  <form action="{{url('/storehouse/update')}}" method="POST">
    @csrf
    <input type="hidden" name="id" id="edit-form-id">
    <div class="modal" id="edit-model">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل في المخزن</h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <label for="" class=" text-primary "> الرصيد  الافتتحاي </label>
                        <input type="text" name="openingBalance" class="form-control" id="edit-form-openingBalance">
                    </div>
                    <div class="col-md-6">
                        <label for="" class=" text-primary "> تاريخ الشراء</label>
                        <input type="datetime" style="direction:ltr" name="purchasedDate" class="form-control" readonly value="{{ now()->toDateTimeString() }}"   id="edit-form-purchasedDate">
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label for="" class=" text-primary">كود المخزن</label>
                            <input type="number" readonly  id="edit-form-storeCode" class=" form-control storCode">
                        </div>
                        <div class="col-md-6">
                            <label for="" class=" text-primary"> اسم المخزن</label>
                            <input type="text" readonly   id="edit-form-StoreName"  class="form-control storNam">

                        </div>

                        <div class="col-md-6">
                            <label for="" class=" text-primary">كود المورد </label>
                            <input type="number"  id="edit-form-SupplierCode"  readonly class=" form-control supCode">
                        </div>
                        <div class="col-md-6">
                            <label for="" class=" text-primary"> اسم المورد </label>
                            <input type="text"  readonly id="edit-form-SupplierName" class=" form-control supName">                        </div>

                        <div class="col-md-6">
                            <label for="" class=" text-primary">كود الصنف</label>
                            <input type="number" id="edit-form-itemProductCode" readonly  class=" form-control read">
                        </div>
                        <div class="col-md-6">
                            <label for="" class=" text-primary">اسم الصنف</label>
                            <input type="text"  readonly id="edit-form-itemProductName" class=" form-control res">
                        </div>
                        <div class="col-md-6">
                            <label for="" class=" text-primary">الكميه</label>
                            <input type="number" id="edit-form-quantity" name="quantity" class=" form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="" class=" text-primary">سعر الشراء</label>
                            <input type="number" id="edit-form-PurchasingBrice" name="PurchasingBrice" class=" form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="" class=" text-primary">سعر البيع</label>
                            <input type="text" id="edit-form-sellingBrice" name="sellingBrice" class=" form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="" class=" text-primary">السعر النهائي</label>
                            <input type="text" id="edit-form-finalBriceEnd"  name="finalBriceEnd" class=" form-control">
                        </div>

                        <div class="col-md-12">
                            <label for="" class=" text-primary">ملاحظات</label>
                            <input type="text" id="edit-form-storehouseNotes" name="storehouseNotes" class=" form-control">
                        </div>
                        <!--end model-->

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">تاكيد</button>
                    <button class="btn ripple btn-danger" data-dismiss="modal" type="button">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
  </form>


    <!-- End Modal effects-->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->

@endsection


{{-- start ajax  item Astielam --}}
@section('item')
{{-- start ajax get cod item Astielam --}}
<script>
    console.log('sacbn')
   $('#itemCodeAstielam').keyup(() => {
       let itemCodeAstielamValue = $('#itemCodeAstielam').val();
       let itemNameAstielam = $('#itemNameAstielam');
       let itemSearchIdAstielam = $('#itemSearchIdAstielam');

       let ajaxItemSearchAstielamErrors = $('#ajaxItemSearchAstielamErrors');

       $.ajax({
           url: `/ajax/items/get-by-code/${itemCodeAstielamValue}`,
           type: 'get',
           success: (response) => {
               ajaxItemSearchAstielamErrors.html('');
               itemNameAstielam.val(response.item.itemProductName);
               itemSearchIdAstielam.val(response.item.id);

           },
           error: (xhr, ajaxOptions, thrownError) => {
               ajaxItemSearchAstielamErrors.html('لا يوجد صنف بهذا الكود');
               itemNameAstielam.val('');
               itemSearchIdAstielam.val('');

           },
       });
   });
</script>
{{-- end get cod item Astielam --}}

{{-- start ajax get input search item Astielam --}}
<script>
   $('#itemNameAstielam').keyup(() => {
       let itemNameAstielamValue = $('#itemNameAstielam').val();
       let itemAstielamSearchMenu = $('#itemAstielamSearchMenu');
       // let itemName = $('#itemName');
       let itemCodeAstielam = $('#itemCodeAstielam');
       let itemSearchIdAstielam = $('#itemSearchIdAstielam');

       let ajaxItemSearchAstielamErrors = $('#ajaxItemSearchAstielamErrors');

       $.ajax({
           url: `/ajax/items/input-search/${itemNameAstielamValue}`,
           type: 'get',
           success: (response) => {
               ajaxItemSearchAstielamErrors.html('');
               $('#itemAstielamSearchSelector').html('');
               itemAstielamSearchMenu.removeClass('d-none');
               response.items.map((item) => {
                   $('#itemAstielamSearchSelector').append(`
                           <option  value="${item.itemProductName}">${item.itemProductName}</option>
                   `);
               });
               // itemName.val(response.items[0].itemProductName);
               itemCodeAstielam.val(response.items[0].itemProductCode);
               itemSearchIdAstielam.val(response.items[0].id);

           },
           error: (xhr, ajaxOptions, thrownError) => {
               itemAstielamSearchMenu.addClass('d-none');
               $('#itemAstielamSearchSelector').html('');
               ajaxItemSearchAstielamErrors.html('لا يوجد صنف بهذا الاسم');
               itemCodeAstielam.val('');
               itemSearchIdAstielam.val('');

           },
       });
   });
</script>
{{-- End ajax get input search item Astielam --}}
   {{-- Item getCodeByNameAstielam --}}
   <script>
       $('#itemAstielamSearchSelector').change(() => {
           let itemNameAstielamValue = $('#itemAstielamSearchSelector option:selected').val();
           // let itemName = $('#itemName');
           let itemCodeAstielam = $('#itemCodeAstielam');
           let itemSearchIdAstielam = $('#itemSearchIdAstielam');

           let ajaxItemSearchAstielamErrors = $('#ajaxItemSearchAstielamErrors');
           $.ajax({
               url: `/ajax/items/get-by-name/${itemNameAstielamValue}`,
               type: 'get',
               success: (response) => {
                   ajaxItemSearchAstielamErrors.html('');
                   // itemName.val(response.item.itemProductName);
                   itemCodeAstielam.val(response.item.itemProductCode);
                   itemSearchIdAstielam.val(response.item.id);

               },
               error: (xhr, ajaxOptions, thrownError) => {
                   ajaxItemSearchAstielamErrors.html('لا يوجد صنف بهذا الاسم');
                   // itemName.val('');
                   itemCodeAstielam.val('');
                   itemSearchIdAstielam.val('');

               },
           });
       });
   </script>
    {{-- End Item getCodeByNameAstielam --}}
@endsection

{{-- End ajax  item Astielam --}}





////////////////////////////////
@section('storeUpdate')
<script>
$('.edit-btn').click(function(){
let id = $(this).attr('data-id')
let StoreName = $(this).attr('data-StoreName')
let storeCode=  $(this).attr('data-storeCode')
let SupplierName = $(this).attr('data-SupplierName')
let SupplierCode = $(this).attr('data-SupplierCode')
let itemProductCode = $(this).attr('data-itemProductCode')
let itemProductName = $(this).attr('data-itemProductName')

   let quantity = $(this).attr('data-quantity')
   let PurchasingBrice = $(this).attr('data-PurchasingBrice')
   let sellingBrice = $(this).attr('data-sellingBrice')
   let finalBriceEnd = $(this).attr('data-finalBriceEnd')
   let purchasedDate = $(this).attr('data-purchasedDate')
   let openingBalance = $(this).attr('data-openingBalance')
   let storehouseNotes = $(this).attr('data-storehouseNotes')
 console.log(id,StoreName,storeCode,SupplierName,SupplierCode,itemProductCode,
 itemProductName,quantity,PurchasingBrice,sellingBrice
,finalBriceEnd,purchasedDate,openingBalance,storehouseNotes)

$('#edit-form-id').val(id)
$('#edit-form-openingBalance').val(openingBalance)
$('#edit-form-purchasedDate').val(purchasedDate)
$('#edit-form-storeCode').val(storeCode)
$('#edit-form-StoreName').val(StoreName)
$('#edit-form-SupplierCode').val(SupplierCode)
$('#edit-form-SupplierName').val(SupplierName)
$('#edit-form-itemProductCode').val(itemProductCode)
$('#edit-form-itemProductName').val(itemProductName)
$('#edit-form-quantity').val(quantity)
$('#edit-form-PurchasingBrice').val(PurchasingBrice)
$('#edit-form-sellingBrice').val(sellingBrice)
$('#edit-form-finalBriceEnd').val(finalBriceEnd)
$('#edit-form-storehouseNotes').val(storehouseNotes)



})
</script>
@endsection
