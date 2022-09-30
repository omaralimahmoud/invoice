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
                <h4 class="content-title mb-0 my-auto">كود الصنف </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">
                </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    <!-- /row -->
    <form action="{{url("/itemCode/search")}}" method="GET" class="  no-print">

        <div class="row">
        <div class="col-md-6">
         <div class=" d-flex justify-content-center my-1  ">
              <input  name="search" type="text" placeholder="بحث" class=" text-warning  form-control ">
              <input type="submit" class="btn  btn-outline-primary mr-1" value="بحث">
          </div>
        </div>
        </div>

    </form>
    <!-- row -->


    <!-- /row -->
    @include('inc.masseg')
    <!-- row -->

    <div class="row row-sm">
        <!--start table-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between my-3">
                        <h4 class="card-title mg-b-0">كود الصنف</h4>
                        <a class="btn ripple btn-info" data-target="#modaldemo3" data-toggle="modal" href="">اضافة كود الصنف
                        </a>

                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0"> مسلسل</th>

                                    <th class="wd-15p border-bottom-0">كود المخزن</th>
                                    <th class="wd-15p border-bottom-0 spac"> اسم المخزن</th>
                                    <th class="wd-20p border-bottom-0">كود الصنف </th>
                                    <th class="wd-15p border-bottom-0 spac"> اسم الصنف</th>
                                    <th class="wd-20p border-bottom-0">كود وحده الصنف </th>
                                    <th class="wd-20p border-bottom-0 spac"> وحده الصنف</th>
                                    <th class="wd-10p border-bottom-0">ملاحظات</th>
                                    <th class="wd-10p border-bottom-0">تعديل</th>
                                    <th class="wd-10p border-bottom-0">حذف</th>




                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->cat->storeCode }}</td>
                                        <td class="spac">{{ $item->cat->StoreName }}</td>
                                        <td>{{ $item->itemProductCode }}</td>
                                        <td class="spac">{{ $item->itemProductName }}</td>

                                        <td>  {{$item->itemUnitProductCode}} </td>

                                        <td>  {{$item->itemOnlyProduct}} </td>




                                        <td>{{ $item->itemProductNotes }}</td>
                                        <td>
                                            <button type="button" class=" btn  btn-info edit-btn"
                                                data-storeCode="{{ $item->cat->storeCode }}"
                                                data-StoreName="{{ $item->cat->StoreName }}" data-id="{{ $item->id }}"
                                                data-itemProductCode="{{ $item->itemProductCode }}"
                                                data-itemProductName="{{ $item->itemProductName }}"
                                                data-itemUnitProductCode="{{ $item->itemUnitProductCode }}"
                                                data-itemOnlyProduct="{{ $item->itemOnlyProduct }}"
                                                data-itemProductNotes="{{ $item->itemProductNotes }}"
                                                data-cat-id="{{ $item->cat_id }}" data-target="#edit-model"
                                                data-toggle="modal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{ url("itemCode/delete/$item->id") }}" class=" btn  btn-danger">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button  type="button" class="btn btn-danger float-left m-3  no-print"
                        onclick="window.print()">
                        طباعه
                    </button>
                        <div class="d-flex my-3 justify-content-center">
                            {{ $items->links() }}
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
    <form action="{{ url('/itemCode/store') }}" method="POST">
        @csrf
        <div class="modal" id="modaldemo3">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title"> اضافة كود الصنف </h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class=" text-primary">كود المخزن </label>


                                <input type="number" required  class=" form-control " id="catCode">{{-- this code is هو نفس  الكود  cat --}}
                            </div>


                            <div class="col-md-6">
                                <label for="" class=" text-primary"> اسم المخزن </label>
                                <input   required  type="text" class=" form-control" id="catName"> {{-- this name is هو نفس الاسم  cat --}}
                                <input type="hidden" name="cat_id" id="cat_id">
                                <div class="col-12 d-none" id="CatSearchMenu">
                                    <div class="form-group">
                                        <select class="form-control" id="CatSearchSelector">
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 bg-danger text-center font-weight-bolder" id="ajaxCatErrors"></div>

                            <div class="col-md-6">
                                <label for="" class=" text-primary"> كود الصنف </label>
                                @error('itemProductCode')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                <input type="text" required name="itemProductCode" class=" form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="" class=" text-primary"> اسم الصنف </label>
                                @error('itemProductName')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                <input type="text" required name="itemProductName" class=" form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class=" text-primary"> كود وحده الصنف </label>
                                @error('itemUnitProductCode')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                {{-- <input type="number" name="itemUnitProductCode" class=" form-control"> --}}
                                <select  required name="itemUnitProductCode" id="" class="form-control">
                                    <option   value="1">1</option>
                                    <option   value="2">2</option>
                                    <option   value="3">3</option>


                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="" class=" text-primary"> وحده الصنف </label>
                                @error('itemOnlyProduct')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                {{-- <input type="text" name="itemOnlyProduct" class=" form-control"> --}}
                                <select  required name="itemOnlyProduct" id="" class="form-control">
                                    <option   value="علبه">علبه</option>
                                    <option   value="متر">متر</option>
                                    <option   value="قطعه">قطعه</option>

                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="" class=" text-primary"> ملاحظات </label>
                                @error('itemProductNotes')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                <input type="text" name="itemProductNotes" class=" form-control">
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
    <!--End Large Modal -->

