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
                <button class="  text-danger btn  btn-outline-dark"><a href="{{url('/supplier')}}">   الرجوع الى صفحه كود المورد  </a></button>
                </span>
            </div>
        </div>

    </div>
    <form action="{{url("/supplier/search")}}" method="GET">

        <div class="row">
        <div class="col-md-6">
         <div class=" d-flex justify-content-center my-1">
              <input  name="search" type="text" placeholder="بحث" value="{{$search}}"  class=" text-warning  form-control ">
              <input type="submit" class="btn  btn-outline-primary mr-1" value="بحث">
          </div>
        </div>
        </div>

    </form>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <!-- /row -->

    <!-- row -->

    @include('inc.masseg')
    <!-- /row -->

    <!-- row -->

<div class="row row-sm">
    <!--start table-->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between  float-left">

                    <a class="btn ripple btn-info " data-target="#modaldemo3" data-toggle="modal" href="" >اضافه كود المورد </a>

                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">مسلسل </th>
                                <th class="wd-15p border-bottom-0">كود المورد</th>
                                <th class="wd-15p border-bottom-0">اسم المورد</th>
                                <th class="wd-20p border-bottom-0">ملاحظات</th>
                                <th class="wd-20p border-bottom-0">الاعدادات</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)


                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$supplier->SupplierCode}}</td>
                                <td>{{$supplier->SupplierName}}</td>
                                <td>{{$supplier->supplierNotes}}</td>
                                    <td>
                                        <button type="button" class=" btn btn-info edit-btn" data-id="{{$supplier->id}}" data-SupplierCode="{{$supplier->SupplierCode}}" data-SupplierName="{{$supplier->SupplierName}}"  data-supplierNotes="{{$supplier->supplierNotes}}"    data-target="#edit-model" data-toggle="modal" >
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{url("/supplier/delete/$supplier->id")}}" class="btn btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
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
    <form action="{{url("/supplier/store")}}" method="POST">
        @csrf
    <div class="modal" id="modaldemo3">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> اضافه كود المورد   </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">





                        <div class="col-md-6">
                            <label for="" class=" text-primary">كود المورد </label>
                            @error('SupplierCode')
                              <div class=" alert alert-danger">
                                <p> {{$message}}</p>
                              </div>
                            @enderror
                            <input  name="SupplierCode" type="number" class=" form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="" class=" text-primary"> اسم المورد </label>
                            @error('SupplierName')
                            <div class=" alert alert-danger">
                                <p>{{$message}}</p>
                            </div>
                            @enderror
                            <input  name="SupplierName" type="text" class=" form-control">
                        </div>

                        <div class="col-md-12">
                            <label for="" class=" text-primary">  ملاحظات </label>
                            @error('supplierNotes')
                             <div class=" alert alert-danger">
                              <p>{{$message}}</p>
                             </div>
                            @enderror
                            <input  name="supplierNotes" type="text" class=" form-control">
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
    <!--End Large Modal -->

</form>
////////////////////


<form action="{{url("/supplier/update")}}" method="POST">
    @csrf
<div class="modal" id="edit-model">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> تعديل كود المورد   </h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">



                 <input type="hidden" name="id" id="edit-form-id">

                    <div class="col-md-6">
                        <label for="" class=" text-primary">كود المورد </label>
                        @error('SupplierCode')
                          <div class=" alert alert-danger">
                            <p> {{$message}}</p>
                          </div>
                        @enderror
                        <input  name="SupplierCode" readonly type="number" class=" form-control" id="edit-form-SupplierCode">
                    </div>
                    <div class="col-md-6">
                        <label for="" class=" text-primary"> اسم المورد </label>
                        @error('SupplierName')
                        <div class=" alert alert-danger">
                            <p>{{$message}}</p>
                        </div>
                        @enderror
                        <input  name="SupplierName" type="text" class=" form-control" id="edit-form-SupplierName">
                    </div>

                    <div class="col-md-12">
                        <label for="" class=" text-primary">  ملاحظات </label>
                        @error('supplierNotes')
                         <div class=" alert alert-danger">
                          <p>{{$message}}</p>
                         </div>
                        @enderror
                        <input  name="supplierNotes" type="text" class=" form-control" id="edit-form-supplierNotes">
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
    <!-- Scroll modal -->

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

@section('script')
<script>
    $('.edit-btn').click(function(){
        let id= $(this).attr('data-id')
        let SupplierCode = $(this).attr('data-SupplierCode')
        let SupplierName= $(this).attr('data-SupplierName')
        let supplierNotes= $(this).attr('data-supplierNotes')
           $('#edit-form-id').val(id)
           $('#edit-form-SupplierCode').val(SupplierCode)
           $('#edit-form-SupplierName').val(SupplierName)
           $('#edit-form-supplierNotes').val(supplierNotes)

     //console.log(id,SupplierCode,SupplierName,supplierNotes);

    })
</script>
@endsection
