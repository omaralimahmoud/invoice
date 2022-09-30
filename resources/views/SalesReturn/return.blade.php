@extends('layouts.master')
@section('css')
    <!---Internal Owl Carousel css-->
    <!---Internal  Multislider css-->
    <!--- Select2 css -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css_print/print.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/style/style.css') }}">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">فاتوره المرتجع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0 "></span>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="initRows">عدد الحقول الابتدائية</label>
                <input class="form-control" max="50" type="number" id="initRows" onfocusout="initRows()"
                    placeholder="عدد الحقول الابتدائية">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="addRows">اضافة عدد من الحقول</label>
                <input class="form-control" max="50" type="number" id="addRows" onfocusout="addRows()"
                    placeholder="اضافة عدد من الحقول">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="deleteRows">حذف عدد من الحقول</label>
                <input class="form-control" max="50" type="number" id="deleteRows" onfocusout="deleteRows()"
                    placeholder="حذف عدد من الحقول">
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @include('inc.masseg')
    <form action="{{ url('/return/store') }}" method="post" id="printJS-form"   >
        @csrf

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible">
                <strong>
                    {{ session()->get('error') }}
                </strong>
            </div>
        @endif
        <div class="row text-center">

            <div class="col-md-3 my-3">
                <label for="">تاريخ الفاتوره</label>
                <input  class="form-control text-center" placeholder="تاريخ الفاتوره" style="direction: ltr" readonly
                    type="text" value="{{ now()->toDateTimeString() }}">
            </div>
            <div class="col-md-3 my-3">
                <label for="">نوع الفاتوره</label>
                @error('returnInvoiceType')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror

                        <select  name="returnInvoiceType" id="" class="form-control">
                            <option   value="2">نقدي</option>
                            <option   value="1">اجل</option>

                        </select>




            </div>
            <div class="col-md-3 my-3">
                <label for="">رقم الفاتوره</label>
                @error('returnNumberInvoice')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror

                <input   value="{{ $lastId }}"   readonly class="form-control" placeholder="رقم الفاتوره" type="number"
                    name="returnNumberInvoice">
            </div>
            <div class="col-md-3 my-3">
                <label for=""> نوع العميل </label>
                @error('returnCustomerType')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <select name="returnCustomerType" id="" class="form-control">
                    <option value="1">اشخاص</option>
                    <option value="2">شركات</option>
                </select>
            </div>


            <div class="col-md-4 my-3">
                <label for="">كود العميل</label>
                @error('returnCustomerCodeInvoice')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <input  value="{{ $lastId }}" class="form-control"  readonly placeholder="كود العميل" type="number"
                    name="returnCustomerCodeInvoice" id="customerCodeInvoice">
            </div>
            <div class="col-md-4 my-3">
                <label for="">اسم العميل </label>
                @error('returnCustomerNameInvoice')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <input class="form-control" type="text" required placeholder="اسم العميل" name="returnCustomerNameInvoice"
                    id="customerNameInvoice">
                <div class=" d-none  " id="customerSearchMenu">
                    <div class="form-group">
                        <select class="form-control" id="customerSearchSelector">
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-3">
                <label for="">رقم تلفون العميل </label>
                @error('returnCustomerPhoneNumberInvoice')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <input class="form-control" placeholder="رقم تلفون العميل" required type="number" name="returnCustomerPhoneNumberInvoice"
                    id="CustomerPhoneNumberInvoice">
            </div>
        </div>

        <div class="row">
            <!--start table-->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0">الفاتوره</h4>


                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">مسلسل</th>
                                        <th class="wd-15p border-bottom-0 ">كود الصنف</th>
                                        <th class="wd-15p border-bottom-0"> اسم الصنف</th>
                                        <th class="wd-15p border-bottom-0 prt"> كود وحده الصنف </th>
                                        <th class="wd-15p border-bottom-0"> وحده الصنف</th>
                                        <th class="wd-20p border-bottom-0"> الكميه </th>
                                        <th class="wd-15p border-bottom-0"> سعر بيع الوحده </th>
                                        <th class="wd-10p border-bottom-0">الاجمالي</th>
                                        <th class="wd-10p border-bottom-0">ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody id="items">
                                    <div class="col-12 bg-danger text-center font-weight-bolder" id="ajaxItemErrors"></div>
                                </tbody>
                            </table>
                            <div class="row  text-center my-3">
                                <div class="col-md-3">
                                    <label for=""> الاجمالي الكلي</label>
                                    <input type="number" step="any" id="totalAllInvoice" class="form-control"
                                        placeholder="الاجمالي">
                                </div>

                                <div class="col-md-3">
                                    <label for="">نسبه الخصم </label>
                                    @error('returnDiscountBercentageInvoice')
                                        <div class="alert alert-danger">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                    <input type="number" step="any" onkeyup="discountIn()" name="returnDiscountBercentageInvoice"
                                        id="discountBercentageInvoice" class="form-control" placeholder="نسبه الخصم">
                                </div>
                                <div class="col-md-3">
                                    <label for=""> قيمه الخصم</label>
                                    <input type="number" step="any" id="discountValueInvoice" class="form-control"
                                        placeholder="قيمه الخصم">
                                </div>
                                <div class="col-md-3 " >
                                    {{-- <label for="">حذف الكسور</label> --}}
                                    <input   type="number" step="any" onkeyup="removeDecimalAll()" id="removeDecimal"
                                        class="form-control my-4" name="returnRemoveDecimal" >
                                </div>

                                <div class="col-md-3">
                                    <label for="">الصافي</label>
                                    @error('returnNetInvoice')
                                        <div class="alert alert-danger">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                    <input type="number" step="any" id="netInvoice" name="returnNetInvoice" class="form-control"
                                        placeholder="الصافي">
                                </div>

                            </div>




                            <div class="clr">

                            </div>

                            <button  type="submit" class="btn btn-primary float-left m-3 prt">تاكيد</button>
                            <button  type="button" class="btn btn-danger float-left m-3 prt"
                                onclick="printJS({ printable: 'printJS-form', type: 'html',style: '.prt { display: none; }' })">
                                طباعه
                            </button>

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





    </form>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
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


    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js_print/print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/jsLoop/loop.js') }}"></script>
