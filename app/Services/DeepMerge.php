<?php

namespace App\Services;

class DeepMerge
{
    /**
     * Realiza o merge profundo entre dois arrays.
     *
     * @param array $array1 O array base.
     * @param array $array2 O array que será mesclado ao array base.
     * @return array O array resultante do merge profundo.
     */
    public function merge(array $array1, array $array2): array
    {
        foreach ($array2 as $key => $value) {
            if (is_array($value) && isset($array1[$key]) && is_array($array1[$key])) {
                // Merge recursivo para arrays aninhados
                $array1[$key] = self::merge($array1[$key], $value);
            } else {
                // Substituição direta para valores simples ou arrays inexistentes
                $array1[$key] = $value;
            }
        }

        return $array1;
    }
}