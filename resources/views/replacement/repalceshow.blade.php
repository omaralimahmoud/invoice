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
    <link rel="stylesheet" href="{{URL::asset('assets/css-f/style2.css')}}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> فاوتير المرتجع </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
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
{{-- <div> --}}



    <!-- /row -->

    <!-- row -->

<div class="row row-sm">
    <!--start table-->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">المرتجع </h4>


                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap text-center" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0"> مسلسل</th>

                                <th class="wd-15p border-bottom-0">نوع الفاتوره</th>

                                <th class="wd-20p border-bottom-0"> رقم الفاتوره </th>
                                <th class="wd-15p border-bottom-0"> نوع العميل </th>
                                <th class="wd-10p border-bottom-0">كود العميل</th>
                                <th class="wd-10p border-bottom-0 spac"> اسم العميل</th>
                                <th class="wd-10p border-bottom-0 spac"> رقم تلفون العميل</th>
                                <th class="wd-10p border-bottom-0 spac"> اسم المحاسب  </th>
                                <th class="wd-10p border-bottom-0 spac"> عدد اصناف المرتجع </th>
                                <th class="wd-10p border-bottom-0"> التاريخ </th>
                                <th class="wd-10p border-bottom-0"> الاعدادات </th>





                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($replaceOrders as $replaceOrder)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td> @if ($replaceOrder->replaceInvoiceType==1) اجل @elseif ($replaceOrder->replaceInvoiceType==2) نقدي
                                @endif
                                 </td>
                                <td>{{$replaceOrder->replaceNumberInvoice}}</td>
                                <td> @if ($replaceOrder->replaceCustomerType ==1) اشخاص @elseif ($replaceOrder->replaceCustomerType ==2) شركات

                                @endif</td>
                                <td> {{$replaceOrder->replaceCustomerCodeInvoice}}</td>
                                <td class="spac">{{$replaceOrder->replaceCustomerNameInvoice}}</td>
                                <td>{{$replaceOrder->replaceCustomerPhoneNumberInvoice}}</td>
                                    <td class="spac">{{$replaceOrder->user->name}}</td>


                                     <td>{{$replaceOrder->replaceTotalItems}}</td>

                                <td>{{$replaceOrder->created_at}}</td>
                                <td><a href="{{url("/replaceShowDeatil/$replaceOrder->id")}}" class="btn  btn-info">
                                    <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach






                        </tbody>
                    </table>
                    <div class="d-flex my-3 justify-content-center">
                        {{$replaceOrders->links()}}
                    </div>
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
    <!--Internal  Datatable js -->
@endsection
