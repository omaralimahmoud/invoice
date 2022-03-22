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
                <h4 class="content-title mb-0 my-auto"> الاعدادات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
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

    @include('inc.masseg')
    <!-- /row -->

    <!-- row -->

<div class="row row-sm">
    <!--start table-->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">اعداد المستخدمين </h4>


                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap text-center" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0"> مسلسل</th>

                                <th class="wd-15p border-bottom-0">اسم المستخدم </th>

                                <th class="wd-20p border-bottom-0"> الايميل  </th>
                                <th class="wd-15p border-bottom-0"> كلمه السر  </th>
                                <th class="wd-15p border-bottom-0">  نوع المستخدم  </th>
                                <th class="wd-15p border-bottom-0">  تعديل   </th>






                            </tr>
                        </thead>
                        <tbody>

                     @foreach ($users as $user)


                       <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->password}}</td>
                        <td>{{$user->role->name}}</td>
                         <td>
                            <button type="button"  data-role="{{$user->role->name}}"  data-password="{{$user->password}}"       data-email="{{$user->email}}"           data-id="{{$user->id}}"  data-name="{{$user->name}}"    class=" btn  btn-info edit-btn"  data-target="#edit-model" data-toggle="modal">


                            <i class="fas fa-edit"></i>
                        </button>
                         </td>
                       </tr>
                       @endforeach




                        </tbody>
                    </table>
                    <div class="d-flex my-3 justify-content-center">
                        {{ $users->links() }}
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
    <form action="{{url('/editPassword/update')}}" method="POST">
        @csrf
    <div class="modal" id="edit-model">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> تعديل   كلمه السر   </h6><button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">



                     <input type="hidden" name="id" id="edit-form-id">

                        <div class="col-md-6">
                            <label for="" class=" text-primary"> اسم المستخدم </label>

                            @error('name')
                            <div class="alret alert-danger">
                                <h3>{{$message}}</h3>
                            </div>
                            @enderror
                            <input id="edit-form-name"  readonly name="name"  type="text" class=" form-control" >
                        </div>
                        <div class="col-md-6">
                            <label for="" class=" text-primary"> الايميل  </label>
                            @error('email')
                            <div class="alret alert-danger">
                                <h3>{{$message}}</h3>
                            </div>
                            @enderror
                            <input  readonly  id="edit-form-email"  name="email" type="text" class=" form-control" >
                        </div>

                        <div class="col-md-6">
                            <label for="" class=" text-primary">  كلمه  السر </label>
                            @error('password')
                            <div class="alret alert-danger">
                                <h3>{{$message}}</h3>
                            </div>
                            @enderror
                            <input  name="password" type="password" class=" form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="" class=" text-primary">  تاكيد كلمه السر </label>

                            <input  name="password_confirmation" type="password" class=" form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="" class=" text-primary">  نوع المستخدم </label>

                            <input  id="edit-form-typeUser"  readonly name="typeUser" type="text" class=" form-control" >
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

@section('script')
<script>
    $('.edit-btn').click(function(){
        let id = $(this).attr('data-id')
        let name = $(this).attr('data-name')
        let email = $(this).attr('data-email')
        let role= $(this).attr('data-role')
        console.log(id,name,email,role);
          $("#edit-form-id").val(id)
        $('#edit-form-name').val(name)
          $("#edit-form-email").val(email)
         $('#edit-form-typeUser').val(role)


    })
</script>

@endsection
