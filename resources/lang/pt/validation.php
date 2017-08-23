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

    'accepted'             => ':attribute deve ser aceito.',
    'active_url'           => ':attribute não é uma URL válida.',
    'after'                => ':attribute deve ser uma data após :date.',
    'after_or_equal'       => ':attribute deve ser uma data após ou igual a :date.',
    'alpha'                => ':attribute deve conter somente letras.',
    'alpha_dash'           => ':attribute deve conter somente letras, números e traços.',
    'alpha_num'            => ':attribute deve conter somente letras e números.',
    'array'                => ':attribute deve ser um array.',
    'before'               => ':attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => ':attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => ':attribute deve ser entre :min e :max.',
        'file'    => ':attribute deve ser entre :min e :max kilobytes.',
        'string'  => ':attribute deve ser entre :min e :max caracteres.',
        'array'   => ':attribute deve ser entre :min e :max ítens.',
    ],
    'boolean'              => 'O campo :attribute deve ser verdadeiro (true) ou falso (false).',
    'confirmed'            => 'A confirmação de :attribute não combina.',
    'date'                 => ':attribute não é uma data válida.',
    'date_format'          => ':attribute não é igual ao formato :format.',
    'different'            => ':attribute e :other devem ser diferentes.',
    'digits'               => ':attribute deve ter :digits dígitos.',
    'digits_between'       => ':attribute deve ter entre :min e :max dígitos.',
    'dimensions'           => ':attribute tem imagem com dimensões inválidas.',
    'distinct'             => 'O campo :attribute tem um valor duplicado.',
    'email'                => ':attribute deve ser um email válido.',
    'exists'               => 'O :attribute selecionado é inválido.',
    'file'                 => ':attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute é requerido.',
    'image'                => ':attribute deve ser uma imagem.',
    'in'                   => 'O :attribute selecionado é inválido.',
    'in_array'             => 'O campo :attribute não devem existir em :other.',
    'integer'              => ':attribute deve ser um número inteiro.',
    'ip'                   => ':attribute deve ser um IP válido.',
    'json'                 => ':attribute deve ser uma string JSON válida.',
    'max'                  => [
        'numeric' => ':attribute não deve ser maior que :max.',
        'file'    => ':attribute não deve ser maior que :max kilobytes.',
        'string'  => ':attribute não deve ser maior que :max caracteres.',
        'array'   => ':attribute não deve ser maior que :max ítens.',
    ],
    'mimes'                => 'O arquivo :attribute deve ser do tipo: :values.',
    'mimetypes'            => 'O arquivo :attribute deve ser do tipo: :values.',
    'min'                  => [
        'numeric' => ':attribute deve ter ao menos :min.',
        'file'    => ':attribute deve ter ao menos :min kilobytes.',
        'string'  => ':attribute deve ter ao menos :min characters.',
        'array'   => ':attribute deve ter ao menos :min items.',
    ],
    'not_in'               => 'O :attribute selecionado é inválido.',
    'numeric'              => ':attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato de :attribute é inválido.',
    'required'             => 'O campo :attribute é requerido.',
    'required_if'          => 'O campo :attribute é requerido quando :other é :value.',
    'required_unless'      => 'o campo :attribute é requerido quando :other está em :values.',
    'required_with'        => 'O campo :attribute é requerido quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é requerido quando :values está presente.',
    'required_without'     => 'O campo :attribute é requerido quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é requerido quando nenhum dos :values estão presentes.',
    'same'                 => ':attribute e :other devem ser os mesmos.',
    'size'                 => [
        'numeric' => ':attribute deve ser :size.',
        'file'    => ':attribute deve ser :size kilobytes.',
        'string'  => ':attribute deve ser :size caracteres.',
        'array'   => ':attribute deve conter :size ítens.',
    ],
    'string'               => ':attribute deve ser uma string.',
    'timezone'             => ':attribute deve ser uma zona válida.',
    'unique'               => ':attribute já foi tomado.',
    'uploaded'             => 'O upload de :attribute falhou.',
    'url'                  => 'O formato de :attribute é inválido.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
