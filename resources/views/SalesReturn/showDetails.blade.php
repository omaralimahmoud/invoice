
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
    <link rel="stylesheet" href="{{ URL::asset('assets/css_print/print.min.css') }}">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/style/style.css') }}">
    <link rel="stylesheet" href="{{URL::asset('assets/css-table/style3.css')}}">
@endsection
@section('page-header')
    {{-- <!-- breadcrumb --> --}}

    {{-- <div class="d-flex justify-content-between float-left"> --}}
        {{-- <button  type="button"><a href="{{url("/sales/orderDetails/update/$order->id")}}" class=" btn btn-info text-white edit-btn  " > تعديل</a></button> --}}
        {{-- </div> --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> الفاتوره </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->

@endsection
@section('content')
    <!-- row -->

    <h3>بيانات الفاتوره</h3>
    <div class="row ">

        <div class=" col-md-2 my-2">
            <label for="">مسلسل</label>
        <input type="text" class=" form-control  " readonly value="{{ $ReturnOrder->id }}">
        </div>
        <div class=" col-md-2 my-2">
            <label for="">نوع الفاتوره</label>
        <input type="text" class=" form-control" readonly value=" @if ($ReturnOrder->returnInvoiceType == 1)
        اجل
    @elseif($ReturnOrder->returnInvoiceType == 2)
        نقدي
    @endif">
        </div>
        <div class=" col-md-2 my-2">
            <label for="">رقم الفاتوره</label>
        <input type="text" class=" form-control" readonly value=" {{$ReturnOrder->returnNumberInvoice}}">
        </div>
        <div class=" col-md-2 my-2">
            <label for="">نوع العميل</label>
        <input type="text" class=" form-control" readonly value="  @if ($ReturnOrder->returnCustomerType == 1)
        اشخاص
    @elseif($ReturnOrder->returnCustomerType == 2)
        شركات
    @endif">
        </div>
        <div class=" col-md-2 my-2">
            <label for="">كود العميل</label>
        <input type="text" class=" form-control" readonly value="{{ $ReturnOrder->returnCustomerCodeInvoice }}">
        </div>
        <div class=" col-md-2 my-2">
            <label for="">اسم العميل</label>
        <input type="text" class=" form-control" readonly value="{{ $ReturnOrder->returnCustomerNameInvoice }}">
        </div>
        <div class=" col-md-2 my-2">
            <label for="">رقم تلفون العميل	</label>
        <input type="text" class=" form-control" readonly value="{{ $ReturnOrder->returnCustomerPhoneNumberInvoice }}">
        </div>
        <div class=" col-md-2 my-2">
            <label for="">اسم المحاسب	</label>
        <input type="text" class=" form-control" readonly  value="{{ $ReturnOrder->user->name }}">
        </div>
        <div class=" col-md-2 my-2">
            <label for="">نسبه الخصم	</label>
        <input type="text" class=" form-control" readonly value="{{ $ReturnOrder->returnDiscountBercentageInvoice }}">
        </div>
        <div class=" col-md-2 my-3">
            <label for="" class="no-print">حذف الكسور	</label>
        <input type="text" class=" form-control" readonly value="{{ $ReturnOrder->returnRemoveDecimal }}">
        </div>
        <div class=" col-md-2 my-2">
           <label for="">الصافي</label>
        <input type="text" class=" form-control" readonly value="{{ $ReturnOrder->returnNetInvoice }}">
        </div>
        <div class=" col-md-2 my-2">
            <label for="">التاريخ</label>
        <input type="text" class=" form-control" readonly value="{{ $ReturnOrder->created_at }}">
        </div>
    </div>





    <!-- /row -->
    <form method="POST" action="" id="printJS-form"    style="direction: rtl" >
        @csrf
        <div class="row row-sm">
            <!--start table-->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0 no-print d-none">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0 ">البيانات </h4>


                        </div>


                    </div>
                    <div class="card-body no-print  d-none">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap text-center grob " id="example1">
                                <thead >
                                    <tr>
                                        <th class="wd-15p border-bottom-0"> مسلسل</th>

                                        <th class="wd-15p border-bottom-0">نوع الفاتوره</th>

                                        <th class="wd-20p border-bottom-0"> رقم الفاتوره </th>
                                        <th class="wd-15p border-bottom-0"> نوع العميل </th>
                                        <th class="wd-10p border-bottom-0">كود العميل</th>
                                        <th class="wd-10p border-bottom-0"> اسم العميل</th>
                                        <th class="wd-10p border-bottom-0"> رقم تلفون العميل</th>
                                        <th class="wd-10p border-bottom-0"> اسم المحاسب </th>
                                        <th class="wd-10p border-bottom-0 "> نسبه الخصم</th>
                                        <th class="wd-10p border-bottom-0"> الصافي </th>
                                        <th class="wd-10p border-bottom-0"> حذف الكسور </th>
                                        <th class="wd-10p border-bottom-0"> التاريخ </th>






                                    </tr>
                                </thead>
                                <tbody >
                                    <tr>
                                        {{-- <td>{{ $order->id }}</td>
                                        <td>
                                            @if ($order->invoiceType == 1)
                                                اجل
                                            @elseif($order->invoiceType == 2)
                                                نقدي
                                            @endif
                                        </td>
                                        <td>{{ $order->numberInvoice }}</td>
                                        <td>
                                            @if ($order->customerType == 1)
                                                اشخاص
                                            @elseif($order->customerType == 2)
                                                شركات
                                            @endif
                                        </td>
                                        <td>{{ $order->customerCodeInvoice }}</td>
                                        <td>{{ $order->customerNameInvoice }}</td>
                                        <td>{{ $order->CustomerPhoneNumberInvoice }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->discountBercentageInvoice }}</td>
                                        <td>{{ $order->netInvoice }}</td>
                                        <td>{{ $order->removeDecimal }}</td>
                                        <td>{{ $order->created_at }}</td> --}}

                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!--end table-->
        </div>
        <div class="row row-sm">
            <!--start table-->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0"> التفاصيل </h4>


                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap text-center" id="example1">
                                <thead class="pad">
                                    <tr>
                                        <th class="wd-15p border-bottom-0"> مسلسل</th>

                                        <th class="wd-15p border-bottom-0">كود الصنف </th>
                                        <th class="wd-15p border-bottom-0">اسم الصنف </th>

                                        <th class="wd-20p border-bottom-0 prt"> كود وحده الصنف </th>
                                        <th class="wd-15p border-bottom-0"> وحده الصنف </th>
                                        <th class="wd-10p border-bottom-0">الكميه </th>
                                        <th class="wd-10p border-bottom-0 spac"> سعر بيع الوحده </th>
                                        <th class="wd-10p border-bottom-0"> ملاحظات </th>




                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($ReturnOrderDetails as $ReturnOrderDetail)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$ReturnOrderDetail->item->itemProductCode}}</td>
                                            <td class="spac">{{$ReturnOrderDetail->item->itemProductName}}</td>
                                            <td >{{ $ReturnOrderDetail->item->itemUnitProductCode}}</td>
                                            <td>{{ $ReturnOrderDetail->item->itemOnlyProduct}}</td>
                                            <td>{{$ReturnOrderDetail->returnQuantityInvoice}}</td>
                                            <td>{{$ReturnOrderDetail->returnUnitSaleBriceInvoice}}</td>
                                            <td  class="spac">{{$ReturnOrderDetail->returnNotesInvoice}}</td>



                                        </tr>
                                    @endforeach






                                </tbody>
                            </table>

                            <a href="{{ url()->previous() }}" class=" btn btn-info no-print">الرجوع الى الخلف</a>
                            <a href="{{ url('/return') }}" class=" btn btn-secondary no-print">الرجوع الى الفاتوره</a>
                            <button  type="button" class="btn btn-danger float-left m-3  no-print"
                            onclick="window.print()">
                            طباعه
                        </button>


    </form>
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
    <!-- row -->

    <!-- End Small Modal -->

    <!-- Large Modal -->

    <!--End Large Modal -->



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
    <script src="{{ URL::asset('assets/js_print/print.min.js') }}"></script>
    <!--Internal  Datatable js -->
@endsection

@section('script')
@endsection
