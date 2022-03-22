<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => 'The :attribute must only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute يجب الا يكون اكبر من 1000000 ',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => ':attribute يجب الايزيد عن 255 حرف',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'name' => [
            'required' => 'الاسم مطلوب ',
        ],

        'email' => [
            'required' => 'الايميل مطلوب ',
            'unique' => 'الايميل موجود مسبقا ',
        ],

        'item_id.*' => [
            'required' => ':attribute حقل الصنف مطلوب',
        ],




        'password' => [
            'required' => 'كلمه السر مطلوبه  ',
            'confirmed' => 'كلمه السر  غير متوافقه    ',

        ],


        'storeCode' => [
            'required' => ' كود المخزن مطلوب ',
            'unique' => ' كود المخزن موجود مسبقا',

        ],
        'StoreName' => [
            'required' => '  اسم المخزن مطلوب ',


        ],
        'SupplierCode' => [
            'required' => ' كود المورد مطلوب ',
            'unique' => ' كود المخزن موجود مسبقا',

        ],
        'SupplierName' => [
            'required' => '  اسم المورد مطلوب ',
        ],

        'itemProductCode' => [
            'required' => '    كود الصنف مطلوب ',
            'unique' => ' كود  الصنف موجود مسبقا',
        ],

        'itemProductName' => [
            'required' => '     اسم الصنف مطلوب ',

        ],


        'itemUnitProductCode' => [
            'required' => '    كود وحده الصنف  مطلوب ',
            'unique' => '   كود وحده الصنف موجود مسبقا',
        ],



        'itemOnlyProduct' => [
            'required' => '    وحده اصنف مطلوبه',

        ],
        'purchasedDate' => [
            'required' => ' تاريخ الشراء مطلوب',

        ],
        'quantity' => [
            'required' => ' الكميه مطلوبه',

        ],
        'PurchasingBrice' => [
            'required' => '  سعر الشراء مطلوب',

        ],
        'customerNameInvoice' => [
            'required' => '    اسم العميل مطلوب',

        ],
        'CustomerPhoneNumberInvoice' => [
            'required' => '     رقم تلفون العميل مطلوب',

        ],
        'netInvoice' => [
            'required' => '     الصافي   مطلوب',

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'storeCode' => 'كود المخزن',
        'StoreName' => 'اسم المخزن',
        'password' => 'كلمه السر',
        'SupplierCode' => 'كود المورد ',
        'SupplierName' => 'اسم المورد',
        'itemProductCode' => 'كود الصنف',
        'itemProductName' => 'اسم الصنف',
        'itemUnitProductCode' => 'كود وحده الصنف',
        'itemOnlyProduct' => 'وحده الصنف',
        'openingBalance' => 'الرصيد الافتاتحي',
        'purchasedDate' => 'تاريخ الشراء',
        'quantity' => 'الكميه',
        'PurchasingBrice' => 'سعر الشراء',
        'sellingBrice' => 'سعر البيع',
        'finalBriceEnd' => 'السعر النهائي',
        'storehouseNotes' => 'ملاحظات',
        'customerNameInvoice' => 'اسم العميل ',
        'CustomerPhoneNumberInvoice' => 'رقم تلفون العميل',
        'netInvoice' => 'الصافي ',
        'quantityInvoice' => 'الكميه ',
    ],

];