@endsection
<script></script>
@section('script')
    {{-- الحقول --}}
    <script>
        function initRows() {
            let items = $('#items');
            let rows = $('#initRows');
            let finalTemplate = [];

            if (rows.attr('readonly') == 'readonly') {
                return;
            }
            if (rows.val() == '' || rows.val() < 1) {
                rows.val('');
                return;
            }

            for (i = 1; i <= rows.val(); i++) {
                finalTemplate.push(`
                    <tr>
                        <td id="rowId">${i}</td>
                        <input type="hidden" required id="itemId-${i}" name="item_id[]">
                            <div class="col-md-3">
          <td ><input  required onkeyup="getCod(${i})" type="text" id="itemCode-${i}" class="itemCode  "
                  placeholder="كود الصنف"></td>
      </div>

      <div class="col-md-3">
          <td><input required onkeyup="iputsearch(${i})" type="text" id="itemName-${i}" class="itemName   "
                  placeholder="اسم الصنف">

                  <div class=" d-none" id="itemsSearchMenu-${i}">
                                <div class="form-group">
                                    <select class="form-control " id="itemsSearchSelector-${i}">
                                    </select>
                                </div>
                            </div>
                  </td>
      </div>
      <div class="col-md-3">
          <td class="prt"><input type="number" required id="itemUnitProductCode-${i}"  class="itemCode  "
                  placeholder="كود وحده الصنف"></td>

      </div>

      <div class="col-md-3">
          <td><input required   type="text" id="itemOnlyProduct-${i}"  class="itemCode "
                  placeholder="وحده الصنف"></td>

      </div>
      <div class="col-md-3">
          <td><input type="number"  step="any" required id="quantityInvoice-${i}" name="returnQuantityInvoice[]" class="itemCode" placeholder="الكميه"></td>
      </div>
      <div class="col-md-3">
          <td><input type="number" step="any" required onkeyup="getTotal(${i})"  id="unitSaleBriceInvoice-${i}"    name="returnUnitSaleBriceInvoice[]" class="itemCode" placeholder="سعر بيع الوحده"></td>
      </div>
      <div class="col-md-3">
          <td><input type="number" step="any" required id="totalInvoice-${i}" class="itemCode " placeholder="الاجمالي">
          </td>
      </div>
      <div class="col-md-3">
          <td><input type="text"  id="notesInvoice-${i}" name="returnNotesInvoice[]" class="itemName" placeholder="ملاحظات">
          </td>
      </div>
  </tr>
                `);
            }

            $('#initRows').prop('readonly', true);
            items.html(finalTemplate);
        }

        function addRows() {
            let items = $('#items');
            let rows = $('#addRows');
            let finalTemplate = [];

            if (rows.val() == '' || rows.val() < 1) {
                rows.val('');
                return;
            }

            let lastRowId = parseInt(items.children().last().children('td#rowId').text());
            if (isNaN(lastRowId)) {
                lastRowId = 0;
            }

            for (i = 0, x = lastRowId + 1; i < rows.val(); i++, x++) {
                finalTemplate.push(`
                <tr>
      <td id="rowId">${x}</td>
      <input type="hidden" required id="itemId-${x}" name="item_id[]">
      <div class="col-md-3">
          <td><input required onkeyup="getCod(${x})" type="text" id="itemCode-${x}" class="itemCode"
                  placeholder="كود الصنف"></td>
      </div>

      <div class="col-md-3">
          <td><input onkeyup="iputsearch(${x})" type="text" id="itemName-${x}" class="itemName "
                  placeholder="اسم الصنف">

                  <div class=" d-none" id="itemsSearchMenu-${x}">
                                <div class="form-group">
                                    <select class="form-control " id="itemsSearchSelector-${x}">
                                    </select>
                                </div>
                            </div>
                  </td>
      </div>
      <div class="col-md-3">
          <td class="prt"><input type="number" required id="itemUnitProductCode-${x}"  class="itemCode "
                  placeholder="كود وحده الصنف"></td>

      </div>

      <div class="col-md-3">
          <td><input type="text" required id="itemOnlyProduct-${x}"  class="itemCode "
                  placeholder="وحده الصنف"></td>

      </div>
      <div class="col-md-3">
          <td><input type="number" step="any"    required id="quantityInvoice-${x}" name="returnQuantityInvoice[]" class="itemCode" placeholder="الكميه"></td>
      </div>
      <div class="col-md-3">
          <td><input type="number"   step="any" required onkeyup="getTotal(${x})"  id="unitSaleBriceInvoice-${x}"    name="returnUnitSaleBriceInvoice[]" class="itemCode" placeholder="سعر بيع الوحده"></td>
      </div>
      <div class="col-md-3">
          <td><input type="number"  step="any" required id="totalInvoice-${x}" class="itemCode " placeholder="الاجمالي">
          </td>
      </div>
      <div class="col-md-3">
          <td class="prt"><input type="text" id="notesInvoice-${x}" name="returnNotesInvoice[]" class="itemName" placeholder="ملاحظات">
          </td>
      </div>
  </tr>
                `);
            }

            rows.val('');
            items.append(finalTemplate);
        }

        function deleteRows() {
            let items = $('#items');
            let rows = $('#deleteRows');

            if (rows.val() == '' || rows.val() < 1) {
                rows.val('');
                return;
            }

            if (items.has('tr').length) {
                for (i = 0; i < rows.val(); i++) {
                    items.children().last().remove();
                }
            }

            rows.val('');
        }
    </script>
    <script>
        var arr;
        var sum;
        let totalAllInvoice = 0;
        let total = 0;
        let totalInvoice = 0;
        let allTotal = 0;

        function getTotal(i) {
            let quantityInvoice = $(`#quantityInvoice-${i}`).val();
            let unitSaleBriceInvoice = $(`#unitSaleBriceInvoice-${i}`).val();
            let totalInvoice = $(`#totalInvoice-${i}`);
            total = quantityInvoice * unitSaleBriceInvoice;
            console.log(total);
            totalInvoice.val(total.toFixed(2));
            subTotal();
        }

        function subTotal() {
            let arr = []

            for (let i = 0; i <= $('#items tr').length; i++) {
                if (Number($(`#totalInvoice-${i}`).val())) {
                    totalInvoice = $(`#totalInvoice-${i}`).val();
                    arr.push(Number(totalInvoice))
                } else {
                    // console.log('not a Number');
                }

                var sum = arr.reduce(function(x, y) {
                    return x + y;
                }, 0);
                totalAllInvoice = $('#totalAllInvoice').val(sum)
                $(`#netInvoice`).val(sum);

            //    console.log(sum);
            }


        }


        function discountIn() {

            let totalAlls = $(`#totalAllInvoice`).val();
            let discountBercentageInvoice = $(`#discountBercentageInvoice`).val() / 100;

            let totalDiscount = totalAlls - (totalAlls * discountBercentageInvoice)


       //     console.log(discountBercentageInvoice)
        //    console.log(totalAlls)

            $(`#discountValueInvoice`).val(totalDiscount)
            $(`#netInvoice`).val(totalDiscount);

        }

        function removeDecimalAll() {

            let discountValueInvoice = $(`#discountValueInvoice`).val();
            let removeDecimal = $(`#removeDecimal`).val();

            let deleteRemoveDecimal = discountValueInvoice - removeDecimal

            $(`#netInvoice`).val(deleteRemoveDecimal);
        //    console.log(discountValueInvoice, 'done')
         //   console.log(removeDecimal, 'done2')
         //   console.log(deleteRemoveDecimal, 'dd')
        }








        ///////////// start Ajax get code

        function getCod(i) {


            let itemCodeValue = $(`#itemCode-${i}`).val();
            let itemName = $(`#itemName-${i}`);
            let itemId = $(`#itemId-${i}`);
            let itemUnitProductCode = $(`#itemUnitProductCode-${i}`)
            let itemOnlyProduct = $(`#itemOnlyProduct-${i}`)

            let itemErrors = $('#ajaxItemErrors');

            $.ajax({
                url: `/ajax/items/get-by-code/${itemCodeValue}`,
                type: 'get',
                success: (response) => {
                    itemErrors.html('');
                    itemName.val(response.item.itemProductName);
                    itemUnitProductCode.val(response.item.itemUnitProductCode);
                    itemOnlyProduct.val(response.item.itemOnlyProduct);
                    itemId.val(response.item.id);

                },
                error: (xhr, ajaxOptions, thrownError) => {
                    itemErrors.html('لا يوجد صنف بهذا الكود');
                    itemName.val('');
                    itemUnitProductCode.val('');
                    itemOnlyProduct.val('');

                    itemId.val('');

                },
            });

        }
        ///////////End Ajax get code


        //// input search

        function iputsearch(i) {
            let itemNameValue = $(`#itemName-${i}`).val();
            let itemsSearchMenu = $(`#itemsSearchMenu-${i}`);
            // let itemName = $('#itemName');
            let itemCode = $(`#itemCode-${i}`);
            let item_id = $(`#itemId-${i}`);
            let itemUnitProductCode = $(`#itemUnitProductCode-${i}`);
            let itemOnlyProduct = $(`#itemOnlyProduct-${i}`);

            let itemErrors = $('#ajaxItemErrors');

            $.ajax({
                url: `/ajax/items/input-search/${itemNameValue}`,
                type: 'get',
                success: (response) => {
                    itemErrors.html('');
                    $(`#itemsSearchSelector-${i}`).html('');
                    itemsSearchMenu.removeClass('d-none');
                    response.items.map((item) => {
                        $(`#itemsSearchSelector-${i}`).append(`
                                <option  value="${item.itemProductName}">${item.itemProductName}</option>
                        `);
                    });
                    // itemName.val(response.items[0].itemProductName);
                    itemCode.val(response.items[0].itemProductCode);
                    item_id.val(response.items[0].id);
                    itemUnitProductCode.val(response.items[0].itemUnitProductCode)
                    itemOnlyProduct.val(response.items[0].itemOnlyProduct)
                },
                error: (xhr, ajaxOptions, thrownError) => {
                    itemsSearchMenu.addClass('d-none');
                    $(`#itemsSearchSelector-${i}`).html('');
                    itemErrors.html('لا يوجد صنف بهذا الاسم');
                    itemCode.val('');
                    itemUnitProductCode.val('');
                    itemOnlyProduct.val('');
                    item_id.val('');

                },
            });

            getName(i)
        }

        function getName(i) {
            $(`#itemsSearchSelector-${i}`).change(() => {
                let itemNameValue = $(`#itemsSearchSelector-${i} option:selected`).val();
                // let itemName = $('#itemName');
                let itemCode = $(`#itemCode-${i}`);
                let item_id = $(`#itemId-${i}`);
                let itemUnitProductCode = $(`#itemUnitProductCode-${i}`);
                let itemOnlyProduct = $(`#itemOnlyProduct-${i}`);
                let itemErrors = $('#ajaxItemErrors');
                $.ajax({
                    url: `/ajax/items/get-by-name/${itemNameValue}`,
                    type: 'get',
                    success: (response) => {
                        itemErrors.html('');
                        // itemName.val(response.item.itemProductName);
                        itemCode.val(response.item.itemProductCode);
                        itemUnitProductCode.val(response.item.itemUnitProductCode);
                        itemOnlyProduct.val(response.item.itemOnlyProduct);
                        item_id.val(response.item.id);
                    },
                    error: (xhr, ajaxOptions, thrownError) => {
                        itemErrors.html('لا يوجد صنف بهذا الاسم');
                        // itemName.val('');
                        itemCode.val('');
                        itemId.val('');
                        itemUnitProductCode.val('');
                        itemOnlyProduct.val('');

                    },
                });
            });
        }
    </script>
@endsection

@section('total')
    {{-- function total --}}
    <script>


    </script>
    {{-- function total --}}
@endsection