<!--update -->
    <form action="{{ url('/itemCode/update') }}" method="POST">
        <input type="hidden" name="id" id="edit-form-id">
        @csrf
        <div class="modal" id="edit-model">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title"> تعديل كود الصنف </h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class=" text-primary">كود المخزن </label>
                                <input type="number" readonly class=" form-control read"
                                    id="edit-form-storeCode">{{-- this code is هو نفس  الكود  cat --}}
                            </div>

                            <div class="col-md-6">
                                <label for="" class=" text-primary"> اسم المخزن </label>
                                <input readonly type="text" class=" form-control res " id="edit-form-StoreName">
                                {{-- this name is هو نفس الاسم  cat --}}
                                <input type="hidden" name="cat_id" id="cat_id">
                            </div>

                            <div class="col-md-6">
                                <label for="" class=" text-primary"> كود الصنف </label>
                                @error('itemProductCode')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                <input readonly type="text" name="itemProductCode" class=" form-control"
                                    id="edit-form-itemProductCode">
                            </div>

                            <div class="col-md-6">
                                <label for="" class=" text-primary"> اسم الصنف </label>
                                @error('itemProductName')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                <input type="text" name="itemProductName" class=" form-control"
                                    id="edit-form-itemProductName">
                            </div>
                            <div class="col-md-6">
                                <label for="" class=" text-primary"> كود وحده الصنف </label>
                                @error('itemUnitProductCode')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                {{-- <input readonly type="number" name="itemUnitProductCode" class=" form-control" --}}
                                    {{-- id="edit-form-itemUnitProductCode"> --}}

                                    <select  name="itemUnitProductCode" id="edit-form-itemUnitProductCode" class="form-control"  >
                                        <option value="1"  selected >1</option>
                                        <option value="2"  selected >2</option>
                                        <option value="3"  selected >3</option>

                                    </select>
                            </div>

                            <div class="col-md-6">
                                <label for="" class=" text-primary"> وحده الصنف </label>
                                @error('itemOnlyProduct')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                {{-- <input type="text" name="itemOnlyProduct" class=" form-control" --}}
                                    {{-- id="edit-form-itemOnlyProduct"> --}}

                                    <select  name="itemOnlyProduct"   id="edit-form-itemOnlyProduct"  class="form-control">
                                        <option value="علبه"  selected >علبه</option>
                                        <option value="متر"  selected >متر</option>
                                        <option value="قطعه"  selected >قطعه</option>


                                    </select>


                            </div>
                            <div class="col-md-12">
                                <label for="" class=" text-primary"> ملاحظات </label>
                                @error('itemProductNotes')
                                    <div class="alert alert-danger">
                                        <p>{{ $message }}</p>
                                    </div>
                                @enderror
                                <input type="text" name="itemProductNotes" class=" form-control"
                                    id="edit-form-itemProductNotes">
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
 {{-- start get CatCode --}}
    <script>

        console.log('bac')
        $('#catCode').keyup(() => {

            let catCodeValue = $('#catCode').val();
            let catName = $('#catName');
            let ajaxCatErrors = $('#ajaxCatErrors');
            let cat_id = $('#cat_id');

            $.ajax({
                url: `/ajax/categories/get-by-code/${catCodeValue}`,
                type: 'get',
                success: (response) => {
                    ajaxCatErrors.html('');
                    catName.val(response.cat.StoreName);
                    cat_id.val(response.cat.id);

                },
                error: (xhr, ajaxOptions, thrownError) => {
                    ajaxCatErrors.html('لا يوجد اسم مخزن بهذا الكود');
                    catName.val('');
                    cat_id.val('')

                },
            });
        });

    </script>
  {{-- End get CatCode --}}

  {{-- start input search --}}
  <script>
    // console.log('sjcncacjs')

    $('#catName').keyup(() => {
        let catNameValue = $('#catName').val();
        let CatSearchMenu = $('#CatSearchMenu');
        // let itemName = $('#itemName');
        let catCode = $('#catCode');
        let cat_id = $('#cat_id');

        let ajaxCatErrors = $('#ajaxCatErrors');

        $.ajax({
            url: `/ajax/categories/input-search/${catNameValue}`,
            type: 'get',
            success: (response) => {
                ajaxCatErrors.html('');
                $('#CatSearchSelector').html('');
                CatSearchMenu.removeClass('d-none');
                response.cats.map((cat) => {
                    $('#CatSearchSelector').append(`
                            <option  value="${cat.StoreName}">${cat.StoreName}</option>
                    `);
                });
                // itemName.val(response.items[0].itemProductName);
                catCode.val(response.cats[0].storeCode);
                cat_id.val(response.cats[0].id);

            },
            error: (xhr, ajaxOptions, thrownError) => {
                CatSearchMenu.addClass('d-none');
                $('#CatSearchSelector').html('');
                ajaxCatErrors.html('  لايوجد كود مخزن بهذا الاسم');
                catCode.val('');
                cat_id.val('');

            },
        });
    });
