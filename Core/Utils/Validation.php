<?php

namespace Core\Utils;

use Exception;

class Validation
{
    /**
     * Validation errors
     * @var mixed[]
     */
    public static mixed $errors = [];

    public static function valide(mixed $requestHttpDocument, mixed $validations): mixed
    {
        foreach ($validations as $fieldName => $rulesArr) {
            foreach ($rulesArr as $rule => $ruleValue) {
                if (!isset($requestHttpDocument[$fieldName])) {
                    continue;
                }
                $valueOfInput = $requestHttpDocument[$fieldName];
                self::$errors[] = self::$rule($valueOfInput, $ruleValue, $fieldName);
            }
        }

        return self::$errors;
    }

    /**
     * Validate if the string have minimum of characters
     * @param string $data
     * @param int $min
     */
    public static function min(string $data, int $min, string $fieldName): array | bool
    {
        return strlen($data) >= $min ? TRUE :  [
            'fieldName' => $fieldName,
            'msg' => "O campo $fieldName precisa ter no minímo $min caracteres!"
        ];
    }

    /**
     * Validate if the string have max of characters
     * @param string $data
     * @param int $max
     */
    public static function max(string $data, int $max, string $fieldName): array | bool
    {
        return strlen($data) <=  $max ? TRUE : [
            'fieldName' => $fieldName,
            'msg' => "O campo $fieldName precisa ter no máximo $max caracteres!"
        ];
    }

    /**
     * apply a filter in data and return if the data has pass on filter
     * @param string $data
     * @param string $filterName
     * @exception Exception if the filter Name was not found.
     * @example 'email' | 'number_int' | 'number_float'
     */
    public static function filter(mixed $data, string $filterName, string $fieldName): array | bool
    {
        if (!is_string($data)) {
            $data = (string)$data;
        }

        $filters = [
            'email' => FILTER_VALIDATE_EMAIL,
            'number_int' => FILTER_VALIDATE_INT,
            'number_float' => FILTER_VALIDATE_FLOAT,
        ];

        if (!key_exists($filterName, $filters)) {
            throw new Exception("The filter was not found.");
        }

        return filter_var($data, $filters[$filterName]) ? TRUE : [
            'fieldName' => $fieldName,
            'msg' => "O campo $fieldName precisa ser um e-mail válido!"
        ];
    }

    public static function especials(string $data, string $qtdEspecialsChar, string $fieldName): array | bool
    {
        $especialsCharacters = join(['@', '#', '$', '%', '%', '&', '*']);

        return strlen(strpbrk($data, $especialsCharacters)) >= $qtdEspecialsChar ? TRUE : [
            'fieldName' => $fieldName,
            'msg' => "O campo $fieldName precisa ter no mínimo $qtdEspecialsChar caracteres especial! Exemplo: @#$%&*"
        ];
    }

    public static function confirm(string $value, string $confirmValue, string $fieldName): array | bool
    {
        return $value === $confirmValue ? TRUE : [
            'fieldName' => $fieldName,
            'msg' => "As senhas precisam ser iguais!"
        ];
    }

    public static function haveThisErrorOfLabelInMyArrayErrors(string $label): mixed
    {

        foreach (self::$errors as $indexArr) {
            if (is_array($indexArr)) {
                foreach ($indexArr as $key => $value) {
                    if ($value === $label) {
                        return $indexArr;
                    }
                }
            }
        }

        return false;
    }
}
