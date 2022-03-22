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
                <h4 class="content-title mb-0 my-auto">الفاتوره</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0 "></span>
            </div>
        </div>

    </div>

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @include('inc.masseg')
    <form action="{{ url('/sales/orderDetails/updateOrder') }}" method="post" id="printJS-form">
        @csrf
        <input type="hidden" name="id" id="edit-form-id">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <strong>
                    {!! implode('<br/>', $errors->all('<span>:message</span>')) !!}
                </strong>
            </div>
        @endif
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
                <input class="form-control text-center" placeholder="تاريخ الفاتوره" style="direction: ltr" readonly
                    type="text" value="{{ $order->created_at }}">
            </div>
            <div class="col-md-3 my-3">
                <label for="">نوع الفاتوره</label>
                @error('invoiceType')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <select name="invoiceType" id="" class="form-control">
                    <option value="2" @if ($order->invoiceType == '2') selected @endif>نقدي</option>
                    <option value="1" @if ($order->invoiceType == '1') selected @endif>اجل</option>

                </select>
            </div>
            <div class="col-md-3 my-3">
                <label for="">رقم الفاتوره</label>
                @error('numberInvoice')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror

                <input value="{{ $order->numberInvoice }}" readonly class="form-control" placeholder="رقم الفاتوره"
                    type="number" name="numberInvoice">
            </div>
            <div class="col-md-3 my-3">
                <label for=""> نوع العميل </label>
                @error('customerType')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <select name="customerType" id="" class="form-control">
                    <option value="1" @if ($order->customerType == '1') selected @endif>اشخاص </option>

                    <option value="2" @if ($order->customerType == '2') selected @endif> شركات</option>

                </select>
            </div>


            <div class="col-md-4 my-3">
                <label for="">كود العميل</label>
                @error('customerCodeInvoice')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <input class="form-control" value="{{ $order->customerCodeInvoice }}" readonly placeholder="كود العميل"
                    type="number" name="customerCodeInvoice" id="customerCodeInvoice">
            </div>
            <div class="col-md-4 my-3">
                <label for="">اسم العميل </label>
                @error('customerNameInvoice')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <input value="{{ $order->customerNameInvoice }}" class="form-control" type="text"
                    placeholder="اسم العميل" name="customerNameInvoice" id="customerNameInvoice">
                <div class=" d-none  " id="customerSearchMenu">
                    <div class="form-group">
                        <select class="form-control" id="customerSearchSelector">
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-3">
                <label for="">رقم تلفون العميل </label>
                @error('CustomerPhoneNumberInvoice')
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
                <input value="{{ $order->CustomerPhoneNumberInvoice }}" class="form-control"
                    placeholder="رقم تلفون العميل" type="number" name="CustomerPhoneNumberInvoice"
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
                                        <th class="wd-15p border-bottom-0">كود الصنف</th>
                                        <th class="wd-15p border-bottom-0"> اسم الصنف</th>
                                        <th class="wd-15p border-bottom-0"> كود وحده الصنف </th>
                                        <th class="wd-15p border-bottom-0"> وحده الصنف</th>
                                        <th class="wd-20p border-bottom-0"> الكميه </th>
                                        <th class="wd-15p border-bottom-0"> سعر بيع الوحده </th>
                                        <th class="wd-10p border-bottom-0">الاجمالي</th>
                                        <th class="wd-10p border-bottom-0">ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody id="items">
                                    <div class="col-12 bg-danger text-center font-weight-bolder" id="ajaxItemErrors"></div>

                                    @foreach ($orderDetails as $orderDetail)
                                        {{-- @for ($i = 0; $i < $orderDetails; $i++) --}}

                                        <tr id="isc">
                                            <td>{{ $loop->iteration }}</td>
                                            <input type="hidden" required id="itemId-{{ $loop->iteration }}"
                                                name="item_id[]">
                                            <div class="col-md-3">
                                                <td><input value="{{ $orderDetail->item->itemProductCode }}" required
                                                        onkeyup="getCod({{ $loop->iteration }})" type="number"
                                                        id="itemCode-{{ $loop->iteration}}" class="itemCode"
                                                        placeholder="كود الصنف"></td>
                                            </div>

                                            <div class="col-md-3">
                                                <td><input value="{{ $orderDetail->item->itemProductName }}" required
                                                        onkeyup="iputsearch({{ $loop->iteration }})" type="text"
                                                        id="itemName-{{ $loop->iteration }}" class="itemName "
                                                        placeholder="اسم الصنف">

                                                    <div class=" d-none"
                                                        id="itemsSearchMenu-{{ $loop->iteration }}">
                                                        <div class="form-group">
                                                            <select class="form-control "
                                                                id="itemsSearchSelector-{{ $loop->iteration }}">
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </div>
                                            <div class="col-md-3">
                                                <td><input value="{{ $orderDetail->item->itemUnitProductCode }}"
                                                        type="number" required
                                                        id="itemUnitProductCode-{{ $loop->iteration }}"
                                                        class="itemCode " placeholder="كود وحده الصنف"></td>

                                            </div>

                                            <div class="col-md-3">
                                                <td><input value="{{ $orderDetail->item->itemOnlyProduct }}" required
                                                        type="text" id="itemOnlyProduct-{{ $loop->iteration }}"
                                                        class="itemName " placeholder="وحده الصنف"></td>

                                            </div>
                                            <div class="col-md-3">
                                                <td><input value="{{ $orderDetail->quantityInvoice }}" type="number"
                                                        required id="quantityInvoice-{{ $loop->iteration }}"
                                                        name="quantityInvoice[]" class="itemCode"
                                                        placeholder="الكميه"></td>
                                            </div>
                                            <div class="col-md-3">
                                                <td><input value="{{ $orderDetail->unitSaleBriceInvoice }}" type="number"
                                                        required onfocusout="getTotal({{ $loop->iteration }})"
                                                        id="unitSaleBriceInvoice-{{ $loop->iteration }}"
                                                        name="unitSaleBriceInvoice[]" class="itemCode"
                                                        placeholder="سعر بيع الوحده"></td>
                                            </div>
                                            <div class="col-md-3">
                                                <td><input type="number" required
                                                        id="totalInvoice-{{ $loop->iteration }}" class="itemName "
                                                        placeholder="الاجمالي">
                                                </td>
                                            </div>
                                            <div class="col-md-3">
                                                <td><input value="{{ $orderDetail->notesInvoice }}" type="text"
                                                        id="notesInvoice-{{ $loop->iteration }}" name="notesInvoice[]"
                                                        class="itemName" placeholder="ملاحظات">
                                                </td>
                                            </div>
                                        </tr>
                                    @endforeach
                                    {{-- @endfor --}}



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
                                    @error('discountBercentageInvoice')
                                        <div class="alert alert-danger">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                    <input value="{{ $order->discountBercentageInvoice }}" type="number" step="any"
                                        onkeyup="discountIn()" name="discountBercentageInvoice"
                                        id="discountBercentageInvoice" class="form-control" placeholder="نسبه الخصم">
                                </div>
                                <div class="col-md-3">
                                    <label for=""> قيمه الخصم</label>
                                    <input type="number" step="any" id="discountValueInvoice" class="form-control"
                                        placeholder="قيمه الخصم">
                                </div>
                                <div class="col-md-3">
                                    <label for="">حذف الكسور</label>
                                    <input type="number" value="{{ $order->removeDecimal }}" step="any"
                                        onkeyup="removeDecimalAll()" id="removeDecimal" class="form-control"
                                        name="removeDecimal" placeholder="حذف الكسور">
                                </div>

                                <div class="col-md-3">
                                    <label for="">الصافي</label>
                                    @error('netInvoice')
                                        <div class="alert alert-danger">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @enderror
                                    <input type="number" value="{{ $order->netInvoice }}" step="any" id="netInvoice"
                                        name="netInvoice" class="form-control" placeholder="الصافي">
                                </div>

                            </div>




                            <div class="clr">

                            </div>

                            <button type="submit" class="btn btn-primary float-left m-3">تاكيد</button>
                            <button type="button" class="btn btn-danger float-left m-3"
                                onclick="printJS('printJS-form', 'html')">
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
        var arr;
        var sum;
        let totalAllInvoice = 0;
        let total = 0;
        let totalInvoice = 0;
        let allTotal = 0;
        let arrlenth = {!! json_encode($orderDetails, JSON_HEX_TAG) !!};;

        function getTotal(i) {
            // console.log(i);.

            let quantityInvoice = $(`#quantityInvoice-${i}`).val();
            // console.log(quantityInvoice);
            let unitSaleBriceInvoice = $(`#unitSaleBriceInvoice-${i}`).val();
            // console.log(unitSaleBriceInvoice);
            let totalInvoice = $(`#totalInvoice-${i}`);
            total = quantityInvoice * unitSaleBriceInvoice;
            totalInvoice.val(total);
            subTotal();
        }

        function subTotal() {
            let arr = [];

            for (let i = 1; i <= $('#items tr').length; i++) {

                if (Number($(`#totalInvoice-${i}`).val())) {
                    totalInvoice = $(`#totalInvoice-${i}`).val();
                    arr.push(Number(totalInvoice))
                } else {
                    console.log('not a Number');
                }

                var sum = arr.reduce(function(x, y) {
                    return x + y;
                }, 0);
                totalAllInvoice = $('#totalAllInvoice').val(sum)
                $(`#netInvoice`).val(sum);

                console.log(sum);
            }


        }



        function discountIn() {

            let totalAlls = $(`#totalAllInvoice`).val();
            let discountBercentageInvoice = $(`#discountBercentageInvoice`).val() / 100;

            let totalDiscount = totalAlls - (totalAlls * discountBercentageInvoice)


            // console.log(discountBercentageInvoice)
            // console.log(totalAlls)

            $(`#discountValueInvoice`).val(totalDiscount)
            $(`#netInvoice`).val(totalDiscount);

        }

        function removeDecimalAll() {

            let discountValueInvoice = $(`#discountValueInvoice`).val();
            let removeDecimal = $(`#removeDecimal`).val();

            let deleteRemoveDecimal = discountValueInvoice - removeDecimal

            $(`#netInvoice`).val(deleteRemoveDecimal);
            // console.log(discountValueInvoice, 'done')
            // console.log(removeDecimal, 'done2')
            // console.log(deleteRemoveDecimal, 'dd')
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
        // console.log('djej')
    </script>
    {{-- function total --}}
@endsection
