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

    'alpha' => ':attribute lauks var saturēt tikai burtus.',
    'email' => ':attribute laukam ir jāsatur pareizu ēpasta adresi.',
    'exists' => 'Izvēlētais :attribute ir nepareizs.',
    'file' => ':attribute laukam ir jāsatur failu.',
    'gt' => [
        'numeric' => ':attribute laukam Jābūt lielāmam kā 0 :value.',
    ],
    'image' => ':attribute laukam ir jāsatur attēlu.',
    'numeric' => ':attribute Ir jābūt skaitlim.',
    'required' => ':attribute laukam ir jābūt aizpildītam.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
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
        'name'=>'Vārda',
        'email'=>'Ēpasta',
        'image' => 'Attēla',
        'income_source' => 'Kategorijas',
        'expense_category' => 'Kategorijas',
    ],

];