</script>

 {{-- End input search --}}

 {{-- start get CatName --}}
 <script>
    $('#CatSearchSelector').change(() => {
        console.log('jddj')
        let catNameValue = $('#CatSearchSelector option:selected').val();
        // let itemName = $('#itemName');
        let catCode = $('#catCode');
        let cat_id = $('#cat_id');

        let ajaxCatErrors = $('#ajaxCatErrors');
        $.ajax({
            url: `/ajax/categories/get-by-name/${catNameValue}`,
            type: 'get',
            success: (response) => {
                ajaxCatErrors.html('');
                // itemName.val(response.item.itemProductName);
                catCode.val(response.cat.storeCode);
                cat_id.val(response.cat.id);

            },
            error: (xhr, ajaxOptions, thrownError) => {
                ajaxCatErrors.html('لا يوجد كود مخزن  بهذا الاسم');
                // itemName.val('');
                catCode.val('');
                cat_id.val('');
            },
        });
    });
</script>

 {{-- End get CatName --}}

@endsection



@section('itemScrtpt')
    <script>
        $('.edit-btn').click(function() {
            let id = $(this).attr('data-id')
            let storeCode = $(this).attr('data-storeCode')
            let StoreName = $(this).attr('data-StoreName')
            let itemProductCode = $(this).attr('data-itemProductCode')
            let itemProductName = $(this).attr('data-itemProductName')

            let itemUnitProductCode = $(this).attr('data-itemUnitProductCode')
            let itemOnlyProduct = $(this).attr('data-itemOnlyProduct')
            let itemProductNotes = $(this).attr('data-itemProductNotes')
            console.log(id, storeCode, StoreName, itemProductCode, itemProductName, itemUnitProductCode,
                itemOnlyProduct, itemProductNotes)
            $('#edit-form-id').val(id)
            $('#edit-form-storeCode').val(storeCode)
            $('#edit-form-StoreName').val(StoreName)
            $('#edit-form-itemProductCode').val(itemProductCode)
            $('#edit-form-itemProductName').val(itemProductName)
            $('#edit-form-itemUnitProductCode').val(itemUnitProductCode)
            $('#edit-form-itemOnlyProduct').val(itemOnlyProduct)
            $('#edit-form-itemProductNotes').val(itemProductNotes)

            //    console.log("hello")
        })
    </script>
@endsection
